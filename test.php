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


$data = file_get_contents('./data/jsonDB.json');

$tab = json_decode($data, true);

$tab["email"] = "bozo75@gmail.com";

$jsonData = json_encode($tab);

file_put_contents('./data/jsonDB.json', $jsonData);

?>


==============================================
        </pre>



    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>