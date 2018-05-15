@extends('layout')
@section('title')
中国大学排行榜
@endsection
@section('navbar')
<li class="navbar-a-underline navbar-a-active"><a href="javascript:;">中国大学排行榜</a></li>
@endsection
@section('main')
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="col-md-3">
            <div class="div_height text-center">
                <div class="fill"></div>
                <p class="p_color" data-toggle="modal">中国校友会<br><small>2018年大学排行榜700强</small></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="div_height text-center">
                <div class="fill"></div>
                <p class="p_color" data-toggle="modal">武书连<br><small>2017年大学排行榜400强</small></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="div_height text-center">
                <div class="fill"></div>
                <p class="p_color" data-toggle="modal">软科<br><small>2017年中国最好大学排行榜</small></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="div_height text-center">
                <div class="fill"></div>
                <p class="p_color" data-toggle="modal">中国校友会<br><small>2018年独立学院300强</small></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="div_height text-center">
                <div class="fill"></div>
                <p class="p_color" data-toggle="modal">武书连<br><small>2017年中国独立学院排行榜100强</small></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="div_height text-center">
                <div class="fill"></div>
                <p class="p_color" data-toggle="modal">中国校友会<br><small>2018年民办大学排行榜150强</small></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="div_height text-center">
                <div class="fill"></div>
                <p class="p_color" data-toggle="modal">武书连<br><small>2017年中国民办学院排行榜100强</small></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="div_height text-center">
                <div class="fill"></div>
                <p class="p_color" data-toggle="modal">华东师范大学社会调查中心<br><small>2018年版中国大学学科综合排行榜</small></p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document" style="width: 80%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12" id="showTable">
                            {{--<table class="table table-striped table-bordered text-center" id="schoolTable"></table>--}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ URL::asset('js/rank.js') }}"></script>
@endsection