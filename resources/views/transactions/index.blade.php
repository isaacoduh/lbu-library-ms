@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismiss">
                {{ session('success') }}
            </div>
        @endif
        <h1>Books List</h1>
    <table class="table table-light table-bordered">
        <tr>
            <th>Book Isbn</th>
            <th>Date Borrowed</th>
            <th>Date Returned</th>
            <th>Overdue</th>
            <th>Days Left</th>
            {{-- <th>Isbn</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>Copies</th> --}}
        </tr>
        @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->book_isbn }}</td>
                <td>{{ $transaction->date_borrowed }}</td>
                <td>{{ $transaction->date_returned }}</td>
                <td>{{ $transaction->overdue }}</td>
                <td>{{ $transaction->getDaysLeft() }}</td>
            </tr>
        @endforeach
    </table>
    </div>
@endsection