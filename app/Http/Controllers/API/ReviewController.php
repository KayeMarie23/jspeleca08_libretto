<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return response()->json(Review::with('book')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::create($request->only('book_id', 'review', 'rating'));

        return response()->json([
            'message' => 'Review created successfully!',
            'review' => $review
        ]);
    }

    public function show(Review $review)
    {
        return response()->json($review->load('book'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review->update($request->only('review', 'rating'));

        return response()->json([
            'message' => 'Review updated successfully!',
            'review' => $review
        ]);
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json(['message' => 'Review deleted successfully!']);
    }
}
