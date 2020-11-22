@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            <h2>カテゴリ一覧</h2>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="15%">カテゴリ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th>{{ $category->id }}</th>
                                    <th>{{ $category->name }}</th>
                                    <td>
                                        <div><a href="{{ route('category.edit', ['id' => $category->id]) }}">編集</a>

                                        </div>
                                        <div><a href="{{ route('category.delete', ['id' => $category->id]) }}">削除</a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div><a href="/category/create" class="btn btn-default">新規作成</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
