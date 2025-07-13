<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('book')->get();
        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        $books = Book::all();
        return view('reviews.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'content' => 'required',
            'rating' => 'required|integer|between:1,5'
        ]);

        Review::create($request->all());
        return redirect()->route('reviews.index');
    }

    public function edit(Review $review)
    {
        $books = Book::all();
        return view('reviews.edit', compact('review', 'books'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'book_id' => 'required',
            'content' => 'required',
            'rating' => 'required|integer|between:1,5'
        ]);

        $review->update($request->all());
        return redirect()->route('reviews.index');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index');
    }
}
