<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author', 'genres')->get();
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book = Book::create($request->only(['title', 'author_id']));

        // Attach genres if provided
        if ($request->has('genre_ids')) {
            $book->genres()->attach($request->genre_ids);
        }

        return response()->json([
            'message' => 'Book created successfully!',
            'book' => $book
        ]);
    }

    public function show(Book $book)
    {
        return response()->json($book->load('author', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book->update($request->only(['title', 'author_id']));

        // Sync genres if provided
        if ($request->has('genre_ids')) {
            $book->genres()->sync($request->genre_ids);
        }

        return response()->json([
            'message' => 'Book updated successfully!',
            'book' => $book
        ]);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully!']);
    }
}