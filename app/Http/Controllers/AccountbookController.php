<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accountbook;
use Auth;

class AccountbookController extends Controller
{
    public function index(Request $request)
    {
        $accountbooks = Accountbook::all();

        return view('accountbook.index', compact('accountbooks')); // resource/views/accountbook/index.blade.phpを表示する
    }

    public function add()
    {
        return view('accountbook.create');
    }

    public function create(Request $request)
    {
        $accountbook = new Accountbook;
        $form = $request->all();
        unset($form['_token']);
        $accountbook->fill($form);
        $accountbook->user_id = Auth::id();
        $accountbook->save();

        return redirect('accountbook');
    }

    public function delete(Request $request)
    {
        $accountbook = Accountbook::find($request->id);
        $accountbook->delete();

        return redirect('accountbook');
    }
}
