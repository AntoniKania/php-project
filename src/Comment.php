<?php

require_once('config.php');

class Comment {
    private $id;
    private $content;
    private $publicationDate;
    private $userId;
    private $blogPostId;

    public function __construct($id, $content, $publicationDate, $userId, $blogPostId) {
        $this->id = $id;
        $this->content = $content;
        $this->publicationDate = $publicationDate;
        $this->userId = $userId;
        $this->blogPostId = $blogPostId;
    }

    public function getId() {
        return $this->id;
    }

    public function getContent() {
        return $this->content;
    }


    public function getPublicationDate() {
        return $this->publicationDate;
    }


    public function getUserId() {
        return $this->userId;
    }


    public function getBlogPostId() {
        return $this->blogPostId;
    }
}
