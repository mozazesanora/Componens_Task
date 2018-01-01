<?php

require 'token.php';

$key       = 'masuk';
$raw       = 'emang ini decrypt?';
$meta      = [ 'name' => 'Mozaze Sanora Putra', 'email' => 'mozaze.sanora96@gmail.com' ];
$encrypted = encrypt($key, $raw, $meta);
$decrypted = decrypt($key, $encrypted, $meta);

// echo 'KEY:';
// var_dump($key);
// echo 'RAW:';
// var_dump($raw);
// echo 'META:';
// var_dump($meta);
echo 'ENCRYPTED:';
var_dump($encrypted);
echo 'DENCRYPTED:';
var_dump($decrypted);