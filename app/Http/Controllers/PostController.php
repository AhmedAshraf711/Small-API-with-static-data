<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\User;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;
    public function __construct(PostRepositoryInterface  $postRepository ) 
    {
        $this->postRepository = $postRepository;
    }
   
    public function index()
    {
         $allposts= $this->postRepository->getAll();
         return response()->json($allposts,200);
    }
    public function show($id)
    {
         $singlePost=$this->postRepository->getById($id);
         return response()->json($singlePost,200); 
    }
    public function store(StorePostRequest $validRequest)
    {
         $this->postRepository->create($validRequest->validated());
         return response()->json(['message'=>'post added successfully'],201);
    }
    public function update(UpdatePostRequest $validRequest, $id)
    {
         $this->postRepository->update($id, $validRequest->validated());
         return response()->json(['message'=>'post updated successfully'],201);
    }
    public function destroy($id)
    {
         $this->postRepository->delete($id);
         return response()->json(['message'=> 'post deleted successfully'],201);
    }
        
}
