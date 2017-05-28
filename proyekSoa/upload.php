
<html>
<head>
    <meta charset="utf-8">
    <title>Slim 3</title>
    <link rel="stylesheet" href="http://yegor256.github.io/tacit/tacit.min.css">
</head>
<body>

<form action="index.php/uploadVideo" method="post" enctype="multipart/form-data">

            <label>Select file to upload:</label>
            <input type="file" name="newfile">
            <br>
            <input type="text" name="judul_video">
            <br>
            <input type="text" name="description">
            <br>
            <input type="text" name="id_user">
            <br>
            <button type="submit">Upload</button>
</form>

</body>
</html>