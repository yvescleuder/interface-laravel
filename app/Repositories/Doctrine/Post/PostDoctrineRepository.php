<?php

namespace App\Repositories\Doctrine\Post;

use App\Domain\Entity\CommentEntity;
use App\Domain\Entity\PostEntity;
use App\Domain\Repository\Post\IPostRepository;
use App\Repositories\Doctrine\Comment\Comment;
use Doctrine\ORM\EntityRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;

class PostDoctrineRepository extends EntityRepository implements IPostRepository
{
    public function create(PostEntity $postEntity): PostEntity
    {
        $model = new Post(); // Entidade Doctrine
        $model->setTitle($postEntity->getTitle());
        $model->setDescription($postEntity->getDescription());

        EntityManager::persist($model);
        EntityManager::flush();

        /** @var CommentEntity $commentEntity */
        foreach ($postEntity->getComments() as $commentEntity) {
            $commentModel = new Comment(); // Entidade Doctrine
            $commentModel->setPost($model);
            $commentModel->setDescription($commentEntity->getDescription());

            EntityManager::persist($commentModel);
            EntityManager::flush();

            $model->addComment($commentModel);
            $commentEntity->setId($commentModel->getId());
//            $postEntity->addComment($commentEntity);
        }

        $postEntity->setId($model->getId());

        return $postEntity;
    }

    public function get(string $id): PostEntity
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.id = :id')
            ->leftJoin('p.comments', 'c')
            ->orderBy('p.title', 'asc')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getSingleResult();
    }
}