<?php
session_start();

require_once 'config.php';

$auth->registerUser("test3", "test2");

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $userRole = $_SESSION['role'];
} else {
    $username = "Guest";
}