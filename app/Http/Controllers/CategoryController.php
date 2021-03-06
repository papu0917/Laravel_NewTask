<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Accountbook;
use Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $categories = Category::where('user_id', $user->id)->get();

        return view('category.index', compact('categories'));
    }

    public function add()
    {
        return view('category.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, Category::$rules);
        $category = new Category;
        $form = $request->all();
        unset($form['_token']);
        $category->fill($form);
        $category->user_id = Auth::id();
        $category->save();

        return redirect('category/index');
    }

    public function edit(Request $request)
    {
        $category = Category::find($request->id);

        return view('category.edit', compact('category'));
    }

    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $category_form = $request->all();
        unset($category_form['_token']);

        $category->fill($category_form)->save();

        return redirect('category/index');
    }

    public function delete(Request $request)
    {
        $category = Category::find($request->id);
        $category->delete();

        return redirect('category/index');
    }
}
