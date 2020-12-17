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

        return view('accountbook.home', compact('totalPriceThisMonth', 'accountbooks', 'now'));
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
        $accountbookQuery = Accountbook::totalAmountPrice($user, $request);

        $totalPrices = $accountbookQuery->get()
            ->groupBy(function ($row) {
                return $row->purchase_date->format('Y年/m');
            })
            ->map(function ($day) {
                return $day->sum('price');
            });
        $totalPriceThisMonth = $totalPrices;
        // $totalPriceThisMonth = $totalPrices[$now->format('Y-m')];
        $accountbooks = $accountbookQuery->get();

        return view('accountbook.index', compact('totalPriceThisMonth', 'accountbooks'));
    }

    public function amountCategory(Request $request)
    {
        $user = Auth::user();
        $accountbookByCategory = Accountbook::totalAmountCategory($user, $request);

        $accountbookPrice = $accountbookByCategory->get()
            ->groupBy(function ($row) {
                return $row->category->name;
            })
            ->map(function ($value) {
                return $value->sum('price');
            });

        $accountbooks = $accountbookByCategory->get();

        return view('accountbook.amountCategory', compact('accountbookByCategory', 'accountbooks', 'accountbookPrice'));
    }

    public function amountTag(Request $request)
    {
        $user = Auth::user();
        $accountbookByTag = Accountbook::totalAmountTag($user, $request);

        $accountbookPrice = $accountbookByTag
            ->whereHas('tags', function ($query) use ($request) {
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
        $results = $accountbookByTag->get();

        return view('accountbook.amountTag', compact('accountbookByTag', 'results', 'accountbookPrice'));
    }

    public function eachYear()
    {
        return view('accountbook.eachYear');
    }

    public function eachAmount(Request $request)
    {

        $eachTag = Tag::all();;
        $eachCategory = Category::all();

        return view('accountbook.eachAmount', compact('eachCategory', 'eachTag'));
    }

    public function add()
    {
        $user = Auth::user();
        $accountbookByTags = Tag::where('user_id', $user->id);
        $tags = $accountbookByTags->get();
        $categorie = Category::where('user_id', $user->id);
        $categories = $categorie->get();


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
        // dd($request->id);
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
