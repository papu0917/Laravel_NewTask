@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="menubox-left" style="float: left; width: 150px;">
                    <dl class="areamenu areamenu--ex">
                        <dt class="ui-sprite--menu_rent"
                            style="background-position: -386px 0px; width: 245px;height: 43px;">支出をつける</dt>
                        <dd>
                            <a href="/accountbook/create" class="btn btn-warning">支出登録</a>
                        </dd>
                        <dt class="ui-stripe--menu_search" style="margin-top: 10px; height: 43px;">検索する</dt>
                        <dd>


                            <a href="/accountbook/eachYear" class="btn btn-warning">過去の支出一覧</a>

                            <a href="/accountbook/search" class="btn btn-warning" style="margin-top: 10px;">絞り込み</a>


                        </dd>
                    </dl>
                </div>
                <div class="menubox-right">
                    <div>
                        <dl class="areamenu areamenu--han">
                            <dt class="ui-stripe--menu_search" style="height: 43px;">検索する</dt>
                            <dd>
                                <div class="areamenu_item_group">
                                    <div class="areamenu_item">
                                        <ul>
                                            <li style="list-style: none;">
                                                <a href="/accountbook/eachYear" class="btn btn-warning">過去の支出一覧</a>
                                            </li>
                                            <li style="list-style: none;">
                                                <a href="/accountbook/search" class="btn btn-warning"
                                                    style="margin-top: 10px;">絞り込み</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
