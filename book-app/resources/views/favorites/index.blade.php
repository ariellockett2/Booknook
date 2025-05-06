@extends('layouts.app')

@section('title', 'Favorite Books Page')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    @if(session('success'))
        <div class="bg-indigo-500 text-white p-4 mb-4 rounded flex justify-center">
            {{ session('success') }}
        </div>
    @endif
    <h2 class="text-2xl font-semibold text-center mb-6">My Favorite Books</h2>

    @forelse($favorites as $fav)
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6 text-center">
            <h3 class="text-xl font-bold mb-1 text-indigo-500">{{ $fav->book_title }}</h3>

            <p class="text-gray-700 dark:text-gray-200 italic mb-3">
                by {{ $fav->author }}
            </p>

            @if($fav->book_image_url)
                <img src="{{ $fav->book_image_url }}" alt="{{ $fav->book_title }}" class="w-32 h-48 mx-auto mb-3 object-cover rounded" />
            @endif

            <p class="text-gray-500 dark:text-gray-300 mb-4">
                Favorited: {{ $fav->favorited_at->format('F j, Y g:i A') }}
            </p>

            <form method="POST" action="{{ route('favorites.destroy', $fav->book_id) }}">
                @csrf
                @method('DELETE')
                <x-primary-button type="submit">
                    Remove
                </x-primary-button>
            </form>
        </div>
        @empty
        <div class="text-center text-gray-800 dark:text-gray-800 mt-10">
            You haven't favorited any books yet.
        </div>
    @endforelse
</div>
@endsection


