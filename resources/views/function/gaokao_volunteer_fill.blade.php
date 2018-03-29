@extends('layout')
@section('navbar')
    <li class="navbar-a-underline navbar-a-active"><a href="javascript:;">高&nbsp;&nbsp;&nbsp;考&nbsp;&nbsp;&nbsp;成&nbsp;&nbsp;&nbsp;绩&nbsp;&nbsp;&nbsp;智&nbsp;&nbsp;&nbsp;能&nbsp;&nbsp;&nbsp;填&nbsp;&nbsp;&nbsp;报</a></li>
@endsection
@section('main')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <button class="btn btn-sxp" type="button" data-toggle="modal" data-target="#listModal">填写志愿</button>
        </div>
    </div>
@endsection
@section('modal')
<div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="listModalLabel">
    <div class="modal-dialog" role="document" style="width:80%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">第一志愿C平行志愿·填报</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-bordered" id="schoolTable">
                            <tr>
                                <th colspan="2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="输入学校名称查询">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
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
                                <th>所在地</th>
                                <th>全国排名</th>
                                <th>三年平均位次</th>
                                <th>调档线</th>
                                <th>位次</th>
                                <th>招生数</th>
                                <th>调档线</th>
                                <th>位次</th>
                                <th>招生数</th>
                                <th>调档线</th>
                                <th>位次</th>
                                <th>招生数</th>
                                <th>招生数</th>
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
                <button type="button" class="btn btn-sxp">保存</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('./js/gaokao_volunteer_fill.js') }}"></script>
@endsection