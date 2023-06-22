<?php
require_once '../config.php';

$postId = $_GET['postId'];
$post = $postTable->getPostById($postId);

$postData = [
    'id' => $post->getId(),
    'title' => $post->getTitle(),
    'content' => $post->getContent(),
    'photoFilename' => $post->getPhotoFilename(),
    'publicationDate' => $post->getPublicationDate()->format('Y-m-d H:i:s')
];

$response = [
    'success' => true,
    'post' => $postData
];

echo json_encode($response);
exit();