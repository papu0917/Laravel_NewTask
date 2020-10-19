<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accountbook;
use App\Category;
use Carbon\Carbon;
use Auth;

class AccountbookController extends Controller
{
    public function index(Request $request)
    {
        $accountbooks = Accountbook::all();
        $accountbooks = Accountbook::latest()->get();
        $totalPrice = Accountbook::sum("price");

        return view('accountbook.index', ['accountbooks' => $accountbooks, 'totalPrice' => $totalPrice]);
    }

    public function add()
    {
        $categories = Category::all();

        return view('accountbook.create', compact('categories'));
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
        $categories = Category::all();

        return view('accountbook.edit', compact('accountbook', 'categories'));
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
