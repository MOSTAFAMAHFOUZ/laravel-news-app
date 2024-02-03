<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

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
    public function home()
    {
        return view("posts.home");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|string|min:3|max:200',
            'description' => 'required|string|max:500',
            'user_id' => "required|exists:users,id"
        ]);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);
        return back()->with('success', 'Data Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("posts.show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("posts.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
