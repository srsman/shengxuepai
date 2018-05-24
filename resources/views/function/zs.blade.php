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
                <input id="schoolName" class="form-control" placeholder="输入院校名称">
                <span class="input-group-btn">
                    <button id='search' class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </div>
        <div class="col-md-2">
            <ul class="nav nav-justified" id="mytab">
                <li><button class="btn btn-sxp">2017年</button></li>
                <li><button class="btn btn-default">2016年</button></li>
            </ul>
        </div>
    </div>
    <div class="row rt">
        <div class="col-md-offset-2 col-md-8">
            <table class="table table-striped table-bordered text-center" id="schoolTable">
                <tr>
                    <th class="text-center">院校名称</th>
                    <th class="text-center">省份&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th>
                    <th class="text-center">报名人数<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
                    <th class="text-center">初审通过人数</th>
                    <th class="text-center">初审通过率<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
                    <th class="text-center">计划招生</th>
                    <th class="text-center">复试通过人数</th>
                    <th class="text-center">复试通过率<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
                    {{--<th class="text-center">本地化率<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>--}}
                    {{--<th class="text-center">川初审人数</th>--}}
                    {{--<th class="text-center">川复试人数</th>--}}
                </tr>
            </table>
            {{--<nav aria-label="...">--}}
                {{--<ul class="pager">--}}
                    {{--<li><a href="#">上一页</a></li>--}}
                    {{--<li><a href="#">下一页</a></li>--}}
                {{--</ul>--}}
            {{--</nav>--}}
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
    <script src="{{ URL::asset('js/zs.js') }}"></script>
@endsection