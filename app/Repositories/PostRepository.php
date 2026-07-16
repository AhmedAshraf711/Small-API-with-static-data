<?php

namespace App\Repositories;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Models\Post;
class PostRepository implements PostRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getAll()
    {
        return Post::with('user')->get();
    }
    public function getById($id)
    {
        return Post::with('user')->findOrFail($id);
    }
    public function create(array $data)
    {
        return Post::create($data);
    }
    public function update(Post $post,array $data)
    {
        $post->update($data);
        return $post;
    }
    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return $post;
    }
}
