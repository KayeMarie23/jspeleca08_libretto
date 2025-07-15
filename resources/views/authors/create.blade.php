@extends('layouts.app')

@section('content')
<h4>{{ isset($author) ? 'Edit Author' : 'Add Author' }}</h4>

<form method="POST" action="{{ isset($author) ? route('web.authors.update', $author) : route('web.authors.store') }}">
    @csrf
    @if(isset($author)) @method('PUT') @endif

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $author->name ?? old('name') }}">
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($author) ? 'Update' : 'Save' }}</button>
</form>
@endsection
