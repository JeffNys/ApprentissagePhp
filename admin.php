<?php
session_start();
if ($_SESSION["user"]) {
    if (!in_array("ROLE_ADMIN", $_SESSION["user"]["role"])) {
        header("Location: /");
    }
} else {
    header("Location: /");
}
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

    <title>Page admin</title>
</head>

<body>
    <?php include("./partial/_navBar.php"); ?>
    <div class="container">
        <h1>Page admin</h1>
        <p>page accessible uniquement à l'administrateur</p>

        <p>affichage du ls -al</p>
        <pre>
<?php system("ls -al"); ?>
        </pre>
    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>