<?php

// Requires Function composer's autoload
if (file_exists('function/vendor/autoload.php')) {
    require('function/vendor/autoload.php');
} else {
    throw new Exception('File not exist function/vendor/autoload.php!');
}

$stdin = file_get_contents("php://stdin");

if (empty($stdin) || ($arrayStdin = \json_decode($stdin, true)) === null) {
    $arrayStdin = [];
}

$response = (new App\Handler())->handle($arrayStdin);
echo $response;
