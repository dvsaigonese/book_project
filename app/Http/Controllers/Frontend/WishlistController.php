<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $wishlists = Wishlist::where('user_id', Auth::id())
                ->leftJoin('books', 'wishlists.book_id', '=', 'books.id')
                ->leftJoin('book_price', 'book_price.book_id', '=', 'books.id')
                ->paginate(10);
            return view('pages.wishlist', compact('wishlists'));
        } else {
            return redirect()->route('account')->with('warning', 'If you want to access your wishlist, you must login first!');
        }
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('warning', 'If you want to add something to your wishlist, you must login first!');
        } else {
            $request->merge(['user_id' => Auth::id()]);
            $data = $request->all();
            try {
                Wishlist::create($data);
                return redirect()->back()->with('success', 'Added to wishlist successfully!');
            } catch (\Illuminate\Database\QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if ($errorCode == '1062') {
                    return redirect()->back()->with('error', 'This book already exists in your wishlist!');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('warning', 'Server is busy, please try again later!');
            }
        }
    }

    public function destroy($book_id){
        try {
            DB::table('wishlists')
                ->where('book_id', $book_id)
                ->where('user_id', Auth::id())
                ->delete();
            return redirect()->back()->with('success', 'Removed from wishlist successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Server is busy, please try again later!');
        }
    }
}
