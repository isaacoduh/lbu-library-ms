<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateBorrowed = Carbon::now()->subDays(rand(1,30));
        $dateReturned = $dateBorrowed->addDays(rand(1,30));

        $student = User::where('username', 'c12345601')->first();
        $book1 = Book::where('id',1)->first();
        $book2 = Book::where('id',2)->first();
        $book3 = Book::where('id',3)->first();
        // foreach($books as $book){
            
        //     Transaction::create([
        //         'student_id' => $student->id,
        //         'book_isbn' => $book->isbn,
        //         'date_borrowed' => $dateBorrowed,
        //         'date_returned' => $dateReturned,
        //     ]);
        // }

        Transaction::create([
            'student_id' => $student->id,
            'book_isbn' => $book1->isbn,
            'date_borrowed' => Carbon::now()->subDays(rand(14,30)),
            'date_returned' => null,
        ]);

        Transaction::create([
            'student_id' => $student->id,
            'book_isbn' => $book2->isbn,
            'date_borrowed' => Carbon::now()->subDays(rand(2,3)),
            'date_returned' => null,
        ]);

        Transaction::create([
            'student_id' => $student->id,
            'book_isbn' => $book3->isbn,
            'date_borrowed' => Carbon::now()->subDays(rand(43,58)),
            'date_returned' => null,
        ]);
    }
}
