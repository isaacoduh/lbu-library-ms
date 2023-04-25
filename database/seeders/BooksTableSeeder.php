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
        Book::create([
            'isbn' => '9781292097619',
            'title' => 'Fundamentals of database systems (7th edition)',
            'author' => 'Ramez Elmasri',
            'year' => '2016',
            'copies' => 5
        ]);
        Book::create([
            'isbn' => '9780262530910',
            'title' => 'Introduction To Algorithms',
            'author' => 'Thomas H. Cormen',
            'year' => '1990',
            'copies' => 5
        ]);
    }
}
