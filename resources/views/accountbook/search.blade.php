@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form action="{{ action('AccountbookController@searchResults') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">月別</label>
                        <select name="purcahse_date_month">
                            <option>選択してください</option>
                            <option value="12">12月</option>
                            <option value="11">11月</option>
                            <option value="10">10月</option>
                            <option value="9">9月</option>
                            <option value="8">8月</option>
                            <option value="7">7月</option>
                            <option value="6">6月</option>
                            <option value="5">5月</option>
                            <option value="4">4月</option>
                            <option value="3">3月</option>
                            <option value="2">2月</option>
                            <option value="1">1月</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">カテゴリ</label>
                        <select name="category_id">
                            <option>選択してください</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">タグ</label>
                        <div class="col-md-10">
                            @foreach ($tags as $tag)
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->name }}
                            @endforeach
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="絞り込む">
                </form>
            </div>
        </div>
    </div>
@endsection
