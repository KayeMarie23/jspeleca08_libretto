<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        return response()->json(Genre::with('books')->get());
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $genre = Genre::create($request->only('name'));

        return response()->json([
            'message' => 'Genre created successfully!',
            'genre' => $genre
        ]);
    }

    public function show(Genre $genre)
    {
        return response()->json($genre->load('books'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate(['name' => 'required']);
        $genre->update($request->only('name'));

        return response()->json([
            'message' => 'Genre updated successfully!',
            'genre' => $genre
        ]);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return response()->json(['message' => 'Genre deleted successfully!']);
    }
}
