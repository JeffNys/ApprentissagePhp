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
// create a vigenere tab
$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$alphabetTab = str_split($alphabet);
$doubleAlphaTab = array_merge($alphabetTab, $alphabetTab);

$sizeAlphabet = count($alphabetTab);

for ($i = 0; $i < $sizeAlphabet; $i++) {
    for ($j = 0; $j < $sizeAlphabet; $j++) {
        $line = $alphabetTab[$i];
        $column = $alphabetTab[$j];
        $vigenere[$line][$column] = $doubleAlphaTab[$i + $j];
    }
}

// encode message
$message = "APPRENDRE PHP EST UNE CHOSE FORMIDABLE";
$key = "BACKEND";
$messageTab = str_split($message);
$keyTab = str_split($key);
$keySize = count($keyTab);

$encodedMessage = [];
$keyCounter = 0;
foreach ($messageTab as $pointer => $letterToEncode) {
    $positionKeyLetter = $keyCounter % $keySize;
    $keyLetter = $keyTab[$positionKeyLetter];
    if ($letterToEncode != " ") {
        $encodedMessage[] = $vigenere[$letterToEncode][$keyLetter];
    } else {
        $encodedMessage[] = " ";
    }
    $keyCounter++;
}

$cryptedMessage = implode($encodedMessage);
var_dump($cryptedMessage);
?>








==============================================
        </pre>
    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>