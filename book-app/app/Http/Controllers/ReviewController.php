<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|string',
            'body' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ], [
            'body.required' => 'Please write a review.',
            'rating.required' => 'Please select a rating.',
        ]);

        auth()->user()->reviews()->create($request->only('book_id', 'body', 'rating'));

        return back()->with('success', 'Review submitted!');
    }

    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);

        $request->validate([ 
            'body' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review->update($request->only('body', 'rating'));

        return back()->with('success', 'Review updated!');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);

        $review->delete();

        return back()->with('success', 'Review deleted!');
    }

    
}
