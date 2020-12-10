@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main" style="padding: 30px 30px;">
            @foreach ($totalPriceThisMonth as $key => $value)
                <h1>{{ $key }}合計支出額は{{ $value }}円です。</h1>
            @endforeach
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
