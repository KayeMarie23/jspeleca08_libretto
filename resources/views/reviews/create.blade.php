@extends('layouts.app')

@section('content')
<h4>{{ isset($review) ? 'Edit Review' : 'Add Review' }}</h4>

<form method="POST" action="{{ isset($review) ? route('web.reviews.update', $review) : route('web.reviews.store') }}">
    @csrf
    @if(isset($review)) @method('PUT') @endif

    <div class="mb-3">
        <label>Book</label>
        <select name="book_id" class="form-control">
            @foreach($books as $book)
                <option value="{{ $book->id }}" {{ (isset($review) && $review->book_id == $book->id) ? 'selected' : '' }}>
                    {{ $book->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Content</label>
        <textarea name="content" class="form-control @error('content') is-invalid @enderror">{{ $review->content ?? old('content') }}</textarea>
        @error('content') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label>Rating</label>
        <input type="number" name="rating" class="form-control @error('rating') is-invalid @enderror" value="{{ $review->rating ?? old('rating') }}" min="1" max="5">
        @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($review) ? 'Update' : 'Save' }}</button>
</form>
@endsection
