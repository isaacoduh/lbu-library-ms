@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>Books List</h1>
    <table class="table table-light table-bordered">
        <tr>
            <th>ID</th>
            <th>Isbn</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>Copies</th>
        </tr>
        @foreach($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->year }}</td>
                <td>{{ $book->copies }}</td>
            </tr>
        @endforeach
    </table>
    </div>
@endsection