<?php

require_once '../config.php';

class PostTable
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getPostById($id): ?Post
    {
        $query = "SELECT * FROM post WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Post(
            $row['id'],
            $row['title'],
            $row['content'],
            $row['photo_filename'],
            new DateTime($row['publication_date'])
        );
    }

    public function getPosts($numberOfPosts, $startingFrom = 1): ?array
    {
        $query = "SELECT * FROM post ORDER BY publication_date ASC LIMIT ? OFFSET ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$numberOfPosts, $startingFrom - 1]);

        $posts = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post(
                $row['id'],
                $row['title'],
                $row['content'],
                $row['photo_filename'],
                new DateTime($row['publication_date'])
            );

            $posts[] = $post;
        }

        return $posts;
    }

    public function getPreviousPostId($postId): ?int
    {
        $query = "SELECT id FROM post WHERE id < :postId ORDER BY id DESC LIMIT 1";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':postId', $postId, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result !== false) {
            return $result['id'];
        }

        return null;
    }

    public function getNextPostId($postId): ?int
    {
        $query = "SELECT id FROM post WHERE id > :postId ORDER BY id ASC LIMIT 1";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':postId', $postId, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result !== false) {
            return $result['id'];
        }

        return null;
    }
}