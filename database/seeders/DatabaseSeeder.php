<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Book;
use App\Models\BookHasAuthor;
use App\Models\BookHasGenre;
use App\Models\BookPrice;
use App\Models\Cart;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Author::factory(100)->create();
        $this->call([PositionSeeder::class]);
        User::factory(30)->create();
        //Bill::factory(100)->create();
        Genre::factory(10)->create();
        Book::factory(100)->create()->each(function ($book) {
            BookPrice::create([
                'book_price' => fake()->numberBetween(20000, 1000000),
                'status' => 1,
                'end_at' => null,
                'book_id' => $book->id,
            ]);
            BookHasGenre::create([
                'book_id' => $book->id,
                'genre_id' => Genre::all()->random()->id,
            ]);
        });
        //BillDetail::factory(500)->create();
        BookHasAuthor::factory(100)->create();
        Cart::factory(50)->create();
        Rating::factory(50)->create();
        Wishlist::factory(50)->create();
    }
}
