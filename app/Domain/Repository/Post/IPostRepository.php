<?php

namespace App\Domain\Repository\Post;

use App\Domain\Entity\PostEntity;

interface IPostRepository
{
    public function create(PostEntity $entity): PostEntity;

    public function get(string $id): PostEntity;
}