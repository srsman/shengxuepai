@extends('layout')
@section('title')
    我的成绩分析
@endsection
@section('navbar')
    <li class="navbar-a-underline navbar-a-active"><a href="javascript:;">我的成绩分析</a></li>
@endsection
@section('main')
    <div class="row">
        <div class="col-md-offset-2 col-md-8 col-xs-offset-2 col-xs-8">
            <h4 class="text-center">升学派个人成绩分析报告</h4>
        </div>
        <div class="col-md-offset-3 col-md-2">
            <ul class="nav nav-justified" id="mytab">
                <li role="presentation"><button class="btn btn-sxp">2015年</button></li>
                <li role="presentation"><button class="btn btn-default">2014年</button></li>
            </ul>
        </div>
    </div>
    <div class="row rt">
        <input type="hidden" value="{{Session::get('rank')}}" id="rank">
        <div class="row" id="loader">
            <div class="col-sm-12 text-center">
                <div class="loader-box">
                    <div class="loader">
                    </div>
                    <p>加载中，请稍候</p>
                </div>
            </div>
        </div>
        <div class="col-md-offset-3">
            <h5></h5>
            <h5></h5>
        </div>
        <div class="row rt">
            <div class="col-md-offset-3 col-md-6">
                <h5></h5>
                <div class="col-sm-12 rt" id="main" style="width: 800px;height:400px;"></div>
            </div>
        </div>
        <div class="row rt">
            <div class="col-md-offset-3 col-md-6">
                <h5></h5>
                <div class="col-sm-12 rt" id="main_school" style="width: 800px;height:400px;"></div>
            </div>
        </div>
        <div class="row rt">
            <div class="col-md-offset-3 col-md-6">
                <h5></h5>
                <div class="col-sm-12 rt" id="main_major" style="width: 800px;height:400px;"></div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('js/echarts.js') }}"></script>
    <script src="{{ URL::asset('js/score_report.js') }}"></script>
@endsection