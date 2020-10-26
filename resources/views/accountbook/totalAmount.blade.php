@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            <h1>月/年別支出一覧</h1>
            <p>{{ $totalAmountMonth }}</p>
            <p>{{ $totalAmountYear }}</p>
        </div>
    </div>
@endsection
