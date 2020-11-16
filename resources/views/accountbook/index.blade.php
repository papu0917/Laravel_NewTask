@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main" style="padding: 30px 30px;">
            <h1>2020年の合計支出額は{{ $totalPriceThisMonth }}円です。</h1>
            <div class="col-md-12">
                <div class="row">
                    <table class="table table-striped">
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
                                        @foreach ($accountbook->tags as $tag)
                                            {{ $tag->name }}
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
        </div>
    </div>
@endsection
