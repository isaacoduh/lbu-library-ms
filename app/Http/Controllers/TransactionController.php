<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Book;
use App\Models\Transaction;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


class TransactionController extends Controller
{
    public function myTransactions()
    {
        $transactions = Transaction::where('student_id', Auth::user()->id)->get();
        // Check if any transactions are found
        if ($transactions->count() > 0) {
            // Return view with transactions data
            return view('transactions.index', ['transactions' => $transactions]);
        } else {
            // Return view with empty transactions data
            return view('transactions.index', ['transactions' => null]);
        }
    }
    public function borrowForm(){
        return view('transactions.borrow');
    }

    public function borrowFormSubmit(Request $request){


        $request->validate([
            'isbn' => 'required'
            // Add any other validation rules for your book model fields
        ]);

        // check if book exist or copies is more than zero

        $book = Book::where('isbn', $request->input('isbn'))->first();

        if ($book) {
            // Book found, do something with it
            $transaction = new Transaction();
            $transaction->book_isbn = $book->isbn;
            $transaction->student_id = auth()->user()->id;
            $transaction->date_borrowed = now();
            $transaction->date_returned = null;
            $transaction->save();

            return redirect()->route('transactions.index')->with('success', 'Book borrowed successfully!');
            // Session::flash('success', 'Book Found successfully!');
        } else {
            // Book not found, display error message
            // return redirect()->back()->with('error', 'Book not found.');
            Session::flash('error', 'Book not found!');
            return redirect()->route('transaction.borrow');
        }

    }

    public function returnBookForm()
    {
        return view('transactions.returnbook');
    }

    public function returnBookFormSubmit(Request $request)
    {
        // find transaction where book isbn and studentId
        $transaction = Transaction::where('book_isbn', $request->isbn)
        ->where('student_id', Auth::user()->id)
        ->where('date_returned',null)
        ->first();

        if ($transaction) {
            $dateBorrowed = Carbon::parse($transaction->date_borrowed); // Parse the date_borrowed into a Carbon instance
            $dateReturned = Carbon::parse($transaction->date_returned); // Parse the date_returned into a Carbon instance
            $overdueDays = $dateReturned->diffInDays($dateBorrowed);
            // Update the transaction's date_returned and save
            $transaction->date_returned = now(); // Use the current date and time for date_returned
            $fine = 0; 

            if ($overdueDays > 7) {
                // Generate the fine (3 times the overdue days)
                $fine = $overdueDays * 3;
                $reference = Str::uuid();
                $transaction->save();
                // create a json payload to talk to the finance api
                $data = [
                    'reference' => $reference,
                    'amount' => $fine,
                    'type' => 'LIBRARY_FINE',
                    'status' => 'OUTSTANDING',
                    'account' => [
                        'studentId' => Auth::user()->username
                    ]
                ];
                $response = Http::post('http://host.docker.internal:4200/api/v1/invoices', $data);

                return redirect()->route('transactions.index')->with('success', "Invoice generated with reference: $reference, Amount: $fine USD. For your rental that is overdue by $overdueDays days");
                // Session::flash('success', "Invoice generated with reference: $reference, Amount: $fine USD. For your rental that is overdue by $overdueDays days");
                // dd($response);
                // if ($response->successful()) {
                //     // Process the response as needed
                    
                //     dd($response);
                //     // Return a success response
                //     Session::flash('success', "Invoice generated with reference: $reference, Amount: $fine USD. For your rental that is overdue by $overdueDays days");
                //     // return redirect()->route('transactions.index')->with('success', "Invoice generated with reference: $reference, Amount: $fine USD. For your rental that is overdue by $overdueDays days");
                //     // return response()->json(['message' => 'Overdue invoice sent successfully']);
                // } else {
                //     // Handle the API error response
                // }
            } else {
                $transaction->save();
                return redirect()->route('transactions.index')->with('success', 'Book returned successfully!');
            }
            

            
        } else {
            return redirect()->back()->with('error', 'Transaction not found.');
        }
    }
}
