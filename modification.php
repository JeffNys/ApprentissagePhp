<?php
session_start();
if ($_SESSION["user"]) {
    extract($_SESSION["user"], EXTR_OVERWRITE);
} else {
    header("Location: /connexion.php");
}

include('./script/functions.php');
if (!empty($_POST)) {
    $data = openDB();
    $users = $data["user"];

    // we looking for actual user in DB
    foreach ($users as $id => $user) {
        if ($email == $user["email"]) {
            $idUser = $id;
        }
    }

    $securePost = treatFormData(
        $_POST,
        "name",
        "firstName",
        "email",
        "password",
    );
    extract($securePost, EXTR_OVERWRITE);

    // we test if the new email is not already used
    $idOtherUser = -404;
    foreach ($users as $id => $user) {
        if ($email == $user["email"]) {
            $idOtherUser = $id;
        }
    }

    if ($idOtherUser == -404 || $idOtherUser == $idUser) {
        if (!empty($_FILES["path"]["tmp_name"]) && !empty($_FILES["path"]["name"])) {
            // it's only now a good idea to upload the file
            // we save the old file 
            $theOldFile = $path;
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
                    $path = $finalName;
                    // now, we have to delete the old file ... if there is one
                    if ($theOldFile) {
                        $fullOldPath = UPLOADFOLDER . $theOldFile;
                        unlink($fullOldPath);
                        // maybe on MS-Windows, unlink doesn't work correctly
                    }
                } else {
                    $errorMessage = "il y a eu un soucis lors de l'upload";
                }
            }
        }

        if (!$errorMessage) {
            // if new password we hash it else we take back de actual
            if ($password) {
                $hashPassword = password_hash($password, PASSWORD_ARGON2ID);
            } else {
                $hashPassword = $users[$idUser]["password"];
            }

            $data["user"][$idUser] = [
                "email" => $email,
                "name" => $name,
                "firstName" => $firstName,
                "password" => $hashPassword,
                "role" => $role,
                "path" => $path,
            ];
            writeDB($data);
            // of course, we don't forget to update $_SESSION
            $_SESSION["user"] = [
                "email" => $email,
                "name" => $name,
                "firstName" => $firstName,
                "role" => $role,
                "path" => $path,
            ];
            header("Location: /compte.php");
        }
    } else {
        // if email is already in DB
        extract($_SESSION["user"], EXTR_OVERWRITE);
        $errorMessage = "L'adresse de courriel est déjà utilisé, aucune modification n'a été prise en compte";
    }
}

?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <title>Modifier mes information</title>
</head>

<body>
    <?php include("./partial/_navBar.php"); ?>
    <div class="container">
        <h1>Modifier mes information</h1>

        <?php if ($errorMessage) : ?>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <h4 class="alert-heading">Attention!</h4>
                <p class="mb-0"><?php echo $errorMessage ?></p>
            </div>
        <?php endif ?>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-form-label" for="name">Nom : </label>
                <input type="text" class="form-control border border-3" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="firstName">Prénom : </label>
                <input type="text" class="form-control border border-3" name="firstName" value="<?php echo $firstName; ?>">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="email">Courriel : </label>
                <input type="email" class="form-control border border-3" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="password">Mot de passe : </label>
                <input type="password" class="form-control border border-3" name="password" placeholder="Laisser vide si vous ne voulez pas changer de mot de passe">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="path">votre fichier : </label>
                <input type="file" class="form-control border border-3" name="path">
            </div>
            <input class="btn btn-primary mb-4 mt-3" type="submit" value="Modifier">
        </form>
    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>