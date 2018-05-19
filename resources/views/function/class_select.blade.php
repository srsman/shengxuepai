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
        <div class="row rt" id="">
            <div class="col-md-offset-3 col-md-2">
                <div class="div_height text-center">
                    <div class="fill">文科</div>
                    <p>
                        <h4><a href="#">提前批本科院校</a></h4>
                    </p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="div_height text-center">
                    <div class="fill">文科</div>
                    <p>
                        <h4><a href="#">普通类第一批本科院校</a></h4>
                    </p>
                </div>
            </div>
            <div class="col-md-2">
                <div  class="div_height text-center">
                    <div class="fill">文科</div>
                    <p>
                        <h4><a href='#'>普通类第二批本科院校</a></h4>
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('modal')

@endsection
@section('script')
    <script src="{{ URL::asset('js/minority.js') }}"></script>
@endsection