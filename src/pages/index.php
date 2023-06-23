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
$posts = $postTable->getAllPosts();

require_once 'header.php';
?>
<div class="container">
    <h1>Welcome to Blog</h1>
    <?php foreach ($posts as $post): ?>
        <a href="post.php?id=<?php echo $post->getId(); ?>">
            <article class="card mb-3 shadow">
                <?php if (!empty($post->getPhotoFilename())): ?>
                    <img src="../images/<?php echo $post->getPhotoFilename(); ?>" class="card-img-top" alt="Post Image">
                <?php endif; ?>
                <div class="card-body">
                    <h2 class="card-title"><?php echo $post->getTitle(); ?></h2>
                    <p class="card-text"><?php echo truncateText($post->getContent(), 15); ?></p>
                    <p class="card-text">Published on: <?php echo $post->getPublicationDate()->format(DATE_FORMAT); ?></p>
                </div>
            </article>
        </a>
    <?php endforeach; ?>
</div>
<?php require_once 'footer.php' ?>

<?php
function truncateText($text, $limit, $suffix = '...') {
    $words = explode(' ', $text);
    if (count($words) > $limit) {
        $words = array_slice($words, 0, $limit);
        $text = implode(' ', $words) . $suffix;
    }
    return $text;
}
?>
