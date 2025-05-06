@extends('layouts.app')

@section('title', $book['volumeInfo']['title'] . ' | Book Review Page')

@section('content')
<div class="container mx-auto text-center py-6">
    @if(session('success'))
        <div class="bg-indigo-500 text-white p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif
    <h1 class="text-2xl font-bold mb-2">{{ $book['volumeInfo']['title'] }}</h1>
    <p class="text-xl mb-4">By {{ implode(', ', $book['volumeInfo']['authors'] ?? ['Unknown']) }}</p>

    @if(!empty($book['volumeInfo']['imageLinks']['thumbnail']))
        <img src="{{ $book['volumeInfo']['imageLinks']['thumbnail'] }}" alt="Book cover" class="mx-auto mb-4 w-48 h-auto">
    @endif

    @auth
        <div class="mb-4">
            @if($userFavorite)
                <form method="POST" action="{{ route('favorites.destroy', $book['id']) }}">
                    @csrf @method('DELETE')
                    <button class="btn btn-warning">Remove from Favorites</button>
                </form>
            @else
                <form method="POST" action="{{ route('favorites.store') }}">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book['id'] }}">
                    <input type="hidden" name="book_title" value="{{ $book['volumeInfo']['title'] }}">
                    <input type="hidden" name="author" value="{{ implode(', ', $book['volumeInfo']['authors'] ?? ['Unknown']) }}">
                    <button class="btn btn-primary">Add to Favorites</button>
                </form>
            @endif
        </div>
    @endauth

    <hr class="my-6">

    <h3 class="text-xl font-semibold mb-2">Reviews</h3>

    @auth
    <form method="POST" action="{{ route('reviews.store') }}" class="mb-6">
        @csrf
        <input type="hidden" name="book_id" value="{{ $book['id'] }}">
        <input type="hidden" id="ratingInput" name="rating" value="{{ old('rating', 0) }}">

        <!-- Rating -->
        <div class="mb-2">
            <label class="block mb-1 font-medium">Rating:</label>
            <div id="starRating" class="flex justify-center text-2xl text-gray-400 cursor-pointer">
                @for ($i = 1; $i <= 5; $i++)
                    <span data-value="{{ $i }}" class="star" 
                        style="color: {{ old('rating', 5) >= $i ? '#fbbf24' : 'gray' }};">
                        &#9734;
                    </span> {{-- hollow star --}}
                @endfor
            </div>
            <x-input-error :messages="$errors->get('rating')" class="mt-2 text-red-500" />
        </div>

        <!-- Review -->
        <div class="mb-2">
            <textarea name="body" class="form-control w-full p-2 border rounded" placeholder="Write your review...">{{ old('body') }}</textarea>
            <x-input-error :messages="$errors->get('body')" class="mt-2 text-red-500" />
        </div>

        <x-primary-button class="btn btn-success mt-3">Submit Review</x-primary-button>
    </form>
    @endauth


    @if($reviews->isEmpty())
        <p class="text-500 mt-4">No reviews yet for this book.</p>
    @else
        @foreach($reviews as $review)
        <div class="mt-4 bg-gray-100 p-4 rounded shadow w-full max-w-xl mx-auto text-left">
            <strong>{{ $review->user->name }}</strong>
            <p>{{ $review->body }}</p>
            <p class="text-yellow-500 text-lg">
                {!! str_repeat('&#9733;', $review->rating) !!} {{-- filled stars --}}
                {!! str_repeat('&#9734;', 5 - $review->rating) !!} {{-- unfilled stars --}}
            </p>
            <small class="text-gray-500">{{ $review->created_at->format('F j, Y g:i A') }}</small>

            @can('update', $review)
            <form method="POST" action="{{ route('reviews.update', $review) }}" class="mt-2">
                @csrf @method('PUT')
                <textarea name="body" class="form-control w-full">{{ $review->body }}</textarea>
                <select name="rating" class="form-select mt-1 w-full">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }} ★</option>
                    @endfor
                </select>
                <button class="btn btn-sm btn-outline-secondary mt-1">Update</button>
            </form>
            @endcan

            @can('delete', $review)
            <form method="POST" action="{{ route('reviews.destroy', $review) }}" class="mt-1">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
            </form>
            @endcan
        </div>
        @endforeach
    @endif
</div>

{{-- Star rating script --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('#starRating .star');
    const ratingInput = document.getElementById('ratingInput');

    const currentRating = parseInt(ratingInput.value);
    stars.forEach((star, index) => {
        star.innerHTML = index < currentRating ? '★' : '☆';
        star.classList.toggle('text-yellow-500', index < currentRating);
    });

    // Handle star click event
    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            ratingInput.value = index + 1;

            stars.forEach((s, i) => {
                s.innerHTML = i <= index ? '★' : '☆';
                s.classList.toggle('text-yellow-500', i <= index);
            });
        });
    });
});
</script>
@endsection

