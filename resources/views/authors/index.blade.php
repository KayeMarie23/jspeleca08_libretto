@extends('layouts.app')

@section('content')
    <h4>Authors List</h4>
    <a href="{{ route('authors.create') }}" class="btn btn-success btn-sm mb-2"><i class="bi bi-plus-circle"></i> Add Author</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Books</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($authors as $author)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $author->name }}</td>
                <td>{{ $author->books->count() }}</td>
                <td>
                    <a href="{{ route('authors.edit', $author) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4">No Authors Found</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
