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
        // $accountbooks = Accountbook::all();
        $accountbooks = Accountbook::select('accountbooks.*')
            ->orderBy('purchase_date', 'DESC')
            ->get();

        $totalAmount = Accountbook::sum("price");
        $posts = Accountbook::paginate(10);

        return view('accountbook.index', compact('accountbooks', 'totalAmount', 'posts'));
    }

    public function totalEachAmount(Request $request)
    {
        $totalAmountMonth = Accountbook::whereYear('purchase_date', 2020)
            ->whereMonth('purchase_date', 10)
            ->get()
            ->groupBy(function ($row) {
                return $row->purchase_date->format('m');
            })
            ->map(function ($day) {
                return $day->sum('price');
            })
            ->pop();
        // dd($totalEachAmount);

        $totalAmountYear = Accountbook::whereYear('purchase_date', 2020)
            ->get()
            ->groupBy(function ($row) {
                return $row->purchase_date->format('y');
            })
            ->map(function ($day) {
                return $day->sum('price');
            })
            ->pop();
        return view('accountbook.totalAmount', compact('totalAmountMonth', 'totalAmountYear'));
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
