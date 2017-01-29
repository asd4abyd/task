<?php

namespace App\Http\Controllers;

use App\Category;
use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;


class ContentController extends Controller
{

    public function index() {

        $content = Content::with('category')->paginate(10);

        return view('admin.content.show', ['articles' => $content, 'locale' => App::getLocale()]);
    }

    public function addNew(Request $request) {


        return view('admin.content.add', [
            'old'=> array_merge([
                'category-id' => '',
                'title-en' => '',
                'title-ar' => '',
                'body-en' => '',
                'body-ar' => '',
                'excerpt-en' => '',
                'excerpt-ar' => '',
                'keywords' => '',
            ],
                $request->old()),
            'cates'=> Category::article(),
            'locale' => App::getLocale(),
            'title' => trans('page.add_new').' ('.trans('page.article').')'
        ]);
    }

    public function show($id, Request $request) {

        $article = Content::find($id);

        if(!$article) {
            return redirect('/content');
        }

        return view('admin.content.add', [
            'old'=> array_merge([
                'category-id' => $article->category_id,
                'title-en' => $article->title_en,
                'title-ar' => $article->title_ar,
                'body-en' => $article->body_en,
                'body-ar' => $article->body_ar,
                'excerpt-en' => $article->excerpt_en,
                'excerpt-ar' => $article->excerpt_ar,
                'keywords' => $article->keywords,
            ],
                $request->old()),
            'id' => $id,
            'cates'=> Category::article(),
            'locale' => App::getLocale(),
            'title' => trans('page.edit').' ('.trans('page.article').')'
        ]);
    }

    public function store(Request $request) {

        $validate = Validator::make($request->all(), [
            'title-en' => 'required|max:100',
            'title-ar' => 'required|max:100',
            'category-id' => 'required|numeric',
            'body-en' => 'required',
            'body-ar' => 'required',
            'excerpt_en' => 'max:100',
            'excerpt_ar' => 'max:100',
            'keywords' => 'max:255',
        ]);


        if($validate->fails()) {
            return redirect('/content/add')
                ->withInput($request->all())
                ->withErrors($validate);
        }

        $content = new Content();

        $content->category_id = $request->get('category-id');
        $content->title_en    = $request->get('title-en');
        $content->title_ar    = $request->get('title-ar');
        $content->body_en     = $request->get('body-en');
        $content->body_ar     = $request->get('body-ar');
        $content->excerpt_en  = $request->get('excerpt-en');
        $content->excerpt_ar  = $request->get('excerpt-ar');
        $content->keywords    = $request->get('keywords');


        $content->save();

        return redirect('/content');
    }

    public function update($id, Request $request) {

        $validate = Validator::make($request->all(), [
            'title-en' => 'required|max:100',
            'title-ar' => 'required|max:100',
            'category-id' => 'required|numeric',
            'body-en' => 'required',
            'body-ar' => 'required',
            'excerpt_en' => 'max:100',
            'excerpt_ar' => 'max:100',
            'keywords' => 'max:255',
        ]);


        if($validate->fails()) {
            return redirect('/content/'.$id)
                ->withInput($request->all())
                ->withErrors($validate);
        }

        $content = Content::find($id);

        $content->category_id = $request->get('category-id');
        $content->title_en    = $request->get('title-en');
        $content->title_ar    = $request->get('title-ar');
        $content->body_en     = $request->get('body-en');
        $content->body_ar     = $request->get('body-ar');
        $content->excerpt_en  = $request->get('excerpt-en');
        $content->excerpt_ar  = $request->get('excerpt-ar');
        $content->keywords    = $request->get('keywords');


        $content->save();
        return redirect('/content/');
    }

    public function destroy($id) {
        $article = Content::find($id);

        $article->delete();


        return redirect('/content');

    }

}
