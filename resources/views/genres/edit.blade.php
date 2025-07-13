@extends('layouts.app')

@section('content')
<h4>{{ isset($genre) ? 'Edit Genre' : 'Add Genre' }}</h4>

<form method="POST" action="{{ isset($genre) ? route('genres.update', $genre) : route('genres.store') }}">
    @csrf
    @if(isset($genre)) @method('PUT') @endif

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $genre->name ?? old('name') }}">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($genre) ? 'Update' : 'Save' }}</button>
</form>
@endsection
