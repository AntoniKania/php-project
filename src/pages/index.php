<?php
session_start();

require_once '../config.php';

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
$posts = $postTable->getPosts(10);

require_once 'header.php';
?>
<h1>Welcome to Blog</h1>
<?php foreach ($posts as $post): ?>
    <a href="post.php?id=<?php echo $post->getId(); ?>">
        <article>
            <h2><?php echo $post->getTitle(); ?></h2>
            <p><?php echo $post->getContent(); ?></p>
            <?php if (!empty($post->getPhotoFilename())): ?>
                <img src="../images/<?php echo $post->getPhotoFilename(); ?>" alt="Post Image">
            <?php endif; ?>
            <p>Published on: <?php echo $post->getPublicationDate()->format(DATE_FORMAT); ?></p>
        </article>
    </a>
<?php endforeach; ?>
<?php require_once 'footer.php' ?>
