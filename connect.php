<?php
$user = 'root';
$password = '';
$db = 'aspro';
$host = 'localhost';
$charset = 'utf8';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $password);
}catch (PDOException $e) {
    die($e->getMessage());
}
