<?php

class Post {
    private int $id;
    private string $title;
    private string $content;
    private ?string $photoFilename;
    // todo: change type to Date
    private string $publicationDate;

    public function __construct($id, $title, $content, $photoFilename, $publicationDate) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->photoFilename = $photoFilename;
        $this->publicationDate = $publicationDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getPhotoFilename(): ?string
    {
        return $this->photoFilename;
    }

    public function getPublicationDate(): string
    {
        return $this->publicationDate;
    }
}