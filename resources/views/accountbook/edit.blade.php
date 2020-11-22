@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>購入品の編集</h2>
                <form action="{{ route('accountbook.edit') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">購入日</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="purchase_date"
                                value="{{ $accountbook->purchase_date }}">
                        </div>
                    </div>
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
                        <label class="col-md-2">カテゴリ</label>
                        <div class="col-md-10">
                            <select name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">タグ</label>
                        <div class="col-md-10">
                            @foreach ($tags as $tag)
                                <div class="form-check">
                                    @if ($accountbook->tags->search(function ($item, $key) use ($tag) {
            return $item->id == $tag->id;
        }) !== false)
                                        <input type="checkbox" name="tags[]" id="tag{{ $loop->iteration }}"
                                            value="{{ $tag->id }}" checked />
                                    @else
                                        <input type="checkbox" name="tags[]" id="tag{{ $loop->iteration }}"
                                            value="{{ $tag->id }}" />
                                    @endif
                                    <label for="tag{{ $loop->iteration }}">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $accountbook->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                            <a href="{{ route('accountbook.home') }}" role="button" class="btn btn-primary">戻る</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
