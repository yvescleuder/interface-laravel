<?php

namespace App\Domain\UseCases\Post;

use App\Domain\Entity\CommentEntity;
use App\Domain\Entity\PostEntity;
use App\Domain\Repository\Post\IPostRepository;

class PostService implements IPostService
{
    public function __construct(
        private IPostRepository $repository,
        private PostEntity $entity
    ) {
    }

    public function create(string $title, string $description): PostEntity
    {
        $this->entity->setTitle($title);
        $this->entity->setDescription($description);

        $comment = new CommentEntity();
        $comment->setDescription('Um novo comentário');
        $this->entity->addComment($comment);

        return $this->repository->create($this->entity);
    }

    public function get(int $id): PostEntity
    {
        return $this->repository->get($id);
    }
}