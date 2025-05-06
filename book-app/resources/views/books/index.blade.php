@extends('layouts.app')

@section('title', 'Book Search Results' . (isset($query) ? ' - ' . $query : ''))

@section('content')
 
<div class="py-6 max-w-6xl mx-auto">

    <form method="GET" action="{{ route('books.index') }}" class="mb-4">
        <x-text-input type="text" name="q" value="{{ $query }}" placeholder="Search Google Books..." class="border px-4 py-2 w-full rounded"/>
    </form>

    @isset($noInputMessage)
        <div class="alert alert-warning mb-4">
            {{ $noInputMessage }}
        </div>
    @endisset
    
    <x-text-input type="text" id="live-search" placeholder="Search displayed books..." class="border px-4 py-2 w-full rounded mb-4"/>

    <div id="book-list" >
        @include('books.partials.list', ['books' => $books])
    </div>

    <script>
        document.getElementById('live-search').addEventListener('input', function () {
            const query = this.value;

            fetch("{{ route('books.searchDisplayed') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ q: query })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('book-list').innerHTML = data.html;
            });
        });
    </script>
</div>
@endsection


