<?php

namespace App\Traits;

use App\Models\Book;
use App\Models\BookHasAuthor;
use App\Models\BookHasGenre;
use App\Models\BookPrice;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


trait addBookDetails
{
    public function getIDLastBook()
    {
        $query = DB::table('books')
            ->select('*')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();
        return $query[0]->id;
    }

    public function addAuthor(Request $request)
    {
        $book_id = $this->getIDLastBook();
        $author_id = $request->input('author_id');
        foreach ($author_id as $author_id) {
            BookHasAuthor::create(['book_id' => $book_id, 'author_id' => $author_id]);
        }
    }

    public function addGenre(Request $request)
    {
        $book_id = $this->getIDLastBook();
        $genre_id = $request->input('genre_id');
        foreach ($genre_id as $genre_id) {
            BookHasGenre::create(['book_id' => $book_id, 'genre_id' => $genre_id]);
        }

    }

    public function addBookPrice(Request $request)
    {
        $book_id = $this->getIDLastBook();
        $price = $request->input('book_price');
        BookPrice::create([
            'book_id' => $book_id,
            'book_price' => $price,
            'status' => 1,
        ]);
    }

    public function handleBookPriceUpdate(Request $request, $id)
    {
        $book_price = BookPrice::where('book_id', $id)
            ->where('status', 1)
            ->first();
        $price_change = $request->input('book_price');

        if ($price_change != $book_price->book_price) {
            $book_price->update([
                'status' => 0,
                'end_at' => Carbon::now(),
            ]);

            BookPrice::create([
                'book_id' => $id,
                'book_price' => $price_change,
                'status' => 1,
            ]);
        }
    }
}
