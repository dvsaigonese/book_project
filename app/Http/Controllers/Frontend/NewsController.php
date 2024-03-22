<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index(){
        $news = DB::table('news')->where('status', 1)->orderByDesc('created_at')->paginate(6);
        $lastest = DB::table('news')->where('status', 1)->orderByDesc('created_at')->take(3)->get();
        return view('pages.news', compact('news', 'lastest'));
    }

    public function show($slug){
        $news = News::where('slug', $slug)->first();
        return view('pages.show_news', compact('news'));
    }
}
