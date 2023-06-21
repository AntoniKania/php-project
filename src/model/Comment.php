<?php

require_once('../config.php');

class Comment {
    private int $id;
    private string $content;
    private DateTime $commentDate;
    private ?User $user;
    private Post $post;

    public function __construct($id, $content, $commentDate, $user, $post) {
        $this->id = $id;
        $this->content = $content;
        $this->commentDate = $commentDate;
        $this->user = $user;
        $this->post = $post;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCommentDate(): DateTime
    {
        return $this->commentDate;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getPost(): Post
    {
        return $this->post;
    }
}
