@extends('layout')
@section('title')
目标专业查询
@endsection
@section('navbar')
    <li class="navbar-a-underline navbar-a-active"><a href="javascript:;">目&nbsp;&nbsp;&nbsp;标&nbsp;&nbsp;&nbsp;专&nbsp;&nbsp;&nbsp;业&nbsp;&nbsp;&nbsp;查&nbsp;&nbsp;&nbsp;询</a></li>
@endsection
@section('main')
    <div class="row">
        <div class="col-md-8 col-md-offset-2 border-shadow" style="padding: 20px">
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active" id="li_1"><a href="#bz-0" aria-controls="bz-0" role="tab" data-toggle="tab">本&nbsp;&nbsp;&nbsp;科</a></li>
                    <li role="presentation" id="li_2"><a href="#bz-1" aria-controls="bz-1" role="tab" data-toggle="tab">专&nbsp;&nbsp;&nbsp;科</a></li>
                </ul>
                <hr/>
                <div class="row" id="loader">
                    <div class="col-sm-12 text-center">
                        <div class="loader-box">
                            <div class="loader">
                            </div>
                            <p>加载中，请稍候</p>
                        </div>
                    </div>
                </div>
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="bz-0">
                        <div class="row">
                            <div class="col-sm-2">
                                <ul class="list-group">
                                </ul>
                            </div>
                            <div class="col-sm-3">
                                <ul class="list-group">
                                </ul>
                            </div>
                            <div class="col-sm-7">
                                <ul class="list-group">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="bz-1">
                        <div class="row">
                            <div class="col-sm-2">
                                <ul class="list-group">
                                </ul>
                            </div>
                            <div class="col-sm-3">
                                <ul class="list-group">
                                </ul>
                            </div>
                            <div class="col-sm-7">
                                <ul class="list-group">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('js/major_view.js') }}"></script>
@endsection
