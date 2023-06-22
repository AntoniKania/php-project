<?php
require_once '../config.php';

$postId = $_GET['postId'];

$comments = $commentTable->getCommentsByPostId($postId);

$commentData = [];
foreach ($comments as $comment) {
    $commentData[] = [
        'id' => $comment->getId(),
        'content' => $comment->getContent(),
        'comment_date' => $comment->getCommentDate()->format('Y-m-d H:i:s'),
        'username' => $comment->getUser() !== null ? $comment->getUser()->getUsername() : "Visitor"
    ];
}

$response = [
    'success' => true,
    'comments' => $commentData
];
echo json_encode($response);
exit();