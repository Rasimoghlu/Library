<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\AuthorBook;
use App\Models\BookHouse;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Author::factory(50)->create();
        User::factory(50)->create();
        BookHouse::factory(50)->create();
        Book::factory(50)->create();
        AuthorBook::factory(50)->create();
    }
}
