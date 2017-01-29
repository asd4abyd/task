<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ArticleController extends Controller
{


    public function article($id) {
        $article = Content::find($id);

        if(!$article) {
            abort(404, 'Page Not Found');
        }


        return view('article', [
            'article' => $article,
            'locale' => App::getLocale(),
            'keyword' =>$article->keywords,
            'description' => $article->getAttribute('excerpt_'.App::getLocale())
        ]);
    }

    public function index() {

        $content = Content::orderBy('id', 'desc')->with('category')->paginate(10);

        return view('article_list', ['articles' => $content, 'locale' => App::getLocale()]);
    }

    public function show($id) {
        $content = Content::where('category_id', $id)->orderBy('id', 'desc')->with('category')->paginate(10);

        return view('article_list', ['articles' => $content, 'locale' => App::getLocale()]);
    }
}
