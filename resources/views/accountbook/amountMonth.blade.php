@extends('accountbook/layout')
@section('content')
    <div class="container" style="background: orange;height: 70px;">
        <div class="row">
            <h1>支出一覧</h1>
            @foreach ($prices as $key => $price)
                <h2>{{ $key }}月の合計支出額は{{ $price }}円です。<h2>
            @endforeach
        </div>
        <div class="row">
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
                            @foreach ($postsList as $accountbook)
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $postsList->links() }}
            </div>
        </div>
    </div>
@endsection
