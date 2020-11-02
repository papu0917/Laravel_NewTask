@extends('accountbook/layout')
@section('content')
    <div class="container" style="background: orange;height: 70px;">
        <div class="row">
        <h1>支出一覧</h1>
            @foreach ($totalPrices as $key => $totalPrice)
            <h2>{{ $key }}月の合計支出額は{{ $totalPrice }}円です。<h2>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="15%">購入日</th>
                                <th width="15%">購入品</th>
                                <th width="15%">金額</th>
                                <th width="15%">カテゴリ</th>
                                <th width="15%">タグ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $accountbook)
                                <tr>
                                    <th>{{ $accountbook->id }}</th>
                                    <th>{{ $accountbook->purchase_date->format('Y-m-d') }}</th>
                                    <td>{{ \Str::limit($accountbook->title, 100) }}</td>
                                    <td>{{ $accountbook->price }} 円</td>
                                    <td>{{ $accountbook->category->name }}</td>
                                    <td>
                                        @foreach ($accountbook->tags as $tag) {{ $tag->name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <div><a href="{{ action('AccountbookController@edit', ['id' => $accountbook->id]) }}"
                                                class="btn btn-success">編集</a>
                                            <a href="{{ action('AccountbookController@delete', ['id' => $accountbook->id]) }}"
                                                class="btn btn-danger">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container">
                <div class=" row">
                    <h1>支出をつけよう!</h1>
                    <div class="col-md-5pink">
                        <div class="row">
                            <div><a href="/accountbook/create" class="btn btn-warning">支出登録</a></div>
                            <div><a href="/accountbook/eachYear" class="btn btn-warning">過去の支出一覧</a></div>
                             <form action="{{ action('AccountbookController@amountMonthList') }}" method="get">
                            <label class="col-md">月別</label>
                                <select name="purcahse_date_month">
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
                    </div>
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
