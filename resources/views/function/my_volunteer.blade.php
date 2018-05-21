@extends('layout')
@section('title')
    我的志愿表
@endsection
@section('navbar')
@endsection
@section('main')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>我的志愿表</h3>
            <div class="border-shadow" style="padding: 20px">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#gaokao" aria-controls="gaokao" role="tab" data-toggle="tab">高考成绩志愿单</a></li>
                    <li role="presentation"><a href="#test" aria-controls="test" role="tab" data-toggle="tab">诊断成绩志愿单</a></li>
                    <li role="presentation"><a href="#prepare" aria-controls="prepare" role="tab" data-toggle="tab">预案成绩志愿单</a></li>
                </ul>
                <hr/>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="gaokao">
                        <table class="table table-bordered">
                            <tr>
                                <th>志愿名称</th>
                                <th>批次</th>
                                <th>科目</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="test">
                        <table class="table table-bordered">
                            <tr>
                                <th>志愿名称</th>
                                <th>批次</th>
                                <th>科目</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="prepare">
                        <table class="table table-bordered">
                            <tr>
                                <th>志愿名称</th>
                                <th>批次</th>
                                <th>科目</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div class="modal-background" id="deleteConfirm">
        <div style="width:400px;padding: 20px;" class="border-shadow text-center">
            <p class="text-danger">删除志愿表将不可恢复！确认删除？</p>
            <hr/>
            <button class="btn btn-danger" type="button" onclick="$('#deleteConfirm').hide()">取消</button>
            <button class="btn btn-sxp" type="button">确认</button>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('js/my_volunteer.js') }}"></script>
@endsection
