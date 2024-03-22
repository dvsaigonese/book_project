<?php

namespace App\Traits;

use App\Models\BookHasAuthor;
use App\Models\BookHasGenre;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

trait addBookDetails
{
    public function getIDLastBook(){
        $query = DB::table('books')
            ->select('*')
            ->orderBy('id','desc')
            ->limit(1)
            ->get();
        return $query[0]->id;
    }

    public function addAuthor(Request $request)
    {
        $book_id = $this->getIDLastBook();
        if ($request->has('author_id')) {
            $author_id = $request->input('author_id');
            foreach ($author_id as $author_id) {
                BookHasAuthor::create(['book_id' => $book_id, 'author_id' => $author_id]);
            }
        }
    }

    public function addGenre(Request $request)
    {
        $book_id = $this->getIDLastBook();
        if ($request->has('genre_id')) {
            $genre_id = $request->input('genre_id');
            foreach ($genre_id as $genre_id) {
                BookHasGenre::create(['book_id' => $book_id, 'genre_id' => $genre_id]);
            }
        }
    }


}
