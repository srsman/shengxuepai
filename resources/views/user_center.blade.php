@extends('layout')
@section('title')
    修改用户信息
@endsection
@section('main')
    <div class="row">
        <div class="col-md-8 col-md-offset-2"  style="padding: 20px 0px">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8 box">
                    <p class="box-title">个人基本信息</p>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">所在省市县</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="province"></select>
                                <input type="hidden" id="hiddenP" value="{{ $user->province }}">
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" id="city" style="display: none"></select>
                                <input type="hidden" id="hiddenC" value="{{ $user->city }}">
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" id="country" style="display: none"></select>
                                <input type="hidden" id="hiddenR" value="{{ $user->region }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">就读班级</label>
                            <div class="col-sm-3">
                                <select type="text" class="form-control" id="grade">
                                    <option value="1" @if($user->grade == 1) selected @endif>高一</option>
                                    <option value="2" @if($user->grade == 2) selected @endif>高二</option>
                                    <option value="3" @if($user->grade == 3) selected @endif>高三</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="class" value="{{ $user->class }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">就读中学</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="school" value="{{ $user->school }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">考生姓名</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="name" value="{{ $user->name }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">考生性别</label>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input @if($user->sex==1)checked @endif type="radio" name="sex" value="1"> 男
                                </label>
                                <label class="radio-inline">
                                    <input @if($user->sex==2)checked @endif type="radio" name="sex" value="2"> 女
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">考生类型</label>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input @if($user->classify==2)checked @endif type="radio" name="major" value="2"> 理科
                                </label>
                                <label class="radio-inline">
                                    <input @if($user->classify==1)checked @endif type="radio" name="major" value="1"> 文科
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">高考年份</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="year">
                                    @for($i = date('Y') - 4; $i <= date('Y') + 4; $i++)
                                        @if($user->year == $i)
                                            <option selected value="{{ $i }}">{{ $i }}年</option>
                                        @else
                                            <option value="{{ $i }}">{{ $i }}年</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8 box">
                    <p class="box-title">高考分数管理</p>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">高考分数</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" value="{{ $user->score['score'] }}" id="score"/>
                                <input type="hidden" id="originalScore" value="{{ $user->score['score'] }}"/>
                            </div>
                            <div class="col-sm-3">
                                <p class="text-danger" hidden id="scoreInfo">当前分数不合理</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">高考位次</label>
                            <div class="col-sm-3">
                                <input type="text" disabled class="form-control" value="{{ $user->rank['rank'] }}" id="rank"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr/>
            <p class="text-center"><button class="btn btn-sxp" type="button" id="submit">确认修改</button></p>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/js/user_center.js') }}" charset="utf-8"></script>
@endsection