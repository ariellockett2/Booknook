@if(count($books) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($books as $book)
            @if(!empty($book['volumeInfo']['imageLinks']['thumbnail']))
                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow text-center">
                    <img 
                        src="{{ $book['volumeInfo']['imageLinks']['thumbnail'] }}" 
                        alt="Cover" 
                        class="mx-auto mb-3 w-32 h-auto"
                    >

                    <h3 class="text-lg font-bold mb-1">
                        <a href="{{ route('books.show', $book['id']) }}" class="text-indigo-500 hover:underline">
                            {{ $book['volumeInfo']['title'] ?? 'Untitled' }}
                        </a>
                    </h3>

                    @if(!empty($book['volumeInfo']['authors']))
                        <p class="text-gray-300 mb-1">by {{ implode(', ', $book['volumeInfo']['authors']) }}</p>
                    @endif

                    @if(!empty($book['volumeInfo']['publisher']))
                        <p class="text-sm text-gray-300 mb-1">Publisher: {{ $book['volumeInfo']['publisher'] }}</p>
                    @endif

                    @if(!empty($book['volumeInfo']['publishedDate']))
                        <p class="text-sm text-gray-300">Published: {{ $book['volumeInfo']['publishedDate'] }}</p>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
@else
    <p class="text-black-700 mt-4">No books found matching your search.</p>
@endif
