<?php
session_start();

if (!$_SESSION["user"]) {
    header("Location: /connexion.php");
}
extract($_SESSION["user"], EXTR_PREFIX_ALL, "user");

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

    <title>Mon compte</title>
</head>

<body>
    <?php include("./partial/_navBar.php"); ?>
    <div class="container">
        <h1>Mon compte</h1>

        <div class="card">
            <div class="card-body">
                <p class="card-text">Prénom: <?php echo $user_firstName; ?> </p>
                <p class="card-text">Nom: <?php echo $user_name; ?> </p>
                <p class="card-text">Courriel: <?php echo $user_email; ?> </p>
                <?php if ($user_path) : ?>
                    <p class="card-text">Photo de profil: <img style="width: 5rem" src="<?php echo UPLOADFOLDER . $user_path; ?>" alt="photo de <?php echo "$user_firstName $user_name"; ?>"> </p>
                <?php else : ?>
                    <p>Vous n'avez pas de photo de profil</p>
                <?php endif ?>
                <a class="btn btn-primary" href="modification.php">Modifier mes informations</a>
            </div>
        </div>

    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>