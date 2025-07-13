@extends('layouts.app')

@section('content')
<h4>Books List</h4>
<a href="{{ route('books.create') }}" class="btn btn-success btn-sm mb-2"><i class="bi bi-plus-circle"></i> Add Book</a>

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
                @foreach($book->genres as $genre)
                    <span class="badge bg-info text-dark">{{ $genre->name }}</span>
                @endforeach
            </td>
            <td>
                <a href="{{ route('books.edit', $book) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5">No Books Found</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
