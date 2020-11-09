@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="menubox-left" style="float: left; width: 245px;">
            <dl class="areamenu areamenu--ex">
                <dt class="ui-sprite--menu_rent" style="background-position: -386px 0px; width: 245px;height: 43px;">支出をつける
                </dt>
                <dd>
                    <a href="/accountbook/create" class="btn btn-warning">支出登録</a>
                </dd>
            </dl>
        </div>
        <div class="menubox-right">
            <div>
                <dl class="areamenu areamenu--han">
                    <dt class="ui-stripe--menu_search">検索する
                </dl>
            </div>
        </div>
    @endsection
