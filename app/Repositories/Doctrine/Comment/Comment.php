<?php

namespace App\Repositories\Doctrine\Comment;

use App\Repositories\Doctrine\Post\Post;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(type="string")
     */
    protected string $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Repositories\Doctrine\Post\Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * @var Post
     */
    protected Post $post;

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }

    public function getPost(): Post
    {
        return $this->post;
    }
}