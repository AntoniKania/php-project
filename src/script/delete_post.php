<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['postId'];

    if ($postTable->deletePostById($postId)) {
        $response = [
            'success' => true,
            'message' => 'Post deleted successfully.'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Failed to delete the post'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
