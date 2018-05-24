@extends('layout')
@section('title')
    国家专项数据查询
@endsection
@section('navbar')
    <li class="navbar-a-underline navbar-a-active"><a href="javascript:;">国家专项数据查询</a></li>
@endsection
@section('main')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="nav nav-tabs"  role="tablist" id="nav">
                <li role="presentation" class="active" aria-controls="home" role="tab"><a href="javascript:void(0)" aria-controls="home" role="tab" data-toggle="tab">文科</a></li>
                <li role="presentation" aria-controls="home" role="tab"><a href="javascript:void(0)" aria-controls="home" role="tab" data-toggle="tab">理科</a></li>
            </ul>
            <hr>
        </div>
    </div>
    <div class="row rt">
        <div class="col-md-offset-3 col-md-2">
            <div class="div_height text-center" data-toggle="modal">
                <div class="fill"></div>
                <p class="p_color"><small>文科</small><br>提前批本科院校</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="div_height text-center" data-toggle="modal">
                <div class="fill"></div>
                <p class="p_color"><small>文科</small><br>普通类第一批本科院校</p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="div_height text-center" data-toggle="modal">
                <div class="fill"></div>
                <p class="p_color"><small>文科</small><br>普通类第二批本科院校</p>
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
                            <table class="table table-striped table-bordered text-center" id="schoolTable">
                                <tr>
                                    <th>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="输入学校名称查询" id="schoolName">
                                            <div class="input-group-addon" id="search">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </div>
                                        </div>
                                    </th>
                                    <th></th>
                                    <th></th>
                                    <th colspan="3" class="text-center">国家专项调档线</th>
                                    <th colspan="3" class="text-center">国家专项调档线位次</th>
                                    <th colspan="3" class="text-center">招生计划</th>
                                    <th colspan="3" class="text-center">正常批次调档线</th>
                                </tr>
                                <tr>
                                    <th class="text-center">院校名称</th>
                                    <th class="text-center">招生批次</th>
                                    <th class="text-center">所在地&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th>
                                    <th class="text-center">2017年</th>
                                    <th class="text-center">2016年</th>
                                    <th class="text-center">2015年</th>
                                    <th class="text-center">2017年</th>
                                    <th class="text-center">2016年</th>
                                    <th class="text-center">2015年</th>
                                    <th class="text-center">2017年</th>
                                    <th class="text-center">2016年</th>
                                    <th class="text-center">2015年</th>
                                    <th class="text-center">2017年</th>
                                    <th class="text-center">2016年</th>
                                    <th class="text-center">2015年</th>
                                </tr>
                            </table>
                            {{--<div class="row" id="loader">--}}
                                {{--<div class="col-sm-12 text-center">--}}
                                    {{--<div class="loader-box">--}}
                                        {{--<div class="loader">--}}
                                        {{--</div>--}}
                                        {{--<p>加载中，请稍候</p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
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
    <script src="{{ URL::asset('js/class_select.js') }}"></script>
@endsection