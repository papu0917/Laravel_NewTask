<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accountbook;
use App\Category;
use App\Tag;
use App\User;
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

    public function totalEachAmount(Request $request)
    {
        $totalEachAmount = Accountbook::whereYear('created_at', 2020)
            // ->whereMonth('created_at', 10)
            ->get()
            ->groupBy(function ($row) {
                return $row->created_at->format('m');
            })
            ->map(function ($day) {
                return $day->sum('price');
            });

        return view('accountbook.totalAmount', compact('totalEachAmount'));
    }

    public function add()
    {
        $tags = Tag::all();
        $categories = Category::all();

        return view('accountbook.create', compact('categories', 'tags'));
    }

    public function create(Request $request)
    {
        $accountbook = new Accountbook;
        $form = $request->all();
        unset($form['_token']);
        $accountbook->fill($form);
        $accountbook->user_id = Auth::id();
        $accountbook->save();
        $accountbook->tags()->attach($request->tags);

        return redirect('accountbook');
    }

    public function edit(Request $request)
    {

        $accountbook = Accountbook::find($request->id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('accountbook.edit', compact('accountbook', 'categories', 'tags'));
    }

    public function update(Request $request)
    {
        $accountbook = Accountbook::find($request->id);
        $accountbook_form = $request->all();
        unset($accountbook_form['_token']);

        $accountbook->fill($accountbook_form)->save();
        $accountbook->tags()->sync($request->tags);

        return redirect('accountbook');
    }

    public function delete(Request $request)
    {
        $accountbook = Accountbook::find($request->id);
        $accountbook->delete();

        return redirect('accountbook');
    }
}
