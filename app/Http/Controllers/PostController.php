<?php

namespace App\Http\Controllers;

use File;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy("created_at", "desc")->paginate(20);

        return view("posts.index", ['posts' => $posts]);
    }


    /**
     * Display a listing of the resource.
     */


    public function search(Request $request)
    {
        $posts = Post::where("description", "LIKE", "%" . $request->q . "%")->paginate(20)->withQueryString();
        return view("posts.home", ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();
        return view("posts.add", ['users' => $users, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|string|min:3|max:200',
            'description' => 'required|string|max:3500',
            'user_id' => "required|exists:users,id",
            'image' => ['required', 'image', 'mimes:png,jpeg,jpg,jif,webp', 'max:20048']
        ]);

        $imagePath = $request->file('image')->store('images');
        // dd($imagePath);
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'image' => $imagePath
        ]);
        // dd($request->tags);
        $post->tags()->sync($request->tags);
        return back()->with('success', 'Data Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view("posts.show", ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $users = User::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();


        return view("posts.edit", ['post' => $post, 'users' => $users, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Gate::authorize('update', Post::class);
        $post = Post::findOrFail($id);
        request()->validate([
            'title' => 'required|string|min:3|max:200',
            'description' => 'required|string|max:15000',
            'user_id' => "required|exists:users,id",
            'image' => ['nullable', 'image', 'mimes:png,jpeg,jpg,jif,webp', 'max:20048']
        ]);

        $old_image = $post->image;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        if ($request->image !== null) {
            $imagePath = $request->file('image')->store('images');
            $post->image = $imagePath;
            File::delete(public_path($old_image));
        }
        $post->save();


        $post->tags()->detach($request->tags);
        $post->tags()->sync($request->tags);


        return redirect()->route('posts.index')->with("success", "Data Updated Successfully !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return back()->with('success', 'Post Deleted Successfully !');
    }
}



      // foreach ($posts as $post) {
        //     $i = 1;
        //     for ($i = 1; $i <= 3; $i++) {
        //         DB::table('post_tag')->insert([
        //             'post_id' => $post->id,
        //             'tag_id' => $i
        //         ]);
        //     }
        // }
