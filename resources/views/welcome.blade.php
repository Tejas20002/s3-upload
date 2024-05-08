<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>File Upload</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Topps</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Upload Files</h2>
        <input type="file" id="fileInput" class="form-control" multiple>
        <button id="uploadButton" class="btn btn-primary mt-2">Upload</button>
    </div>

    <div class="container mt-5">
        <h2>Uploaded Files</h2>
        <ul id="fileList" class="list-group"></ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#uploadButton').click(function() {
            var files = $('#fileInput')[0].files;
            var formData = new FormData();

            for (var i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            // Add CSRF token to headers
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/upload',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    console.log(response);
                    listFiles();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        function listFiles() {
            // Add CSRF token to headers
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/list-files',
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    $('#fileList').empty();
                    response.files.forEach(function(file) {
                        $('#fileList').append('<li>' + file +
                            ' <button class="delete" data-path="' + file +
                            '">Delete</button></li>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        $(document).on('click', '.delete', function() {
            var filePath = $(this).data('path');

            // Add CSRF token to headers
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/delete-file',
                method: 'POST',
                data: {
                    file_path: filePath
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    console.log(response);
                    listFiles();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        listFiles();
    });
    </script>
</body>

</html>