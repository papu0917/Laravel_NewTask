@extends('accountbook/layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="row">
                <h1>年別支出一覧</h1>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <table class="table table-dark table-striped">
                        <form action="{{ action('AccountbookController@amountMonth') }}" method="get">
                            <select name="requests">
                                <option>選択してください</option>
                                <option value="2020" selected="selected">2020</option>
                            </select>
                            <input type="submit" class="btn btn-primary" value="実行">
                        </form>
                        <div><a href="/accountbook/eachAmount" class="btn btn-warning">2020年の支出一覧</a></div>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
