@extends('layout')
@section('title')
    一对一专家预约
@endsection
@section('navbar')
    <li class="navbar-a-underline navbar-a-active"><a href="javascript:;">一对一专家预约</a></li>
@endsection
@section('main')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>一对一专家预约</h3>
            <hr/>
            <div id="teacherList" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <div class="col-sm-3">
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img src="{{ URL::asset('images/project/order/9.jpg') }}" class="img-rounded"/>
                                    <hr/>
                                    <p>罗跃</p>
                                    <p>毕业于澳门大学</p>
                                    <p>升学派教育研究院首席专家</p>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="#" class="btn btn-sxp" role="button">点击预约</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img src="{{ URL::asset('images/project/order/8.jpg') }}" class="img-rounded"/>
                                    <hr/>
                                    <p>罗锡</p>
                                    <p>毕业于中国人民大学</p>
                                    <p>升学派教育研究院首席专家</p>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="#" class="btn btn-sxp" role="button">点击预约</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img src="{{ URL::asset('images/project/order/3.jpg') }}" class="img-rounded"/>
                                    <hr/>
                                    <p>何翔</p>
                                    <p>毕业于北京大学</p>
                                    <p>升学派教育研究院高级专家</p>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="#" class="btn btn-sxp" role="button">点击预约</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img src="{{ URL::asset('images/project/order/1_1.jpg') }}" class="img-rounded"/>
                                    <hr/>
                                    <p>张明昂</p>
                                    <p>毕业于清华大学</p>
                                    <p>升学派教育研究院高级专家</p>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="#" class="btn btn-sxp" role="button">点击预约</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-md-3">
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img src="{{ URL::asset('images/project/order/1_1.jpg') }}" class="img-rounded"/>
                                    <hr/>
                                    <p>张明昂</p>
                                    <p>毕业于清华大学</p>
                                    <p>升学派教育研究院高级专家</p>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="#" class="btn btn-sxp" role="button">点击预约</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img src="{{ URL::asset('images/project/order/6.jpg') }}" class="img-rounded"/>
                                    <hr/>
                                    <p>雷琴</p>
                                    <p>毕业于重庆交通大学</p>
                                    <p>升学派教育研究院高首席专家</p>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="#" class="btn btn-sxp" role="button">点击预约</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img src="{{ URL::asset('images/project/order/1_2.jpg') }}" class="img-rounded"/>
                                    <hr/>
                                    <p>张小虎</p>
                                    <p>毕业于成都理工大学</p>
                                    <p>升学派教育研究院高级专家</p>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="#" class="btn btn-sxp" role="button">点击预约</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img src="{{ URL::asset('images/project/order/1.jpg') }}" class="img-rounded"/>
                                    <hr/>
                                    <p>陈姣</p>
                                    <p>毕业于华东师范大学</p>
                                    <p>升学派教育研究院高级专家</p>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="#" class="btn btn-sxp" role="button">点击预约</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-sm-3">
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img src="{{ URL::asset('images/project/order/1.jpg') }}" class="img-rounded"/>
                                    <hr/>
                                    <p>陈姣</p>
                                    <p>毕业于华东师范大学</p>
                                    <p>升学派教育研究院高级专家</p>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="#" class="btn btn-sxp" role="button">点击预约</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img src="{{ URL::asset('images/project/order/4.jpg') }}" class="img-rounded"/>
                                    <hr/>
                                    <p>贾兵</p>
                                    <p>毕业于四川大学</p>
                                    <p>升学派教育研究院高级专家</p>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="#" class="btn btn-sxp" role="button">点击预约</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img src="{{ URL::asset('images/project/order/7.jpg') }}" class="img-rounded"/>
                                    <hr/>
                                    <p>刘洋</p>
                                    <p>毕业于南洋理工大学</p>
                                    <p>升学派教育研究院高级专家</p>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="#" class="btn btn-sxp" role="button">点击预约</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img src="{{ URL::asset('images/project/order/2.jpg') }}" class="img-rounded"/>
                                    <hr/>
                                    <p>叶学君</p>
                                    <p>毕业于香港理工大学</p>
                                    <p>升学派教育研究院高级专家</p>
                                </div>
                                <div class="panel-footer text-center">
                                    <a href="#" class="btn btn-sxp" role="button">点击预约</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="left carousel-control" href="#teacherList" role="button" data-slide="prev" style="width: 5%">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#teacherList" role="button" data-slide="next"  style="width: 5%">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

    </div>
@endsection
@section('modal')
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("a.btn-sxp").click(function () {
                window.location.href='http://shengxuepai.mikecrm.com/DRDUNjs';
            })
        })
    </script>
@endsection