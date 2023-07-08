<?php

require_once('config.php');

$options = array(
    PDO::ATTR_EMULATE_PREPARES      => false, // turn off emulation mode for "real" prepared statements
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC, //make the default fetch be an associative array
);

try {
    $pdo = new PDO('mysql:host='. DB_SERVER. ';port='. DB_PORT. ';dbname='. DB_NAME, DB_USERNAME, DB_PASSWORD, $options); 
}
catch (Exception $exception) {
    error_log($exceptino->getMessage());
    exit('[ERROR] PDO connection failed - thrown exception: '.$exception->getMessage());    
}