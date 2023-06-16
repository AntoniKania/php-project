<?php
require_once 'UserTable.php';
require_once 'Auth.php';

$test = "test";
$dsn = "mysql:host=db;dbname=myDB";
$username = "root";
$password = "example";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
];

$pdo = new PDO($dsn, $username, $password, $options);
$userTable = new UserTable($pdo);
$auth = new Auth($userTable);