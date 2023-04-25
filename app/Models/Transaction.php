<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
