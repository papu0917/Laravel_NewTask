@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h2>カテゴリ一覧</h2>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-striped">
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
                                        <div>
                                            <a href="{{ route('category.edit', ['id' => $category->id]) }}"
                                                class="btn btn-success">編集</a>
                                            <a href="{{ route('category.delete', ['id' => $category->id]) }}"
                                                class="btn btn-danger">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div><a href="/category/create" class="btn btn-primary">新規作成</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
