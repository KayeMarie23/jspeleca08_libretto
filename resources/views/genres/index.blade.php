
@extends('layouts.app')

@section('content')
<h4>Genres List</h4>
<a href="{{ route('genres.create') }}" class="btn btn-success btn-sm mb-2"><i class="bi bi-plus-circle"></i> Add Genre</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($genres as $genre)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $genre->name }}</td>
            <td>
                <a href="{{ route('genres.edit', $genre) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('genres.destroy', $genre) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="3">No Genres Found</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
