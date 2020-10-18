<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accountbook;
use Carbon\Carbon;
use Auth;

class AccountbookController extends Controller
{
    public function index(Request $request)
    {
        $accountbooks = Accountbook::all();
        $totalPrice = Accountbook::sum("price");

        return view('accountbook.index', compact('accountbooks', 'totalPrice')); // resource/views/accountbook/index.blade.phpを表示する
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

    public function edit(Request $request)
    {
        $accountbook = Accountbook::find($request->id);

        return view('accountbook.edit', compact('accountbook'));
    }

    public function update(Request $request)
    {
        $accountbook = Accountbook::find($request->id);
        $accountbook_form = $request->all();
        unset($accountbook_form['_token']);

        $accountbook->fill($accountbook_form)->save();

        return redirect('accountbook');
    }

    public function delete(Request $request)
    {
        $accountbook = Accountbook::find($request->id);
        $accountbook->delete();

        return redirect('accountbook');
    }
}
