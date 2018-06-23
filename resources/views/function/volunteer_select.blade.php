@extends('layout')
@section('title')
    高考成绩智能填报
@endsection
@section('navbar')
    <li class="navbar-a-underline navbar-a-active"><a href="javascript:;">高考成绩智能填报</a></li>
@endsection
@section('main')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="border-shadow text-center" style="padding: 20px;margin: 20px 0px;cursor: pointer" onclick="window.location.href='{{ URL('fill/add/gaokao/0') }}'">
                <h4 style="letter-spacing: 15px;font-family: 黑体">提前批本科院校</h4>
                <hr/>
                <p>&nbsp;</p>
            </div>
            @foreach($scores as $row)
                <div class="border-shadow text-center" style="padding: 20px;margin: 20px 0px;cursor: pointer" onclick="window.location.href='{{ URL('fill/add/gaokao/' . $row->batch) }}'">
                    <h4 style="letter-spacing: 15px;font-family: 黑体">{{ $row->name }}</h4>
                    <hr/>
                    <p><span style="margin: 0px 20px">省控线</span><span style="margin: 0px 20px">{{ $row->type == 1 ? '文' : '理' }}科 {{ $row->score }}</span></p>
                    @if($flag == $row->name)
                        <div style=" float:right; margin-top:-90px; margin-right:40px; background-image:url({{ URL::asset('images/project/tuijian.png') }}); width:144px; height:84px; text-align:center; color:#FFFFFF; line-height:30px"></div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('modal')
@endsection
@section('script')
@endsection
