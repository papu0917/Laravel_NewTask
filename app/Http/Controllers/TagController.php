<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Auth;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tags = Tag::where('user_id', $user->id);
        $results = $tags->get();

        return view('tag.index', compact('results'));
    }

    public function add()
    {
        return view('tag.create');
    }

    public function create(Request $request)
    {
        $tags = new Tag;
        $form = $request->all();
        unset($form['_token']);
        $tags->fill($form);
        $tags->user_id = Auth::id();
        $tags->save();

        return redirect('tag/index');
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

        return redirect('tag/index');
    }

    public function delete(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag->delete();

        return redirect('tag/index');
    }
}
