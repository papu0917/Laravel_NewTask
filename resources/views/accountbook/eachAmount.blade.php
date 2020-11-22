@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h1>2020年</h1>
        </div>
        <div class="month_search">
            <form action="{{ route('accountbook.eachAmount.index') }}" method="get">
                <label class="col-md-2">月別合計</label>
                <div>
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
                    <input type="submit" class="btn btn-primary" value="実行">
                </div>
            </form>
        </div>
        <div class="category_search">
            <form action="{{ route('accountbook.eachAmount.amountCategory') }}" method="get">
                <label class="col-md-2">カテゴリ別合計</label>
                <div>
                    <select name="category_id">
                        <option>選択してください</option>
                        @foreach ($eachCategory as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <input type="submit" class="btn btn-primary" value="実行">
                </div>
            </form>
        </div>
        <form action="{{ route('accountbook.eachAmount.amountTag') }}" method="get">
            <label class="col-md-2">タグ別合計</label>
            <div>
                @foreach ($eachTag as $tag)
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->name }}
                @endforeach
                <input type="submit" class="btn btn-primary" value="実行">
            </div>
        </form>
    </div>
@endsection
