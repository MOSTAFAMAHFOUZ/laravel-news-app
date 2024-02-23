<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\Tag\TagCollection;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::paginate();
        return $this->apiPaginatedResponse(new TagCollection($tags));
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => ['required', 'unique:tags', 'string', 'min:3', "max:70"],
        ]);
        $tag = Tag::create($data);
        return $this->apiResponse(new TagResource($tag));
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return $this->apiResponse(new TagResource($tag), 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            "name" => ['required', 'string', 'min:3', "max:70", Rule::unique("tags")->ignore($tag->id)],
        ]);
        $tag->update($data);
        return $this->apiResponse(new TagResource($tag));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return $this->apiResponse([], 202);
    }
}
