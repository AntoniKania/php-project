<?php
require_once 'table/UserTable.php';
require_once 'table/PostTable.php';
require_once 'table/CommentTable.php';
require_once 'service/AuthService.php';
require_once 'model/Post.php';
require_once 'model/Comment.php';
require_once 'model/User.php';
require_once 'model/Credentials.php';

const DATE_FORMAT = 'j/m/Y H:i:s';

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
$postTable = new PostTable($pdo);
$auth = new AuthService($userTable);
$commentTable = new CommentTable($pdo);