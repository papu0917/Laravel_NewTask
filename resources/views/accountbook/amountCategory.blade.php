@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($categories as $key => $category)
                <h1>2020年の{{ $key }}の合計は{{$category}}円です。</h1>
            @endforeach
        </div>
    </div>
@endsection