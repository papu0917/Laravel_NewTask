@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="priceList" style="margin-top: 10px; margin-bottom: 30px;　border-bottom: 1px solid gray;">
            <h1>{{ $now->format('Y年m月') }}の合計支出額は{{ $totalPriceThisMonth }}円です。</h1>
            <script>
                document.write("こんにちは");

            </script>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <table class="table-striped">
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
                                    <div>
                                        <a href="{{ route('accountbook.edit', ['id' => $accountbook->id]) }}"
                                            class="btn btn-success">編集</a>
                                        <a href="{{ route('accountbook.delete', ['id' => $accountbook->id]) }}"
                                            class="btn btn-danger">削除</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="menubox-left" style="width: 150px;">
                        <dl class="areamenu areamenu--ex">
                            <dt class="ui-sprite--menu_rent"
                                style="background-position: -386px 0px; width: 245px;height: 43px;">登録する</dt>
                            <dd>
                                <a href="{{ route('accountbook.create') }}" class="btn btn-warning">支出登録</a>
                            </dd>
                            <dd>
                                <a href="{{ route('category.index') }}" class="btn btn-warning">カテゴリ登録</a>
                            </dd>
                            <dd>
                                <a href="{{ route('tag.index') }}" class="btn btn-warning">タグ登録</a>
                            </dd>
                            <dt class="ui-stripe--menu_search" style="margin-top: 10px; height: 43px;">検索する</dt>
                            <dd>
                                <a href="{{ route('accountbook.eachYear') }}" class="btn btn-warning">過去の支出一覧</a>
                                <a href="{{ route('accountbook.search') }}" class="btn btn-warning"
                                    style="margin-top: 10px;">絞り込み</a>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        {{ $accountbooks->links() }}
    </div>
@endsection
