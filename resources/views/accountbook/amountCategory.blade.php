@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($accountbookByCategory as $key => $categoryAmount)
                <h1>2020年の{{ $key }}の合計は{{ $categoryAmount }}円です。</h1>
            @endforeach
        </div>
    </div>
@endsection