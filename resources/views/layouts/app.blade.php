<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libretto CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="container mt-4">
        <h3>Libretto CRUD System</h3>

        <nav class="mb-3">
            <a href="{{ route('authors.index') }}" class="btn btn-outline-primary btn-sm">Authors</a>
            <a href="{{ route('books.index') }}" class="btn btn-outline-primary btn-sm">Books</a>
            <a href="{{ route('genres.index') }}" class="btn btn-outline-primary btn-sm">Genres</a>
            <a href="{{ route('reviews.index') }}" class="btn btn-outline-primary btn-sm">Reviews</a>
        </nav>

        @yield('content')

        <div class="text-center mt-4">
            <p>Return to Website: <a href="https://www.usjr.edu.ph/"><strong>University of San Jose - Recoletos</strong></a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
