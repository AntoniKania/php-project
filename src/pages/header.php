<?php session_start(); ?>
<?php require_once '../config.php' ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">
    <title>Blog</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <?php $role = $_SESSION['role']; ?>
                <?php if ($role === User::$ADMIN): ?>
                    <li class="nav-item"><a class="nav-link" href="manage_users.php">Manage Users</a></li>
                <?php endif; ?>
                <?php if ($role === User::$ADMIN || $role === User::$AUTHOR): ?>
                    <li class="nav-item"><a class="nav-link" href="create_post.php">Create New Post</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>