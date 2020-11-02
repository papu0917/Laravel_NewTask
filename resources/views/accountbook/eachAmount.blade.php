@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            <h1>2020年</h1>
            <p>2020年の支出合計は{{ $totalAmountYear }} 円です</p>
        </div>
        <form action="{{ action('AccountbookController@amountMonth') }}" method="get">
            <label class="col-md-2">月別</label>
            <select name="purcahse_date_month">
                <option>選択してください</option>
                <option value="12" selected="selected">12月</option>
                <option value="11" selected="selected">11月</option>
                <option value="10" selected="selected">10月</option>
                <option value="9" selected="selected">9月</option>
                <option value="8" selected="selected">8月</option>
                <option value="7" selected="selected">7月</option>
                <option value="6" selected="selected">6月</option>
                <option value="5" selected="selected">5月</option>
                <option value="4" selected="selected">4月</option>
                <option value="3" selected="selected">3月</option>
                <option value="2" selected="selected">2月</option>
                <option value="1" selected="selected">1月</option>
            </select>
            <input type="submit" class="btn btn-primary" value="実行">
        </form>
         <form action="{{ action('AccountbookController@amountCategory') }}" method="get">
            <label class="col-md-2">カテゴリ別</label>
            <select name="category_id">
                <option>選択してください</option>
                <option value="2" selected="selected">食費</option>
                <option value="3" selected="selected">日用品</option>
                <option value="5" selected="selected">雑費</option>
                <option value="4" selected="selected">その他</option>
            </select>
            <input type="submit" class="btn btn-primary" value="実行">
        </form>
        <form action="{{ action('AccountbookController@amountTag') }}" method="get">
            <label class="col-md-2">タグ別</label>
            <select name="tag_id">
                <option>選択してください</option>
                <option value="3" selected="selected">その他</option>
                <option value="4" selected="selected">食料品</option>
                <option value="5" selected="selected">外食</option>
                <option value="6" selected="selected">生活消耗品</option>
                <option value="7" selected="selected">雑費</option>
                <option value="8" selected="selected">酒</option>
            </select>
            <input type="submit" class="btn btn-primary" value="実行">
        </form>
    </div>
@endsection
