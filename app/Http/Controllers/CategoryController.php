<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        return view('category.index', compact('categories'));
    }

    public function add()
    {
        return view('category.create');
    }

    public function create(Request $request)
    {
        $category = new Category;
        $form = $request->all();
        unset($form['_token']);
        $category->fill($form);
        $category->save();

        return redirect('category');
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

        return redirect('category');
    }

    public function delete(Request $request)
    {
        $category = Category::find($request->id);
        $category->delete();

        return redirect('category');
    }
}
