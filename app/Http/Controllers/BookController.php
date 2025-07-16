<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'genres', 'reviews'])->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.create', compact('authors', 'genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'genres' => 'array'
        ]);

        $book = Book::create($request->only(['title', 'author_id']));
        $book->genres()->attach($request->genres);

        return redirect()->route('web.books.index');
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('books.edit', compact('book', 'authors', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'genres' => 'array'
        ]);

        $book->update($request->only(['title', 'author_id']));
        $book->genres()->sync($request->genres);

        return redirect()->route('web.books.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('web.books.index');
    }
}