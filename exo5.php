<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <title>Exercice 5</title>
</head>

<body>
    <?php include("./partial/_navBar.php"); ?>
    <div class="container">
        <h1>Exercice 5</h1>

        <?php
        if (!empty($_POST)) {
            if ($_POST["message"]) {
                $message = strip_tags($_POST["message"]);
            }
            if ($_POST["key"]) {
                $key = strip_tags($_POST['key']);
            }
            if ($_POST["encodedMessage"]) {
                $encodedMessage = $_POST["encodedMessage"];
            }

            if ((!$key && $message) || (!$key && $encodedMessage)) {
                $errorMessage = "vous devez rentrer la clé";
            } elseif (!$message && !$encodedMessage && $key) {
                $errorMessage = "action non définie";
            } elseif ($message && $encodedMessage && $key) {
                $errorMessage = "trop d'informations";
            }

            if (!$errorMessage) {
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

                if ($message && $key) {
                    // encode message
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

                    $encodedMessage = implode($encodedMessage);
                } elseif ($encodedMessage && $key) {
                    // decode message
                    $key4decode = $key;
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

                    $message = implode($decryptedMessage);
                }
            }
        }
        ?>

        <h3>Système d'encodage de vigenère</h3>
        <p>Vous pouvez entrer un message ou un code et la clé, ATTENTION en Majuscule</p>


        <?php if ($errorMessage) : ?>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <h4 class="alert-heading">Attention!</h4>
                <p class="mb-0"><?php echo $errorMessage ?></p>
            </div>
        <?php endif ?>


        <form method="POST">
            <div class="form-group">
                <label for="message">LE MESSAGE</label>
                <textarea name="message" class="form-control border border-3" rows="2"><?php echo $message; ?></textarea>
            </div>
            <div class="form-group">
                <label class="col-form-label" for="key">LA CLE</label>
                <input type="text" class="form-control border border-3" name="key" value="<?php echo $key; ?>">
            </div>
            <div class="form-group">
                <label for="encodedMessage">LE CODE</label>
                <textarea name="encodedMessage" class="form-control border border-3" rows="2"><?php echo $encodedMessage; ?></textarea>
            </div>
            <a href="/exo5.php" class="btn btn-primary mt-3 mb-3">Annuler</a>
            <input type="submit" class="btn btn-primary mt-3 mb-3" value="Vigenèriser">
        </form>
    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>