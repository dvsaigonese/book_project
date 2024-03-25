<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index($book_slug)
    {
        $book = DB::table('books')
            ->where('books.slug', $book_slug)
            ->leftJoin('book_price', 'books.id', '=', 'book_price.book_id')
            ->where('book_price.status', '=', 1)
            ->select('books.*', 'book_price.book_price as book_price')
            ->first();
        $review = DB::table('rating')
            ->where('book_id', '=', $book->id)
            ->where('user_id', '=', Auth::id())
            ->first();
        if (auth()->check() && !isset($review)) {
            return view('pages.review', compact('book'));
        } elseif (auth()->check() && isset($review)) {
            return redirect()->back()->with('warning', 'You have already reviewed this book!');
        } else {
            return redirect()->route('account')->with('warning', 'If you want to review your favorite book, you must login first!');
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try {
            Rating::create($data);
            return redirect()->back()->with('success', 'Thanks for your feedback!');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            dd($e);
            if ($errorCode == '1062') {
                return redirect()->back()->with('error', 'You reviewed this before!');
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('warning', 'Server is busy, please try again later!');
        }
    }
}
