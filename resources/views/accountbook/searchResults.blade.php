@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            <h1>絞り込み検索結果</h1>
            @foreach ($query as $key => $eachAmount)
                {{ $key }}の合計支出額は{{ $eachAmount }}円です。
            @endforeach

        </div>
    </div>
@endsection
