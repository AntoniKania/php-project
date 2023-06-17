<?php
session_start();

require_once 'config.php';

//$auth->registerUser("test3", "test2");

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $userRole = $_SESSION['role'];
} else {
    $username = "Guest";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
</head>
<body>
<header>
    <h1>Welcome to Blog</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <?php if ($userRole === 'admin'): ?>
                    <li><a href="manage_users.php">Manage Users</a></li>
                    <li><a href="view_logs.php">View Logs</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<!--<main>-->
<!--    --><?php //foreach ($posts as $post): ?>
<!--        <article>-->
<!--            <h2>--><?php //echo $post['title']; ?><!--</h2>-->
<!--            <p>--><?php //echo $post['content']; ?><!--</p>-->
<!--            --><?php //if (!empty($post['image'])): ?>
<!--                <img src="images/--><?php //echo $post['image']; ?><!--" alt="Post Image">-->
<!--            --><?php //endif; ?>
<!--            <p>Published on: --><?php //echo $post['date_published']; ?><!--</p>-->
<!--        </article>-->
<!--        <hr>-->
<!--    --><?php //endforeach; ?>
<!--</main>-->

</body>
</html>
