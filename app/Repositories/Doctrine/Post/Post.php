<?php

namespace App\Repositories\Doctrine\Post;

use App\Repositories\Doctrine\Comment\Comment;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 */
class Post
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
    protected string $title;

    /**
     * @ORM\Column(type="string")
     */
    protected string $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Repositories\Doctrine\Comment\Comment", mappedBy="post", cascade={"persist"})
     * @var ArrayCollection
     */
    protected $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function addComment(Comment $comment): void
    {
        if (!$this->comments->contains($comment)) {
            $comment->setPost($this);
            $this->comments->add($comment);
        }
    }

    public function getComments(): ArrayCollection
    {
        return $this->comments;
    }
}