<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../styles.css">
    <title>Blog</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <?php $role = $_SESSION['role']; ?>
                <?php if ($role === User::$ADMIN): ?>
                    <li><a href="manage_users.php">Manage Users</a></li>
                <?php endif; ?>
                <?php if ($role === User::$ADMIN || $role === User::$AUTHOR): ?>
                    <li><a href="create_post.php">Create New Post</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>