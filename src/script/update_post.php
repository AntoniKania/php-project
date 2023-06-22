<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['postId'];
    $content = $_POST['content'];

    $post = $postTable->getPostById($postId);
    if (isset($post)) {
        $post->setContent($content);
        if ($postTable->updateContent($post)) {
            $response = [
                'success' => true,
                'message' => 'Post content updated successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to update the post'
            ];
        }


    } else {
        $response = [
            'success' => false,
            'message' => 'Post not found.'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
