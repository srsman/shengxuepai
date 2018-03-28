@extends('layout')
@section('main')
    <div class="row">
        <div class="col-md-4 col-md-offset-2"  style="padding: 20px 0px">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8 box">
                    <p class="box-title">密码修改</p>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">原始密码</label>
                            <div class="col-sm-7">
                                <input type="password" value="" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">新密码</label>
                            <div class="col-sm-7">
                                <input type="password" value="" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">密码确认</label>
                            <div class="col-sm-7">
                                <input type="password" value="" class="form-control"/>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <p class="text-center"><button class="btn btn-sxp" type="button">确认修改</button></p>
                </div>
            </div>
        </div>
        <div class="col-md-4"  style="padding: 20px 0px">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8 box">
                    <p class="box-title">绑定手机号修改 <br/>该功能待定</p>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">手机号</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" value=""/>
                            </div>
                        </div>
                    </form>
                    <hr/>
                    <p class="text-center"><button class="btn btn-sxp" type="button">确认修改</button></p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/js/user_center.js') }}" charset="utf-8"></script>
@endsection