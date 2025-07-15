@extends('layouts.app')

@section('content')
<h4>Books List</h4>
<a href="{{ route('web.books.create') }}" class="btn btn-success btn-sm mb-2"><i class="bi bi-plus-circle"></i> Add Book</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genres</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($books as $book)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author->name }}</td>
            <td>
                @foreach($book->reviews as $review)
                <p>
                    <strong>Rating:</strong> {{ $review->rating }}<br>
                    <strong>Comment:</strong> {{ $review->content }}
                </p>
                @endforeach
                <a href="{{ route('web.books.edit', $book) }}" class="btn btn-primary btn-sm">Edit Book</a>

                <form action="{{ route('web.books.destroy', $book) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete Book</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No Books Found</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection