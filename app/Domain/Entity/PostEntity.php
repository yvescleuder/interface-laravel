<?php

namespace App\Domain\Entity;

class PostEntity
{
    protected int    $id;
    protected string $title;
    protected string $description;
    protected array  $comments;

    public function __construct()
    {
        $this->comments = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getComments(): array
    {
        return $this->comments;
    }

    public function addComment(CommentEntity $comment): void
    {
        $comment->setPost($this);
        $this->comments[] = $comment;
    }
}