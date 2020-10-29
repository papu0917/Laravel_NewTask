@extends('accountbook/layout')
@section('content')
    <div class="container" style="background: orange;height: 70px;">
        <div class="row">
            <h1>支出一覧</h1>
            <p>合計金額 : {{ $totalAmount }} 円</p>
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
                            <div><a href="/accountbook/eachYear" class="btn btn-warning">カテゴリ別支出合計</a></div>
                        </div>
                    </div>
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
