@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            <h2>タグ一覧</h2>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="15%">タグ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <th>{{ $tag->id }}</th>
                                    <th>{{ $tag->name }}</th>
                                    <td>
                                        <div><a href="{{ route('tag.edit', ['id' => $tag->id]) }}">編集</a>

                                        </div>
                                        <div><a href="{{ route('tag.delete', ['id' => $tag->id]) }}">削除</a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div><a href="{{ route('tag.create') }}" class="btn btn-default">新規作成</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
