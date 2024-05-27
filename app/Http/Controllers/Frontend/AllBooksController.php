<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AllBooksController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        $q = Book::query();
        $q->leftJoin('book_price', 'books.id', '=', 'book_price.book_id')
            ->where('books.status', '=', 1)
            ->where('book_price.status', '=', 1);
        $books = $q;
        $books = $books->paginate(12);
        $maxPrice = $this->getMaxPrice($q);

        return view('pages.books', compact(
            'genres',
            'books',
            'maxPrice'
        ));
    }

    public function search(Request $request){
        $que = "";
        if ($request->has('query')) {
            $que = $request->get('query');
        }
        $genres = Genre::all();
        $q = Book::query();
        $q->leftJoin('book_has_genres', 'book_has_genres.book_id', '=', 'books.id')
            ->leftJoin('genres', 'genres.id', '=', 'book_has_genres.genre_id')
            ->leftJoin('book_price', 'book_price.book_id', '=', 'books.id')
            ->where('books.name', 'like', '%' . $que . '%')
            ->where('books.status', '=', 1)
            ->where('book_price.status', '=', 1)
            ->select(
                'books.*',
                'book_price.book_price as book_price');
        $books = $q;
        $books = $books->paginate(12);
        $maxPrice = $this->getMaxPrice($q);

        return view('pages.books', compact(
            'genres',
            'books',
            'maxPrice',
            'que',
        ));
    }

    public function genreFilter($genre_slug)
    {
        $genres = Genre::all();
        $q = Book::query();
        $q->leftJoin('book_has_genres', 'book_has_genres.book_id', '=', 'books.id')
            ->leftJoin('genres', 'genres.id', '=', 'book_has_genres.genre_id')
            ->leftJoin('book_price', 'book_price.book_id', '=', 'books.id')
            ->where('genres.slug', '=', $genre_slug)
            ->where('books.status', '=', 1)
            ->where('book_price.status', '=', 1)
            ->select(
                'books.*',
                'book_price.book_price as book_price');
        $books = $q;
        $books = $books->paginate(12);
        $maxPrice = $this->getMaxPrice($q);

        return view('pages.books', compact(
            'genres',
            'books',
            'maxPrice'
        ));
    }

    public function authorFilter($author_slug)
    {
        $genres = Genre::all();
        $q = Book::query();
        $q->leftJoin('book_has_authors', 'book_has_authors.book_id', '=', 'books.id')
            ->leftJoin('authors', 'authors.id', '=', 'book_has_authors.author_id')
            ->leftJoin('book_price', 'book_price.book_id', '=', 'books.id')
            ->where('authors.slug', '=', $author_slug)
            ->where('books.status', '=', 1)
            ->where('book_price.status', '=', 1)
            ->select(
                'books.*',
                'book_price.book_price as book_price');
        $books = $q;
        $books = $books->paginate(12);
        $maxPrice = $this->getMaxPrice($q);

        return view('pages.books', compact(
            'genres',
            'books',
            'maxPrice',
        ));
    }

    public function getMaxPrice(Builder $books)
    {
        return $books
            ->select('book_price.book_price as book_price')
            ->orderBy('book_price.book_price', 'desc')
            ->first();
    }
}
