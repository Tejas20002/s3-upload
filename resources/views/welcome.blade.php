<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/upload.js') }}"></script>
</body>

</html>