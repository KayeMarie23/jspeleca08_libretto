@extends('layouts.app')

@section('content')
<h4>{{ isset($book) ? 'Edit Book' : 'Add Book' }}</h4>

<form method="POST" action="{{ isset($book) ? route('books.update', $book) : route('books.store') }}">
    @csrf
    @if(isset($book)) @method('PUT') @endif

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $book->title ?? old('title') }}">
        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label>Author</label>
        <select name="author_id" class="form-control">
            @foreach($authors as $author)
                <option value="{{ $author->id }}" {{ (isset($book) && $book->author_id == $author->id) ? 'selected' : '' }}>
                    {{ $author->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Genres</label><br>
        @foreach($genres as $genre)
            <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
            @if(isset($book) && $book->genres->contains($genre->id)) checked @endif>
            {{ $genre->name }}<br>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($book) ? 'Update' : 'Save' }}</button>
</form>
@endsection
