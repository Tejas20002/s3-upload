$(document).ready(function () {
    $('#uploadButton').click(function () {
        var files = $('#fileInput')[0].files;
        var formData = new FormData();

        for (var i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        $.ajax({
            url: '/upload',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                listFiles();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    function listFiles() {
        $.ajax({
            url: '/list-files',
            method: 'GET',
            success: function (response) {
                $('#fileList').empty();
                response.files.forEach(function (file) {
                    $('#fileList').append('<li>' + file + ' <button class="delete" data-path="' + file + '">Delete</button></li>');
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    $(document).on('click', '.delete', function () {
        var filePath = $(this).data('path');

        $.ajax({
            url: '/delete-file',
            method: 'POST',
            data: { file_path: filePath },
            success: function (response) {
                console.log(response);
                listFiles();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    listFiles();
});
