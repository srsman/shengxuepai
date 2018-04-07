@extends('layout')
@section('title')
    自主招生查询
@endsection
@section('navbar')
    <li class="navbar-a-underline navbar-a-active"><a href="javascript:;">自主招生查询</a></li>
@endsection
@section('main')
    <div class="row">
        <div class="col-md-2 col-md-offset-2">
            <div class="input-group">
                <input id="school" class="form-control" placeholder="输入院校名称">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </div>
        <div class="col-md-2">
            <ul class="nav nav-justified" id="mytab">
                <li role="presentation"><button class="btn btn-sxp">2017年</button></li>
                <li>&nbsp;</li>
                <li role="presentation"><button class="btn btn-default">2016年</button></li>
            </ul>
        </div>
    </div>
    <div class="row rt">
        <div class="col-md-offset-2 col-md-8">
            <table class="table table-striped table-bordered" id="show">
                <thead>
                    <tr>
                        <th>省份&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th>
                        <th>院校名称</th>
                        <th>报名人数</th>
                        <th>初审通过人数</th>
                        <th>初审通过率</th>
                        <th>计划招生</th>
                        <th>复试通过人数</th>
                        <th>复试通过率</th>
                        <th>本地化率</th>
                        <th>川初审人数</th>
                        <th>川复试人数</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('js/zs.js') }}"></script>
@endsection