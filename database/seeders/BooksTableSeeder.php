<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create([
            'isbn' => '9789813221871',
            'title' => 'An Introduction To Component-Based Software Development',
            'author' => 'Lau Kung-Kiu',
            'year' => '2017',
            'copies' => 5
        ]);
    }
}
