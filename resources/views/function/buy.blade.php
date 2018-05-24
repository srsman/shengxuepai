@extends('layout')
@section('title')
金志愿卡购买
@endsection
@section('navbar')
<li class="navbar-a-underline navbar-a-active"><a href="javascript:;">金志愿卡购买</a></li>
@endsection
@section('main')
<div class="row">
    <p class="text-center h4">请购买金志愿卡</p>
    <div class="col-md-offset-2 col-md-8">
        <div class="row">
            <div class="col-sm-offset-3 col-xs-offset-3 col-sm-3 col-xs-3">
                <img src="{{ URL::asset('images/project/sxpA.jpg') }}" width=100% height=100%>
                <p class="text-center rt">金志愿卡A面</p>
            </div>
            <div class="col-sm-3 col-xs-3">
                <img src="{{ URL::asset('images/project/sxpB.jpg') }}" width=100% height=100%>
                <p class="text-center rt">金志愿卡B面</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-10 buy">
                <h4>升学派“金志愿卡”简介：</h4>
                <h4>强大的功能</h4>
                <ul>
                    <li>1、输入高考分数，自动显示全省排名，智能推荐目标大学；</li>
                    <li>2、根据一、二、三诊成绩，提前模拟进行高考志愿填报；</li>
                    <li>3、自主招生院校大数据详细分析，进行自招院校的筛选；</li>
                    <li>4、享受国际上最权威的职业兴趣测评，获取一份权威报告；</li>
                    <li>5、同分考生去向，查看近三年同分考生录取的院校与专业；</li>
                    <li>6、查看3000多所院校、500多个专业的详细介绍与数据。</li>
                </ul>
                <h4>强大的优势：</h4>
                <ul>
                    <li>1、四川省高考志愿填报领域最精准的大数据分析系统；</li>
                    <li>2、根据考生成绩快速锁定目标大学，实现超精准高考志愿填报；</li>
                    <li>3、教育部、中宣部、外交部智库专家鼎力推荐。</li>
                </ul>
                <h4>有效期：2018年8月31日。若您是19年、20年高考的用户，请加工作人员QQ3155604542或微信xjbwsd升级。</h4>
                <h4>价格：280元/张</h4>
                <h4>温馨提示：</h4>
                <ul>
                    <li>此卡为虚拟卡，成功购买之后，会自动升级为VIP用户。</li>
                    <li>此卡只适用于四川考生，此卡一经售出，概不退换。</li>
                </ul>
                <h4>购买方式：</h4>
                <ul>
                    <li>1、微信、支付宝支付；</li>
                    <li>2、电话购买：拨打升学派官方电话028-85846445，联系工作人员，进行购买；</li>
                    <li>3、QQ微信购买：添加QQ3155604542或者微信xjbwsd购买；</li>
                    <li>4、现场购买：成都市天府大道南段846号天府创新中心1楼。</li>
                </ul>
            </div>
        </div>
        <div class="row rt text-center">
            <button class="btn btn-lg btn-info" style="letter-spacing: 2px" data-toggle="modal" id="buy">立即购买</button>
        </div>
    </div>
</div>
@endsection
@section('modal')
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">选择支付方式</h4>
                <h4 class="modal-title">订单编号:<small id="order_number"></small></h4>
            </div>
            <div class="modal-body">
                <div class="row" id='pay'>
                    <div class="col-xs-offset-2 col-md-offset-2 col-md-3 col-xs-3 pay">
                        <img src="{{ URL::asset('images/project/alipay.png') }}"/>
                    </div>
                    <div class="col-xs-offset-2 col-md-offset-2 col-md-3 col-xs-3 pay">
                        <img src="{{ URL::asset('images/project/wepay.png') }}"/>
                    </div>
                </div>
                <p id="notice" class="text-center">&nbsp;</p>
            </div>
            <div class="modal-footer">
                <h4>应付金额：￥280.00</h4>
                <form method="post" action="{{ URL('buy/pay') }}">
                    <input type="hidden" id = "pay_way" name="pay_way"/>
                    <input type="hidden" id = "order_id" name="order_id"/>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-primary" id="pay_button">去支付</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="wepayModal" tabindex="-1" role="dialog" aria-labelledby="wepayModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">打开微信扫一扫</h4>
            </div>
            <div class="modal-body text-center">
                <div id="img"></div>
                <p id="notice" class="text-center">&nbsp;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var  _token = "{{ csrf_token() }}";
    var URL = "{{ URL('/') }}";
</script>
<script src="{{ URL::asset('js/buy.js') }}"></script>
@endsection