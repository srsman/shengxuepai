@extends('layout')
@section('title')
专业兴趣测评
@endsection
@section('navbar')
<li class="navbar-a-underline navbar-a-active"><a href="javascript:;">专业兴趣测评</a></li>
@endsection
@section('main')
    <iframe width="100%" height="700"  frameborder="0" scrolling="no" src="http://www.apesk.com/h/go_zy_dingzhi.asp?checkcode=GNBB22LR@JXJZCKCA6
&hruserid=18781771686
&l=@if ($data['classify'] == '文科')Major-choice-w
@elseif ($data['classify'] == '理科') Major-choice-l
@endif&test_name={{$data['name']}}&test_email={{$data['id']}}">
    </iframe>
@endsection
@section('script')
<script src="{{ URL::asset('js/character_testing.js') }}"></script>
@endsection