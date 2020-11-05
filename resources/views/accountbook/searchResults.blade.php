@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            <h1>絞り込み検索結果</h1>
            <p> {{ $query }} </p>
        </div>
    </div>
@endsection
