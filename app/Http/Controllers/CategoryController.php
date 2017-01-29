<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $type = [
        'article',
        'product',
    ];


    public function index() {
        return redirect('/category/article');
    }

    public function show($type) {

        $validate = Validator::make(['type'=> $type], [
            'type' => 'required|in:' . implode(',', $this->type)
        ]);


        if($validate->fails()) {
            return redirect('/');
        }


        $cate = Category::where('type', array_search($type, $this->type))->get();


        return view('admin.categories', ['type'=>$type, 'categories' => $cate]);
    }

    public function store(Request $request) {

        $validate = Validator::make($request->all(), [
            'type' => 'required|in:' . implode(',', $this->type),
        ]);


        if($validate->fails()) {
            return redirect('/');
        }

        $validate = Validator::make($request->all(), [
            'name-en' => 'required',
            'name-ar' => 'required',
        ]);


        if($validate->fails()) {
            return redirect('/category/'.$request->get('type'))
                ->withInput()
                ->withErrors($validate);
        }

        $cate = new Category();

        $cate->name_en = $request->get('name-en');
        $cate->name_ar = $request->get('name-ar');
        $cate->type = array_search($request->get('type'), $this->type);

        $cate->save();

        return redirect('/category/'.$request->get('type'));
    }

    public function update($id, Request $request) {

        $validate = Validator::make($request->all(), [
            'type' => 'required|in:' . implode(',', $this->type),
        ]);


        if($validate->fails()) {
            return redirect('/');
        }

        $validate = Validator::make(array_merge($request->all(), ['id'=>$id]), [
            'id' => 'required|numeric',
            'e-name-en' => 'required',
            'e-name-ar' => 'required',
        ]);


        if($validate->fails()) {
            return redirect('/category/'.$request->get('type'))
                ->withInput()
                ->withErrors($validate);
        }

        $cate = Category::find($id);

        $cate->name_en = $request->get('e-name-en');
        $cate->name_ar = $request->get('e-name-ar');
        $cate->type = array_search($request->get('type'), $this->type);

        $cate->save();

        return redirect('/category/'.$request->get('type'));
    }

    public function destroy($id, Request $request) {


        $validate = Validator::make($request->all(), [
            'type' => 'required|in:' . implode(',', $this->type)
        ]);


        $cate = Category::find($id);

        $cate->delete();

        if($validate->fails()) {
            return redirect('/');
        }

        return redirect('/category/'.$request->get('type'));

    }

}
