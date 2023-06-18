<?php
require_once('config.php');

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$postId = $_GET['id'];

$post = $blogPostTable->getPostById($postId);

$comments = $commentTable->getCommentsByPostId($postId);

$previousPostId = $blogPostTable->getPreviousPostId($postId);
$nextPostId = $blogPostTable->getNextPostId($postId);

echo '<h2>' . $post->getTitle() . '</h2>';
echo '<p>' . $post->getContent() . '</p>';
echo '<p>Publication Date: ' . $post->getPublicationDate() . '</p>';

echo '<h3>Comments</h3>';
foreach ($comments as $comment) {
    echo '<div>';
    echo '<p>' . $comment->getContent() . '</p>';
    echo '<p>Author: ' . $comment->getUserId() . '</p>';
    echo '<p>Date: ' . $comment->getPublicationDate() . '</p>';
    echo '</div>';
}

echo '<div>';
if ($previousPostId !== null) {
    echo '<a href="post.php?id=' . $previousPostId . '">Previous Post</a> ';
}
if ($nextPostId !== null) {
    echo '<a href="post.php?id=' . $nextPostId . '">Next Post</a>';
}
echo '</div>';
?>
