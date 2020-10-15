<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accountbook;

class AccountbookController extends Controller
{
    public function index()
    {
        return view('accountbook.index'); // resource/views/accountbook/index.blade.phpを表示する
    }

    public function add()
    {
        return view('accountbook.create');
    }

    public function create(Request $request)
    {
        return redirect('accountbook/create');
    }
}
