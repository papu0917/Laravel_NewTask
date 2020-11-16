<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accountbook;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Auth;

class AccountbookController extends Controller
{
    public function home(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now();
        $accountbookQuery = Accountbook::buildQueryByUser($user, $now);

        $totalPrices = $accountbookQuery->get()
            ->groupBy(function ($row) {
                return $row->purchase_date->format('Y-m');
            })
            ->map(function ($day) {
                return $day->sum('price');
            });
        $totalPriceThisMonth = $totalPrices->get($now->format('Y-m'));
        // $totalPriceThisMonth = $totalPrices[$now->format('Y-m')];
        $accountbooks = $accountbookQuery->paginate(10);

        return view('home', compact('totalPriceThisMonth', 'accountbooks', 'now'));
    }

    public function search(Request $request)
    {

        $user = Auth::user();
        $categories = Category::all();
        $tags = Tag::all();

        return view('accountbook.search', compact('categories', 'tags'));
    }

    public function searchResults(Request $request)
    {
        $user = Auth::user();
        $accountbookQuery = Accountbook::where('user_id', $user->id);

        if (!empty($request->purcahse_date_month)) {
            $accountbookQuery->whereYear('purchase_date', 2020)
                ->whereMonth('purchase_date', $request->purcahse_date_month);
        }

        if (!empty($request->category_id)) {
            $accountbookQuery->where('category_id', $request->category_id);
        }

        if (!empty($request->tags)) {
            $accountbookQuery->whereHas('tags', function ($query) use ($request) {
                $query->where('tags.id', $request->tags);
            });
        }

        $accountbooks = $accountbookQuery->get();
        $totalAmount = $accountbooks
            ->reduce(function ($current, $item) {
                return $current + $item->price;
            });

        return view('accountbook.searchResults', compact('totalAmount', 'accountbooks'));
    }


    public function amountMonth(Request $request)
    {
        $user = Auth::user();
        $accountbookQuery = Accountbook::totalAmountPrice($user);

        $totalPrices = $accountbookQuery->get()
            // ->whereMonth('purchase_date', $request->purcahse_date_month)
            ->groupBy(function ($row) {
                return $row->purchase_date->format('Y-m');
            })
            ->map(function ($day) {
                return $day->sum('price');
            });
        $totalPriceThisMonth = $totalPrices;
        // $totalPriceThisMonth = $totalPrices[$now->format('Y-m')];
        $accountbooks = $accountbookQuery->paginate(10);

        return view('accountbook.index', compact('totalPriceThisMonth', 'accountbooks', 'now'));
    }

    public function amountCategory(Request $request)
    {
        $accountbookByCategory = Accountbook::where('category_id', $request->category_id)
            ->get()
            ->groupBy(function ($row) {
                return $row->category->name;
            })
            ->map(function ($value) {
                return $value->sum('price');
            });

        $accountbooks = Accountbook::where('category_id', $request->category_id)
            ->get();

        return view('accountbook.amountCategory', compact('accountbookByCategory', 'accountbooks'));
    }

    public function amountTag(Request $request)
    {
        $accountbookByTag = Accountbook::whereHas('tags', function ($query) use ($request) {
            $query->where('tags.id', $request->tags);
        })->get()
            ->groupBy(function ($row) {
                return $row->tag;
            })
            ->map(function ($value) {
                return $value->sum('price');
            });

        $amountTagList = Accountbook::whereHas('tags', function ($query) use ($request) {
            $query->where('tags.id', $request->tags);
        });

        $results = $amountTagList->get();

        return view('accountbook.amountTag', compact('accountbookByTag', 'results'));
    }

    public function eachYear(Request $request)
    {
        return view('accountbook.eachYear');
    }

    public function eachAmount(Request $request)
    {
        $eachTag = Tag::all();;
        $eachCategory = Category::all();
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

        $totalAmountYear = Accountbook::whereYear('purchase_date', 2020)
            ->get()
            ->groupBy(function ($row) {
                return $row->purchase_date->format('y');
            })
            ->map(function ($day) {
                return $day->sum('price');
            })
            ->pop();
        return view('accountbook.eachAmount', compact('totalAmountMonth', 'totalAmountYear', 'eachCategory', 'eachTag'));
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

        return redirect('home');
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
