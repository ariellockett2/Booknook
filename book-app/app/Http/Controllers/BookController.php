<?php

namespace App\Http\Controllers;

use App\Services\GoogleBooksService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Review;

class BookController extends Controller
{
    protected $books;

    public function __construct(GoogleBooksService $books)
    {
        $this->books = $books;
    }

    public function index(Request $request)
    {
        $query = $request->input('q', 'fiction');
        $books = [];

        if (empty(trim($query))) {
            $noInputMessage = 'Please enter a search term to find books.';
            return view('books.index', compact('noInputMessage', 'query', 'books'));
        }
        $apiKey = config('services.google_books.key');
        
        $maxResults = 40;
        $books = $this->books->search($query, $apiKey, $maxResults);
    
        session(['books' => $books]);
        return view('books.index', compact('books', 'query'));
    }
    



    public function show($id)
    {
        $response = Http::get("https://www.googleapis.com/books/v1/volumes/{$id}");

        if ($response->failed()) {
            abort(404, 'Book not found.');
        }

        $book = $response->json();

        $reviews = Review::with('user')
            ->where('book_id', $id)
            ->latest()
            ->get();

        $userFavorite = auth()->check()
            ? auth()->user()->favorites()->where('book_id', $id)->exists()
            : false;

        return view('books.show', compact('book', 'reviews', 'userFavorite'));
    }

    public function searchDisplayed(Request $request)
    {
        $query = strtolower($request->input('q'));
        $books = session('books', []);
    
        $filteredBooks = collect($books)->filter(function ($book) use ($query) {
            return str_contains(strtolower($book['volumeInfo']['title'] ?? ''), $query);
        });
    
        return response()->json([
            'html' => view('books.partials.list', ['books' => $filteredBooks])->render()
        ]);
    }    

}

