<?php

namespace App\Domain\Entity;

class CommentEntity
{
    protected int $id;

    protected string $description;

    protected PostEntity $post;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPost(): PostEntity
    {
        return $this->post;
    }

    public function setPost(PostEntity $post): void
    {
        $this->post = $post;
    }
}