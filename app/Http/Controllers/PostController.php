<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
     private $posts = [
        [
            'id' => 1,
            'title' => 'PHP',
            'description' => 'This is PHP description',
            'posted_by' => 'Ahmed',
            'created_at' => '2025-07-03 06:35:50'
        ],
        [
            'id' => 2,
            'title' => 'HTML',
            'description' => 'This is HTML description',
            'posted_by' => 'Ashraf',
            'created_at' => '2025-07-03 06:35:50'
        ],
        [
            'id' => 3,
            'title' => 'JAVA',
            'description' => 'This is JAVA description',
            'posted_by' => 'Ahmed',
            'created_at' => '2025-07-03 06:35:50'
        ],
        [
            'id' => 4,
            'title' => 'C#',
            'description' => 'This is C# description',
            'posted_by' => 'Mahmoud',
            'created_at' => '2025-07-03 06:35:50'
        ],
        [
            'id' => 5,
            'title' => 'C',
            'description' => 'This is C description',
            'posted_by' => 'Abdallah',
            'created_at' => '2025-07-03 06:35:50'
        ]
    ];

    public function index(){
                return response()->json($this->posts,200);
    }
    public function show($id){
        foreach ($this->posts as $post){
            if($post['id']== $id){
                return response()->json($post,200);}
        }
        return response()->json(['message'=>'no post found'],404);
    }
    public function store(Request $request){
        // dd($request->all());
        $newpost=[
            'id'=>count($this->posts)+ 1,
            'title'=>($request->title),
            'description'=>($request->description),
            'posted_by'=>($request->posted_by),
            'created_at'=>now()->format('Y-m-d H:i:s')
        ];
        return response()->json(['message'=>'post added successfully','post'=>$newpost],200);
    }
    public function update(Request $request, $id){
         foreach ($this->posts as $post){
            if($post['id']== $id){
                $post['title'] = $request->title;
                $post['description'] = $request->description;
                $post['posted_by'] = $request->posted_by;
                return response()->json(['message'=>'post updated successfully',$post],200);
                }
        }
        return response()->json(['message'=> 'posted not found'],404);
    }
    public function destroy($id){
        foreach ($this->posts as $post){
            if($post['id']== $id){
                return response()->json(['message'=> 'post deleted successfully'],201);
                };
               }
               return response()->json(['message'=> 'post not found'],404);
    }
        
}