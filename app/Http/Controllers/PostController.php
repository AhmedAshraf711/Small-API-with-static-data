<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
   
    public function index(){
        //$allposts= Post::with('user')->get();
        $allposts= $this->postRepository->getAll();
        return response()->json($allposts,200);
    }
    public function show($id){
        //$singlePost=Post::with('user')->findOrFail($id);
        $singlePost=$this->postRepository->getById($id);
        return response()->json($singlePost,200); 
    }
    public function store(Request $request){
            // $newpost = new Post;
            // $newpost->title = $request->title;
            // $newpost->description = $request->description;
            // $newpost->user_id = $request->user_id;
            // $newpost->save();
            $this->postRepository->create([
                'title'=> $request->title,
                'description'=> $request->description,
                'user_id'=> $request->user_id
            ]);
         return response()->json(['message'=>'post added successfully'],201);
    }
    public function update(Request $request, $id){
        // $post = Post::findOrFail($id);
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->user_id= $request->user_id;
        // $post->save();

        $this->postRepository->update($id,[
          'title'=> $request->title,
          'description'=> $request->description,
          'user_id'=> $request->user_id
        ]);
         return response()->json(['message'=>'post updated successfully'],201);
    }
    public function destroy($id)
    {
     
           $this->postRepository->delete($id);
           return response()->json(['message'=> 'post deleted successfully'],201);
    }
        
}