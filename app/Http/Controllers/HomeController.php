<?php

namespace App\Http\Controllers;

use App;
use App\Category;
use App\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Content::orderBy('id', 'desc')->limit(6)->get();
        $cates = Category::all();


        return view('home', ['articles' => $articles, 'cates' => $cates, 'locale' => App::getLocale()]);
    }
}
