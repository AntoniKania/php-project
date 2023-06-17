<?php

require_once 'config.php';

class BlogPostTable
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function getPostById($id): ?array
    {
        $query = "SELECT * FROM blog_post WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPosts($numberOfPosts, $startingFrom = 1): ?array
    {
        $query = "SELECT * FROM blog_post ORDER BY publication_date ASC LIMIT ? OFFSET ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$numberOfPosts, $startingFrom - 1]);

        $posts = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post(
                $row['id'],
                $row['title'],
                $row['content'],
                $row['photo_filename'],
                $row['publication_date']
            );

            $posts[] = $post;
        }

        return $posts;
    }
}