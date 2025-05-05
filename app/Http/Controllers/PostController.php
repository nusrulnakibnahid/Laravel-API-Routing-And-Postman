<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Post::all();

        $posts = Post::all();

        // return PostResource::collection($posts);

        return response()->json([
            'data' => $posts,
            'message' => 'success',
            'status' => 200 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'body' => 'required',
            ]);


             if($validator->fails()){
            return $validator->errors();
 
        }
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);


        // return $post;
        return response()->json([
            'data' => $post,
            'message' => 'Post Created Successfully',
            'status' => 201 
        ] ); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if(!$post){
            return "Post not found";
            
        }
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        if(!$post){
            return "Post not found";
            
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required',
        ]);


         if($validator->fails()){
        return $validator->errors();

    }
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return $post;
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if(!$post){
            return "Post not found";
            
        }
        $post->delete();

        return "Post deleted successfully";
    }
}
