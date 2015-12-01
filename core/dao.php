<?php

$dbhost = 'localhost';
$dbname = 'qsoft_content';
$dbuser = 'root';
$dbpass = 'brianqbet5';

try {
      
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
} catch (PDOException $e) {

    echo $e->getMessage();

}
?>