<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::all();

        return view('tag.index', compact('tags'));
    }

    public function add()
    {
        return view('tag.create');
    }

    public function create(Request $request)
    {
        $tag = new Tag;
        $form = $request->all();
        unset($form['_token']);
        $tag->fill($form);
        $tag->save();

        return redirect('tag');
    }

    public function edit(Request $request)
    {
        $tag = Tag::find($request->id);

        return view('tag.edit', compact('tag'));
    }

    public function update(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag_form = $request->all();
        unset($tag_form['_token']);

        $tag->fill($tag_form)->save();

        return redirect('tag');
    }

    public function delete(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag->delete();

        return redirect('tag');
    }
}
