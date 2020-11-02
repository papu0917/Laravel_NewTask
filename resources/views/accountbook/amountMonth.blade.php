@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($prices as $key => $price)
                {{ $key }}月の合計支出額は{{ $price }}円です。
            @endforeach
        </div>
    </div>
@endsection
