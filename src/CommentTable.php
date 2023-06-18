<?php

class CommentTable
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getCommentsByPostId($postId): ?array
    {
        $query = "SELECT * FROM comment WHERE blog_post_id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$postId]);

        $comments = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment(
                $row['id'],
                $row['content'],
                $row['publication_date'],
                $row['user_id'],
                $row['blog_post_id'],
            );
            $comments[] = $comment;
        }

        return $comments;
    }
}