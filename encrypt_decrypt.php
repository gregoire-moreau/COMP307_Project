<?php
//Exact translation of the Javascript function defined in json.js that encrypt and decrypt the packets sent to and from the server
//Used the opposite of those JS functions : Encrypt packets sent to the browser and decrypt packets sent from the browser

$key = array(5, 1, 4);
function encrypt($str) {
    $ciphered = "";
    $j = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        $ascii = ord(substr($str, $i));
        if ($j >= count($GLOBALS["key"])) {
            $j = 0;
        }
        $ascii += $GLOBALS["key"][$j];
        $ascii = $ascii%127;
        $ciphered = chr($ascii).$ciphered;
        $j++;
    }
    return $ciphered;
}

function decrypt($str) {
    $deciphered = "";
    $j = 0;
    for ($i = strlen($str)-1; $i >= 0; $i--) {
        $ascii = ord(substr($str, $i));
        if ($j >= count($GLOBALS["key"])) {
            $j = 0;
        }
        $ascii -= $GLOBALS["key"][$j];
        while ($ascii < 0) {
            $ascii += 127;
        }
        $deciphered = $deciphered.chr($ascii);
        $j++;
    }
    return $deciphered;  
}