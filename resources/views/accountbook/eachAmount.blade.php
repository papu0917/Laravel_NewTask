@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            <h1>2020年月別支出一覧</h1>
            <p>{{ $totalAmountMonth }} 円は月合計</p>
            <p>{{ $totalAmountYear }} 円は年合計</p>
        </div>
        <form action="{{ action('AccountbookController@amountMonth') }}" method="get">
            <select name="requests">
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
    </div>
@endsection
