<head>
    <title>AccountBookList</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<div class="container">
    <div class="row">
        </h2>購入品一覧</h2>
    </div>
    <div class="row">
        <div class="list-news col-md-12 mx-auto">
            <div class="row">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="15%">購入品</th>
                            <th width="15%">金額</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accountbooks as $accountbook)
                            <tr>
                                <th>{{ $accountbook->id }}</th>
                                <td>{{ \Str::limit($accountbook->title, 100) }}</td>
                                <td>{{ $accountbook->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div><a href="/accountbook/create" class="btn btn-default">新規作成</a></div>
            </div>
        </div>
    </div>
</div>
