<?php
session_start();

require_once 'config.php';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $userRole = $_SESSION['role'];
} else {
    $username = "Guest";
}

/**
 * @var Post[] $posts
 */
$posts = $blogPostTable->getPosts(10);
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

<main>
    <?php foreach ($posts as $post): ?>
        <article>
            <h2><?php echo $post->getTitle(); ?></h2>
            <p><?php echo $post->getContent(); ?></p>
            <?php if (!empty($post->getPhotoFilename())): ?>
                <img src="images/<?php echo $post->getPhotoFilename(); ?>" alt="Post Image">
            <?php endif; ?>
            <p>Published on: <?php echo $post->getPublicationDate(); ?></p>
        </article>
        <hr>
    <?php endforeach; ?>
</main>

</body>
</html>
