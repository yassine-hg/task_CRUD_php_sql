<?php
function connect() {
    $hostname = 'localhost';
    $dbname = 'users';
    $username = 'users';
    $password = 'user1234';

    $dsn = "mysql:host=$hostname;dbname=$dbname";

    try {
        return new PDO($dsn, $username, $password);
    } catch (Exception $e) {
        echo $e->getMessage();
        return null; 
    }
}
?>

    