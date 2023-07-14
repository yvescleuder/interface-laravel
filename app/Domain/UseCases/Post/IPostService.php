<?php

namespace App\Domain\UseCases\Post;

use App\Domain\Entity\PostEntity;

interface IPostService
{
    public function create(string $title, string $description): PostEntity;

    public function get(int $id): PostEntity;
}