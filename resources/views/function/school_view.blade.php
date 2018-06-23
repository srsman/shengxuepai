@extends('layout')
@section('title')
目标大学查询
@endsection
@section('navbar')
    <li class="navbar-a-underline navbar-a-active"><a href="javascript:;">目标大学查询</a></li>
@endsection
@section('main')
<div class="row">
    <div class="col-md-10 col-md-offset-1 text-center border-shadow" style="padding: 20px">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-2">院校名称</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" class="form-control" id="schoolName" placeholder="输入学校名称搜索">
                                <div class="input-group-addon"  id="searchSchool"><span class="glyphicon glyphicon-search"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">院校性质</label>
                        <div class="col-sm-5 form-control-static">
                            <span class="custom-checkbox" style="padding-left:30px;background:url({{ URL::asset('images/project/checkbox.gif') }}) no-repeat -10px -18px;"><b>双一流</b></span>
                            <span class="custom-checkbox" style="padding-left:30px;background:url({{ URL::asset('images/project/checkbox.gif') }}) no-repeat -10px -18px;"><b>985</b></span>
                            <span class="custom-checkbox" style="padding-left:30px;background:url({{ URL::asset('images/project/checkbox.gif') }}) no-repeat -10px -18px;"><b>211</b></span>
                            <span class="custom-checkbox" style="padding-left:30px;background:url({{ URL::asset('images/project/checkbox.gif') }}) no-repeat -10px -18px;"><b>教育部直属</b></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <hr/>
        <table id="schoolInfo" class="table table-bordered table-striped" >
            <tr>
                <th colspan="9">点击 “大学校名” 查看院校详细信息</th>
                <th colspan="5" style="text-align: center">卓越人才培养计划</th>
            </tr>
            <tr>
                <th style="width: 300px">院校名称</th>
                <th>全国排名</th>
                <th>专业排名</th>
                <th>所在地&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th>
                <th>高校隶属</th>
                <th>性质</th>
                <th>双一流高校</th>
                <th>985大学</th>
                <th>211大学</th>
                <th>工程师</th>
                <th>医生</th>
                <th>法律</th>
                <th>教师</th>
                <th>农林</th>
            </tr>
        </table>
        <div class="loader-box">
            <div class="loader">
            </div>
            <p>加载中，请稍候！</p>
        </div>
    </div>
</div>
@endsection
@section('modal')
    <div class="modal-background" id="provinceList">
        <div style="width:600px;padding: 20px;" class="border-shadow">
            <table class="table text-center table-bordered fetchbox" id="provinceFetch">
                <tr>
                    <td>四川</td>
                    <td>北京</td>
                    <td>上海</td>
                    <td>重庆</td>
                    <td>天津</td>
                    <td>福建</td>
                    <td>黑龙江</td>
                </tr>
                <tr>
                    <td>吉林</td>
                    <td>辽宁</td>
                    <td>山东</td>
                    <td>山西</td>
                    <td>陕西</td>
                    <td>河北</td>
                    <td>河南</td>
                </tr>
                <tr>
                    <td>湖北</td>
                    <td>湖南</td>
                    <td>江苏</td>
                    <td>江西</td>
                    <td>广东</td>
                    <td>广西</td>
                    <td>云南</td>
                </tr>
                <tr>
                    <td>海南</td>
                    <td>贵州</td>
                    <td>西藏</td>
                    <td>宁夏</td>
                    <td>甘肃</td>
                    <td>青海</td>
                    <td>内蒙古</td>
                </tr>
                <tr>
                    <td>新疆</td>
                    <td>安徽</td>
                    <td>浙江</td>
                    <td>香港</td>
                    <td>澳门</td>
                    <td>台湾</td>
                    <td style="background-color: white; color:rgb(78,201,142);cursor: pointer" id="fetch">
                        <span  class="glyphicon glyphicon-search"></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ URL::asset('js/school_view.js') }}"></script>
@endsection