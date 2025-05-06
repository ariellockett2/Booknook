<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request)
    { 
        $request->validate([
            'book_id' => 'required|string',
            'book_title' => 'required|string',
            'author' => 'required|string',
        ]);

        auth()->user()->favorites()->firstOrCreate([
            'book_id' => $request->book_id,
            'book_title' => $request->book_title,
            'author' => $request->author,
        ]);

        return back()->with('success', 'Book added to favorites!');
    }


    public function destroy($bookId)
    {
        auth()->user()->favorites()->where('book_id', $bookId)->delete();

        return back()->with('success', 'Book removed from favorites!');
    }

    public function index()
    {
        $favorites = auth()->user()->favorites()->latest('favorited_at')->get();
        return view('favorites.index', compact('favorites'));
    }

}
