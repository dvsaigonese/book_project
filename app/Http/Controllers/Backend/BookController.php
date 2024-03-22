<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookHasAuthor;
use App\Models\BookHasGenre;
use App\Models\Genre;
use App\Traits\CrudModel;

class BookController extends Controller
{
    use CrudModel;

    protected function model(): string
    {
        return Book::class;
    }

    protected function indexView(): string
    {
        return 'admin.book.book';
    }

    public function index()
    {
        return view('admin.book.book');
    }

    public function create()
    {
        $genre = Genre::all();
        $author = Author::all();
        return view('admin.book.create', compact('genre', 'author'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $author = BookHasAuthor::where('book_id', $id)
            ->leftJoin('authors', 'authors.id', '=', 'book_has_author.author_id')
            ->get();
        $genre = BookHasGenre::where('book_id', $id)
            ->leftJoin('genres', 'genres.id', '=', 'book_has_genre.genre_id')
            ->get();
        return view('admin.book.edit', compact('book', 'author', 'genre'));
    }

    public function addAuthorView($id){
        $book = Book::findOrFail($id);
        $author = Author::all();
        $book_has_author = BookHasAuthor::where('book_id', $id)
            ->leftJoin('authors', 'authors.id', '=', 'book_has_author.author_id');
        return view('admin.book.addAuthor', compact('author', 'book_has_author', 'book'));
    }

    public function addBookAuthor($book, $author){
        $book_has_author = new BookHasAuthor();
        $book_has_author->author_id = $author;
        $book_has_author->book_id = $book;
        $book_has_author->save();
        return redirect()->back()->with('success', 'Added author successfully!');
    }

    public function deleteBookAuthor($book, $author){
        $book_has_author = BookHasAuthor::where('book_id', $book)->where('author_id', $author);
        $book_has_author->delete();
        return redirect()->back()->with('success', 'Deleted author successfully!');
    }

    public function addGenreView($id){
        $book = Book::findOrFail($id);
        $genre = Genre::all();
        $book_has_genre = BookHasGenre::where('book_id', $id)
            ->leftJoin('genres', 'genres.id', '=', 'book_has_genre.genre_id');
        return view('admin.book.addGenre', compact('genre', 'book_has_genre', 'book'));
    }

    public function addBookGenre($book, $genre){
        $book_has_genre = new BookHasGenre();
        $book_has_genre->genre_id = $genre;
        $book_has_genre->book_id = $book;
        $book_has_genre->save();
        return redirect()->back()->with('success', 'Added genre successfully!');
    }

    public function deleteBookGenre($book, $genre){
        $book_has_genre = BookHasGenre::where('book_id', $book)->where('genre_id', $genre);
        $book_has_genre->delete();
        return redirect()->back()->with('success', 'Deleted genre successfully!');
    }
}
