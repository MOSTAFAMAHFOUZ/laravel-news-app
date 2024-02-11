<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::select('id', 'name')->paginate();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50'
        ]);
        Tag::create([
            'name' => $request->name
        ]);
        return back()->with('success', 'Data Added Successfully!');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::findOrFail($id);
        return view("tags.edit", ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag = Tag::findOrFail($id);
        request()->validate([
            'name' => 'required|string|max:200',
        ]);

        $tag->name = $request->name;
        $tag->save();
        return redirect()->route('tags.index')->with("success", "Data Updated Successfully !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Tag::findOrFail($id);
        $post->delete();
        return back()->with('success', 'Data Deleted Successfully !');
    }
}
