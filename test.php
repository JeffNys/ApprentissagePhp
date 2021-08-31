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

// decode message
$encodedMessage = "TWA PEE WM TESLH WL LSLVNMRJ";
$key4decode = "VIGENERE";
$encodedMessageTab = str_split($encodedMessage);
$key4decodeTab = str_split($key4decode);
$key4decodeSize = count($key4decodeTab);

$keyCounter = 0;
foreach ($encodedMessageTab as $pointer => $letterToDecode) {
    $positionKeyLetter = $keyCounter % $key4decodeSize;
    $keyLetter = $key4decodeTab[$positionKeyLetter];
    if ($letterToDecode != " ") {
        for ($i = 0; $i < $sizeAlphabet; $i++) {
            $lineToDecode = $alphabetTab[$i];
            if ($vigenere[$lineToDecode][$keyLetter] == $letterToDecode) {
                $decryptedMessage[] = $lineToDecode;
            }
        }
    } else {
        $decryptedMessage[] = " ";
    }
    $keyCounter++;
}

$decodedMessage = implode($decryptedMessage);

?>








==============================================
        </pre>
    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>