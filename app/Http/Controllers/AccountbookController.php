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
        $totalPrice = Accountbook::sum("price");

        $cond_name = $request->cond_name;
        if ($cond_name != '') {
            $accountbooks->whereHas('category', function ($query) use ($cond_name) {
                $query->where('name', $cond_name);
            });
        }


        return view('accountbook.index', ['accountbooks' => $accountbooks, 'totalPrice' => $totalPrice, 'cond_name' => $cond_name]);
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
