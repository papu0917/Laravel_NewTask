<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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

        $totalPrices = Accountbook::whereYear('purchase_date', 2020)
            ->whereMonth('purchase_date', Carbon::now())
            ->get()
            ->groupBy(function ($row) {
                return $row->purchase_date->format('m');
            })
            ->map(function ($day) {
                return $day->sum('price');
            });

        $accountbooks = Accountbook::whereMonth('purchase_date', Carbon::now());
        $accountbooks->orderBy('purchase_date', 'DESC');
        // $accountbooks->where('purchase_date', 'm');
        $posts = $accountbooks->paginate(10);

        return view('accountbook.index', compact('totalPrices', 'posts'));
    }

    public function amountMonthList(Request $request)
    {
        $totalPrices = Accountbook::whereYear('purchase_date', 2020)
            ->whereMonth('purchase_date', $request->purcahse_date_month)
            ->get()
            ->groupBy(function ($row) {
                return $row->purchase_date->format('m');
            })
            ->map(function ($day) {
                return $day->sum('price');
            });

        // $request->purcahse_date_monthを使うとページネーションがおかしくなる
        $accountbookList = Accountbook::whereMonth('purchase_date', $request->purcahse_date_month);
        $accountbookList->orderBy('purchase_date', 'DESC');
        $postsList = $accountbookList->paginate(10);

        return view('accountbook.amountMonthList', compact('totalPrices', 'postsList'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $accountbookQuery = Accountbook::where('user_id', $user->id);

        if (!empty($request->category_id)) {
            $accountbookQuery->where('category_id', $request->category_id);
        }
    }

    public function amountMonth(Request $request)
    {
        //変数名ごっちゃになってきてるから気をつけて。
        // dd($request);
        //　Carbon::now()は現在、過去の場合はどうする？　
        $prices = Accountbook::whereYear('purchase_date', 2020)
            ->whereMonth('purchase_date', $request->purcahse_date_month)
            ->get()
            ->groupBy(function ($row) {
                return $row->purchase_date->format('m');
            })
            ->map(function ($day) {
                return $day->sum('price');
            });

        return view('accountbook.amountMonth', compact('prices'));
    }

    public function amountCategory(Request $request)
    {
        $categories = Accountbook::where('category_id', $request->category_id)
            ->get()
            ->groupBy(function ($row) {
                return $row->category->name;
            })
            ->map(function ($value) {
                return $value->sum('price');
            });

        return view('accountbook.amountCategory', compact('categories'));
    }

    public function amountTag(Request $request)
    {
        $posts = Accountbook::whereHas('tags', function ($query) use ($request) {
            // slugをkeywordで検索
            $query->where('tags.id', $request->tags);
        })->get()
            ->groupBy(function ($row) {
                return $row->tag;
            })
            ->map(function ($value) {
                return $value->sum('price');
            });
        // dd($posts);

        return view('accountbook.amountTag', compact('posts'));
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
