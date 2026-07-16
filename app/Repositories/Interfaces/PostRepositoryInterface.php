<?php

namespace App\Repositories\Interfaces;
use App\Models\Post;

interface PostRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update(Post $post,array $data);
    public function delete($id);
}
