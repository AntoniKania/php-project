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
        $query = "SELECT id, title, content, photo_filename, CONVERT_TZ(publication_date, '+00:00', '+02:00') AS publication_date FROM post WHERE id = ?";
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
        $query = "SELECT id, title, content, photo_filename, CONVERT_TZ(publication_date, '+00:00', '+02:00') AS publication_date FROM post ORDER BY publication_date ASC LIMIT ? OFFSET ?";
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

    public function getAllPosts(): ?array
    {
        $query = "SELECT id, title, content, photo_filename, CONVERT_TZ(publication_date, '+00:00', '+02:00') AS publication_date  FROM post ORDER BY publication_date";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

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

    public function updateContent(Post $post): bool
    {
        $query = "UPDATE post SET content = :content WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':content', $post->getContent(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $post->getId(), PDO::PARAM_INT);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deletePostById($postId): bool
    {
        $query = "DELETE FROM post WHERE id = :postId";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':postId', $postId, PDO::PARAM_INT);

        try {
            return $statement->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createPost($title, $content, $photoFilename): int
    {
        $publicationDate = date('Y-m-d H:i:s');
        $photoFilename = $photoFilename == '' ? null : $photoFilename;

        $query = "INSERT INTO post (title, content, photo_filename, publication_date) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$title, $content, $photoFilename, $publicationDate]);

        return $this->pdo->lastInsertId();
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