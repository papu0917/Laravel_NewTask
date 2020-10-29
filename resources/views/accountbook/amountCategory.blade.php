@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($categories as $key => $category)
 {{ $key }}の合計は{{$category}}円です。
@endforeach
        </div>
    </div>
@endsection