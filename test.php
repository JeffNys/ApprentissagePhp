<?php
session_start();
include('./script/functions.php');
?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <title>Page de test php</title>
</head>

<body>
    <?php include("./partial/_navBar.php"); ?>
    <div class="container">
        <h1>Page de test Php</h1>

        <pre>
résultats php
==============================================

<?php

if (!empty($_POST)) {

    $theFile = $_FILES['path'];
    $theFileOnServer = $theFile['tmp_name'];
    $autorizedMime = ["image/jpeg", "image/jpg", "image/gif", "image/png"];
    // test about mime type
    $testMime = mime_content_type($theFileOnServer);
    if (!in_array($testMime, $autorizedMime)) {
        $errorMessage = "le fichier n'est pas reconnu comme une image";
    }
    // test about uploaded file
    if (!is_uploaded_file($theFileOnServer)) {
        $errorMessage = "il y a eu une erreur d'upload du fichier";
    }
    // test about size
    $fileSize = filesize($theFileOnServer);
    if (99000 < $fileSize) {
        $errorMessage = "le fichier est trop volumineux";
    }

    if (!$errorMessage) {
        // basename help to protect to files' attacks
        $originalFileName = basename($theFile['name']);
        $ext = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $mainName = pathinfo($originalFileName, PATHINFO_FILENAME);
        $tmpCleanedName = preg_replace("/\s/", "-", $mainName);
        $cleanedName = trim($tmpCleanedName, "-");
        $finalName = $cleanedName . uniqid() . '.' . $ext;
        $destination = UPLOADFOLDER . $finalName;
        $succesUpload = move_uploaded_file($theFileOnServer, $destination);
        if ($succesUpload) {
            $message = "OK, nous avons bien uploadé le fichier";
        } else {
            $message = "il y a eu un soucis lors de l'upload";
        }
    }
}



?>



==============================================
        </pre>

        <?php if ($errorMessage) : ?>
            <p><?php echo $errorMessage; ?></p>
        <?php endif ?>
        <?php if ($message) : ?>
            <p><?php echo $message; ?></p>
        <?php endif ?>


        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-form-label" for="path">votre fichier : </label>
                <input type="file" class="form-control border border-3" name="path">
            </div>
            <input class="btn btn-primary mb-4 mt-3" type="submit" value="Uploader" name="submit">
        </form>



    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>