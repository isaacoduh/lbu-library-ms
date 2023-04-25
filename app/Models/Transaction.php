<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the many-to-one relationship between Transaction and Book
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_isbn', 'isbn');
    }

    public function getOverdueAttribute() 
    {
        if($this->date_borrowed && $this->date_returned){

       
            $dateBorrowed = Carbon::parse($this->date_borrowed); // Parse the date_borrowed into a Carbon instance
            $dateReturned = Carbon::parse($this->date_returned); // Parse the date_returned into a Carbon instance
            return $overdueDays = $dateReturned->diffInDays($dateBorrowed);
        }
        return null;
    }

    public function getDaysLeft()
    {
        // Check if the transaction has a date_borrowed and date_returned
        if ($this->date_borrowed && !$this->date_returned) {
            // Calculate the due date as 7 days after the date_borrowed
            $dueDate = Carbon::parse($this->date_borrowed)->addDays(7);
            $now = Carbon::now();
            $daysLeft = $now->diffInDays($dueDate, false);

            // Return the number of days left, or null if not borrowed
            return max(0, $daysLeft);
        }

        return null;
    }
}
