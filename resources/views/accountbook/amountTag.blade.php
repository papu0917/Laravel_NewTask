@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($accountbookByTag as $key => $amountTag)
                {{ $key }}の合計支出額は{{ $amountTag }}円です。
            @endforeach
        </div>
    </div>
@endsection