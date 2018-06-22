@extends('layout')
@section('title')
    信息修改
@endsection
@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="border-shadow" style="padding: 100px 0px">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-3">
                            <div class="text-center img-box" onclick="window.location.href='{{ URL('user/info') }}'" style="background-image: url({{ URL::asset('images/project/infoc_1.png') }})">
                                <p>个人信息修改</p>
                            </div>
                        </div>
                        <div class="col-sm-2 col-sm-offset-2">
                            <div class="text-center img-box" onclick="window.location.href='{{ URL('user/secret') }}'" style="background-image: url({{ URL::asset('images/project/infoc_2.png') }})">
                                <p>安全中心</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection