@extends('layouts.app')

@section('content')
<h4>Reviews List</h4>
<a href="{{ route('web.reviews.create') }}" class="btn btn-success btn-sm mb-2"><i class="bi bi-plus-circle"></i> Add Review</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Book</th>
            <th>Content</th>
            <th>Rating</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($reviews as $review)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $review->book->title }}</td>
            <td>{{ $review->content }}</td>
            <td>{{ $review->rating }}</td>
            <td>
                <a href="{{ route('web.reviews.edit', $review) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('web.reviews.destroy', $review) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5">No Reviews Found</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
