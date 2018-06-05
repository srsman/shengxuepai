@extends('layout')
@section('title')
    中外合作办学
@endsection
@section('navbar')
    <li class="navbar-a-underline navbar-a-active"><a href="javascript:;">中外合作办学</a></li>
@endsection
@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table class="table table-striped table-bordered text-center" id="schoolTable">
                    {{--<thead>--}}
                        <tr>
                            <th colspan="1">
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
                            <th colspan="1" class="text-center" style="vertical-align: middle">
                                2018年
                            </th>
                            <th></th>
                        </tr>
                        <tr>
                            <th class="text-center">院校名称</th>
                            <th class="text-center">省份&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th>
                            <th class="text-center">全国排名</th>
                            <th class="text-center">招生形式</th>
                            <th class="text-center">调档线</th>
                            <th class="text-center">位次</th>
                            <th class="text-center">招生数</th>
                            <th class="text-center">调档线</th>
                            <th class="text-center">位次</th>
                            <th class="text-center">招生数</th>
                            <th class="text-center">调档线</th>
                            <th class="text-center">位次</th>
                            <th class="text-center">招生数</th>
                            <th class="text-center">招生计划</th>
                            <th class="text-center">操作</th>
                        </tr>
                </table>
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
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered text-center" id="majorTable">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th colspan="3" class="text-center" style="vertical-align: middle">
                                        2017年
                                    </th>
                                    <th colspan="3" class="text-center" style="vertical-align: middle">
                                        2016年
                                    </th>
                                    <th colspan="3" class="text-center" style="vertical-align: middle">
                                        2015年
                                    </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th class="text-center">专业名称</th>
                                    <th class="text-center">招生形势</th>
                                    <th class="text-center">最低分</th>
                                    <th class="text-center">录取位次</th>
                                    <th class="text-center">招生人数</th>
                                    <th class="text-center">最低分</th>
                                    <th class="text-center">录取位次</th>
                                    <th class="text-center">招生人数</th>
                                    <th class="text-center">最低分</th>
                                    <th class="text-center">录取位次</th>
                                    <th class="text-center">招生人数</th>
                                    <th class="text-center">合作院校</th>
                                    <th class="text-center">学费</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('js/cooperation.js') }}"></script>
@endsection