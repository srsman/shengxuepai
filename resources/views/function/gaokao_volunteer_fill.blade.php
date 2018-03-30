@extends('layout')
@section('title')
高考成绩智能填报-升学派
@endsection
@section('navbar')
    <li class="navbar-a-underline navbar-a-active"><a href="javascript:;">高&nbsp;&nbsp;&nbsp;考&nbsp;&nbsp;&nbsp;成&nbsp;&nbsp;&nbsp;绩&nbsp;&nbsp;&nbsp;智&nbsp;&nbsp;&nbsp;能&nbsp;&nbsp;&nbsp;填&nbsp;&nbsp;&nbsp;报</a></li>
@endsection
@section('main')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <button class="btn btn-sxp" type="button" data-toggle="fill">填写志愿</button>
        </div>
    </div>
@endsection
@section('modal')
<div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="listModalLabel">
    <div class="modal-dialog" role="document" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">第一志愿C平行志愿·填报</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-bordered text-center" id="schoolTable">
                            <tr>
                                <th colspan="2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="输入学校名称查询" id="schoolName">
                                        <div class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></div>
                                    </div>
                                </th>
                                <th colspan="3" class="text-center" style="vertical-align: middle">
                                    考生位次：{{ Session::get('rank') }}
                                </th>
                                <th colspan="3" class="text-center" style="vertical-align: middle">
                                    2017年
                                </th>
                                <th colspan="3" class="text-center" style="vertical-align: middle">
                                    2016年
                                </th>
                                <th colspan="3" class="text-center" style="vertical-align: middle">
                                    2015年
                                </th>
                                <th colspan="2" class="text-center" style="vertical-align: middle">
                                    2018年
                                </th>
                                <th>

                                </th>
                            </tr>
                            <tr>
                                <th>录取概率</th>
                                <th>院校名称</th>
                                <th>所在地&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th>
                                <th>全国排名&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
                                <th>三年平均位次&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
                                <th>调档线&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
                                <th>位次</th>
                                <th>招生数&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
                                <th>调档线&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
                                <th>位次</th>
                                <th>招生数&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
                                <th>调档线&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
                                <th>位次</th>
                                <th>招生数&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
                                <th>招生数&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
                                <th>院校备注</th>
                                <th>操作</th>
                            </tr>
                        </table>
                        <div class="progress">
                            <div id="progressBar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                <span class="sr-only">40% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="majorModal" tabindex="-1" role="dialog" aria-labelledby="majorModalLabel" style="z-index: 1053">
    <div class="modal-dialog" role="document" style="width:70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick='$("#majorList").fadeOut()' class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">XXX大学</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-bordered text-center" id="majorTable">
                            <tr>
                                <th class="text-center" style="vertical-align: middle">
                                    考生成绩：400
                                </th>
                                <th class="text-center" style="vertical-align: middle">
                                    <span style="float: right">考生位次：{{ Session::get('rank') }}</span>
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                                <th colspan="3" class="text-center" style="vertical-align: middle">
                                    2016年
                                </th>
                                <th colspan="3" class="text-center" style="vertical-align: middle">
                                    2015年
                                </th>
                                <th colspan="3" class="text-center" style="vertical-align: middle">
                                    2014年
                                </th>
                                <th class="text-center" style="vertical-align: middle">
                                    2017年
                                </th>
                                <th>

                                </th>
                                <th>

                                </th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-center">专业名称</th>
                                <th>科别</th>
                                <th>最低分</th>
                                <th>位次</th>
                                <th>招生数</th>
                                <th>最低分</th>
                                <th>位次</th>
                                <th>招生数</th>
                                <th>最低分</th>
                                <th>位次</th>
                                <th>招生数</th>
                                <th>招生计划</th>
                                <th>特色专业</th>
                                <th>操作</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick='$("#majorList").fadeOut()'>关闭</button>
                <button type="button" class="btn btn-sxp">保存</button>
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
<script src="{{ URL::asset('./js/gaokao_volunteer_fill.js') }}"></script>
@endsection