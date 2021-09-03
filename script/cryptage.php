<?php

function getAlphabetVigenere(): array
{
    $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $alphabetTab = str_split($alphabet);
    return $alphabetTab;
}

function sizeAlphabetVigenere(): int
{
    $alphabetTab = getAlphabetVigenere();
    $size = count($alphabetTab);
    return $size;
}

function createVigenereTab(): array
{
    // create a vigenere tab
    $alphabetTab = getAlphabetVigenere();
    $doubleAlphaTab = array_merge($alphabetTab, $alphabetTab);

    $sizeAlphabet = count($alphabetTab);

    for ($i = 0; $i < $sizeAlphabet; $i++) {
        for ($j = 0; $j < $sizeAlphabet; $j++) {
            $line = $alphabetTab[$i];
            $column = $alphabetTab[$j];
            $vigenere[$line][$column] = $doubleAlphaTab[$i + $j];
        }
    }
    return $vigenere;
}

function codeVigenere(string $message, string $key): string
{
    // create the vigenere tab
    $vigenere = createVigenereTab();
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

    $cryptedMessage = implode($encodedMessage);
    return $cryptedMessage;
}

function uncodeVigenere(string $encodedMessage, string $key): string
{
    // create the vigenere tab
    $vigenere = createVigenereTab();
    $sizeAlphabet = sizeAlphabetVigenere();
    $alphabetTab = getAlphabetVigenere();
    // decode message
    $encodedMessageTab = str_split($encodedMessage);
    $keyTab = str_split($key);
    $keySize = count($keyTab);

    $keyCounter = 0;
    foreach ($encodedMessageTab as $pointer => $letterToDecode) {
        $positionKeyLetter = $keyCounter % $keySize;
        $keyLetter = $keyTab[$positionKeyLetter];
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
    return $decodedMessage;
}
