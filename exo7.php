<?php
session_start();
include('./script/functions.php');
require("./script/cryptage.php");
if (!empty($_POST)) {
    if ($_POST["text"]) {
        $text = strip_tags($_POST["text"]);
    }
    if ($_POST["key"]) {
        $key = strip_tags($_POST['key']);
    }
    if ($_POST["action"]) {
        $action = strip_tags($_POST["action"]);
    }

    switch ($action) {
        case "encodeVigenere":
            $result = codeVigenere($text, $key);
            break;
        case "decodageVigenere":
            $result = uncodeVigenere($text, $key);
            break;
            $result = "vous devez d'abord choisir une méthode";
        default:
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

    <title>Exercice 7</title>
</head>

<body>
    <?php include("./partial/_navBar.php"); ?>
    <div class="container">
        <h1>Exercice 7</h1>

        <h3>programme de codage et décodage suivant divers protocole de cryptage</h3>

        <form method="post">
            <div class="form-group">
                <label for="text">le texte</label>
                <textarea name="text" class="form-control border border-3" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label class="col-form-label" for="key">la clé</label>
                <input type="text" class="form-control border border-3" name="key">
            </div>
            <div class="form-group">
                <label for="method" class="form-label mt-4">Action à effectuer</label>
                <select class="form-select border border-3" name="action">
                    <option value="">-- choisissez l'action --</option>
                    <option value="encodeVigenere">encodage par Vigenère</option>
                    <option value="decodageVigenere">decodage par vigenère</option>
                </select>
            </div>
            <a href="/exo7.php" class="btn btn-primary mt-3 mb-3">Annuler</a>
            <input type="submit" class="btn btn-primary mt-3 mb-3" value="Envoyer">
        </form>

        <p>========================================</p>

        <?php if ($result) : ?>
            <p>le texte : <?php echo $text; ?> <br>
                avec la clé: <?php echo $key; ?> <br>
                renvoie le résultat: <?php echo $result; ?></p>
        <?php endif ?>

    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>