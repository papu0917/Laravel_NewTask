@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>購入品の編集</h2>
                <form action="{{ action('AccountbookController@update') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">商品名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $accountbook->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">金額</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="price" value="{{ $accountbook->price }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $accountbook->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                            <a href="{{ action('AccountbookController@index') }}" role="button"
                                class="btn btn-primary">戻る</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
