<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return response()->json(Author::with('books')->get());
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $author = Author::create($request->all());

        return response()->json([
            'message' => 'Author created successfully!',
            'data' => $author
        ], 201);
    }

    public function show(Author $author)
    {
        return response()->json($author->load('books'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate(['name' => 'required']);
        $author->update($request->all());

        return response()->json([
            'message' => 'Author updated successfully!',
            'data' => $author
        ]);
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json([
            'message' => 'Author deleted successfully!'
        ]);
    }
}