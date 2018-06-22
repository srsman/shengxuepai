@extends('layout')
@section('title')
    功能区域
@endsection
@section('main')
    <img id="zoom"  width="400px" style="position: absolute;z-index: 1;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="row">
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" onclick="window.location.href='{{ URL('functions/gaokao_volunteer_fill') }}'" src="{{ URL::asset('images/project/functions/1.png') }}" />
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" src="{{ URL::asset('images/project/functions/2.png') }}" />
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" onclick="window.location.href='{{ URL('functions/zs') }}'" src="{{ URL::asset('images/project/functions/3.png') }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" onclick="window.location.href='{{ URL('functions/score_report') }}'" src="{{ URL::asset('images/project/functions/4.png') }}" />
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" onclick="window.location.href='{{ URL('functions/cooperation') }}'" src="{{ URL::asset('images/project/functions/5.png') }}" />
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" onclick="window.location.href='{{ URL('functions/character_test') }}'" src="{{ URL::asset('images/project/functions/6.png') }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" onclick="window.location.href='{{ URL('functions/school_view') }}'" src="{{ URL::asset('images/project/functions/7.png') }}" />
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" onclick="window.location.href='{{ URL('functions/major_view') }}'" src="{{ URL::asset('images/project/functions/8.png') }}" />
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" onclick="window.location.href='{{ URL('functions/compare') }}'" src="{{ URL::asset('images/project/functions/9.png') }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" onclick="window.location.href='{{ URL('') }}'" src="{{ URL::asset('images/project/functions/10.png') }}" />
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" onclick="window.location.href='{{ URL('functions/order') }}'" src="{{ URL::asset('images/project/functions/11.png') }}" />
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" onclick="window.location.href='{{ URL('functions/my_volunteer') }}'" src="{{ URL::asset('images/project/functions/12.png') }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" src="{{ URL::asset('images/project/functions/13.png') }}" />
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" onclick="window.location.href='{{ URL('functions/university_rank') }}'" src="{{ URL::asset('images/project/functions/14.png') }}" />
                </div>
                <div class="col-sm-4 text-center">
                    <img class="img-up" width="100%" onclick="window.location.href='{{ URL('functions/minority') }}'" src="{{ URL::asset('images/project/functions/15.png') }}" />
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('js/function_list.js') }}"></script>
@endsection