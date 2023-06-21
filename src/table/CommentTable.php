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
        $query = "
            SELECT c.id, c.content AS comment_content, c.comment_date,
                   u.id AS user_id, u.username, u.role,
                   p.id AS post_id, p.title, p.content AS post_content, p.photo_filename, p.publication_date
            FROM comment c 
            JOIN user u ON c.user_id = u.id
            JOIN post p ON c.post_id = p.id
            WHERE post_id = ?
        ";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$postId]);

        $comments = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($row['user_id'], $row['username'], $row['role']);

            $post = new Post(
                $row['post_id'],
                $row['title'],
                $row['post_content'],
                $row['photo_filename'],
                new DateTime($row['publication_date'])
            );

            $comment = new Comment(
                $row['id'],
                $row['comment_content'],
                new DateTime($row['comment_date']),
                $user,
                $post
            );

            $comments[] = $comment;
        }

        return $comments;
    }
}