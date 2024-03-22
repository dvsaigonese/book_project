<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $sliders = DB::table('sliders')
            ->where('status', 1)
            ->get();
        $books = DB::table('books')
            ->leftJoin('book_price', 'books.id', '=', 'book_price.book_id')
            ->where('books.status', '=', 1)
            ->where('book_price.status', '=', 1)
            ->orderByDesc('books.created_at')
            ->take(8)
            ->get();
        $news = DB::table('news')->where('status', 1)->orderByDesc('created_at')->take(4)->get();
        return view('pages.home', compact('sliders', 'books', 'news'));
    }
}
