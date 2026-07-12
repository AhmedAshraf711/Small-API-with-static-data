<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
class PostController extends Controller
{
   
    public function index(){
        $allposts= Post::with('user')->get();
        return response()->json($allposts,200);
    }
    public function show($id){
        $singlePost=Post::with('user')->findOrFail($id);
        return response()->json($singlePost,200); 
    }
    public function store(Request $request){
            $newpost = new Post;
            $newpost->title = $request->title;
            $newpost->description = $request->description;
            $newpost->user_id = $request->user_id;
            $newpost->save();
        return response()->json(['message'=>'post added successfully'],201);
    }
    public function update(Request $request, $id){
         $post = Post::findOrFail($id);
         $post->title = $request->title;
         $post->description = $request->description;
         $post->user_id= $request->user_id;
         $post->save();
         return response()->json(['message'=>'post updated successfully',$post],200);
    }
    public function destroy($id){
     
           $post = Post::findOrFail($id);
           $post->delete();
           return response()->json(['message'=> 'post deleted successfully'],201);
    }
        
}