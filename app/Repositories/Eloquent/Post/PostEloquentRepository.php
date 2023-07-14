<?php

namespace App\Repositories\Eloquent\Post;

use App\Domain\Entity\PostEntity;
use App\Domain\Repository\Post\IPostRepository;
use App\Models\Comment;
use App\Models\Post;

class PostEloquentRepository implements IPostRepository
{
    public function create(PostEntity $postEntity): PostEntity
    {
        $model              = new Post(); // Entidade Laravel
        $model->title       = $postEntity->getTitle();
        $model->description = $postEntity->getDescription();
        $model->save();

        foreach ($postEntity->getComments() as $commentEntity) {
            $commentModel              = new Comment(); // Entidade Laravel
            $commentModel->post_id     = $model->id;
            $commentModel->description = $commentEntity->getDescription();
            $commentModel->save();

            $commentEntity->setId($commentModel->id);
        }

        $postEntity->setId($model->id);

        return $postEntity;
    }

    public function get(string $id): PostEntity
    {
        $model = Post::query()->find($id);

        $entity = new PostEntity();
        $entity->setId($model->id);
        $entity->setTitle($model->title);
        $entity->setDescription($model->description);

        return $entity;
    }
}