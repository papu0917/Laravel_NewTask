@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="header" style="background-color: #26d0c9;height: 90px; color: #fff;">
            <div class=" header-logo" style="float: left; font-size: 36px; padding: 20px 40px;">支出一覧</div>
            <div class="header-list" style="float: left; padding: 33px 20px;">
                <thead>
                    <tr>
                        <a href="/accountbook/create" class="btn btn-warning">支出登録</a>
                        <a href="/accountbook/eachYear" class="btn btn-warning">過去の支出一覧</a>
                        <a href="/accountbook/search" class="btn btn-warning">絞り込み</a>
                        <a href="/accountbook/search" class="btn btn-warning">予算設定</a>
                    </tr>
                </thead>
            </div>
        </div>
        <div class="main" style="padding: 30px 30px;">
            @foreach ($totalPrices as $key => $totalPrice)
                <h1>{{ $key }}月の合計支出額は{{ $totalPrice }}円です。</h1>
            @endforeach
            {{-- <p>{{ $attentionTag }}</p> --}}
            <div class="col-md-12">
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
            {{ $posts->links() }}
        </div>
    </div>
@endsection
