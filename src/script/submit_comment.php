<?php
require_once '../config.php';

$commentContent = $_POST['comment_content'];
$postId = $_POST['post_id'];
$userId = $_POST['user_id'];

$status = $commentTable->addComment($postId, $userId, $commentContent);

$response = [
    'success' => $status,
    'message' => 'Comment added successfully'
];
echo json_encode($response);
exit();
?>
