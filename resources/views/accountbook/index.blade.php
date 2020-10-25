@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            <h2>購入品一覧</h2>
            <p>合計金額 : {{ $totalPrice }} 円</p>
        </div>
        <div class="row">
            <div class="list-accountbook col-md-12 mx-auto">
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
                            @foreach ($accountbooks as $accountbook)
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
                    <div><a href="/accountbook/create" class="btn btn-default">新規作成</a></div>
                    <div><a href="/accountbook/totalAmount" class="btn btn-default">月別支出額</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
