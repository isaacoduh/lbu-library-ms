<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Illuminate\Http\Request;
use Session;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('books.index', ['books' => $books]);
    }

    public function storeBookForm()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        // check that a book with that isbn is not already on record
        $bookExist = Book::where('isbn', $request->isbn)->first();

        if($bookExist){
            Session::flash('error', 'Book already exist with that ISBN');
            return redirect()->back()->with('error','Book already exist with that ISBN');
        }

        $book = new Book();
        $book->isbn = $request->isbn;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->year = $request->year;

        $book->save();
        Session::flash('success', 'Book added to library');
        return redirect()->route('books.index')->with('success','Book added to library');
    }
}
