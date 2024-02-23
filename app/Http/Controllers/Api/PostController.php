<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostCollection;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user', 'tags:id,name')->paginate();
        return $this->apiPaginatedResponse(new PostCollection($posts));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            "title" => ['required', "string", "min:10", "max:250"],
            "description" => ['required', "string", "min:10", "max:2500"],
            "image" => ["required", "image", "mimes:png,jpeg,jpg,gif,webp", "max:500000"],
            "user_id" => ["required", "numeric", "exists:users,id"],
            'tags' => ['array'],
            "tags.*" => ["required", "numeric", "exists:tags,id"]
        ]);
        $imagePath = $request->file('image')->store('images');
        $data['image'] = $imagePath;
        $post = Post::create($data);
        $post->tags()->sync($request->tags);
        return $this->apiResponse(new PostResource($post));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('tags:id,name', 'user:id,name,email');
        return $this->apiResponse(new PostResource($post));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            "title" => ['required', "string", "min:10", "max:250"],
            "description" => ['required', "string", "min:10", "max:2500"],
            "image" => ["nullable", "image", "mimes:png,jpeg,jpg,gif,webp", "max:500000"],
            "user_id" => ["required", "numeric", "exists:users,id"],
            'tags' => ['nullable', 'array'],
            "tags.*" => ["required", "numeric", "exists:tags,id"]
        ]);
        if ($request->image !== null) {
            $old_image = $post->image;
            $imagePath = $request->file('image')->store('images');
            $data['image'] = $imagePath;
            File::delete(public_path($old_image));
        }

        $post->update($data);
        $post->tags()->detach($post->tags);
        $post->tags()->sync($request->tags);
        // dd($post->tags);
        return $this->apiResponse(new PostResource($post));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return $this->apiResponse([], 202);
    }
}
