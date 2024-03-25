<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

class  DetailsController extends Controller
{
    public function show($slug)
    {
        $book = DB::table('books')
            ->where('books.slug', $slug)
            ->leftJoin('book_price', 'books.id', '=', 'book_price.book_id')
            ->where('book_price.status', '=', 1)
            ->select('books.*', 'book_price.book_price as book_price')
            ->first();
        $genres = DB::table('books')
            ->where('books.slug', $slug)
            ->leftJoin('book_has_genre', 'books.id', '=', 'book_has_genre.book_id')
            ->leftJoin('genres', 'genres.id', '=', 'book_has_genre.genre_id')
            ->select('genres.*')
            ->get();
        $authors = DB::table('books')
            ->where('books.slug', $slug)
            ->leftJoin('book_has_author', 'books.id', '=', 'book_has_author.book_id')
            ->leftJoin('authors', 'authors.id', '=', 'book_has_author.author_id')
            ->select('authors.*')
            ->get();
        $reviews = DB::table('books')
            ->where('books.slug', $slug)
            ->leftJoin('rating', 'books.id', '=', 'rating.book_id')
            ->select('rating.*')
            ->paginate(4);
        $score = DB::table('books')
            ->where('books.slug', $slug)
            ->leftJoin('rating', 'books.id', '=', 'rating.book_id')
            ->avg('rating.score');
        $related = DB::table('books')
            ->leftJoin('book_price', 'books.id', '=', 'book_price.book_id')
            ->where('books.status', '=', 1)
            ->where('book_price.status', '=', 1)
            ->orderByRaw('RAND()')
            ->take(4)
            ->get();
        return view('pages.details',
            compact(
                'book',
                'genres',
                'authors',
                'reviews',
                'score',
                'related'));
    }
}
