<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
         $validData=$validRequest->validated();
         $user_id=Auth::user()->id;
         $validData['user_id']=$user_id;
         $this->postRepository->create($validData);
         return response()->json(['message'=>'post added successfully'],201);
    }
    public function update(UpdatePostRequest $validRequest, $id)
    { 
         $post=$this->postRepository->getById($id);
         Gate::authorize('update', $post);
         $validData=$validRequest->validated();
         $this->postRepository->update($post, $validData);
         return response()->json(['message'=>'post updated successfully'],200);
    }
    public function destroy($id)
    {
        $post=$this->postRepository->getById($id);
         Gate::authorize('delete', $post);
         $this->postRepository->delete($id);
         return response()->json(['message'=> 'post deleted successfully'],200);
    }
        
}
