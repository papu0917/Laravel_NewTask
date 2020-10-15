<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountbookController extends Controller
{
    public function index()
    {
        return view('accountbook.index'); // resource/views/accountbook/index.blade.phpを表示する
    }
}
