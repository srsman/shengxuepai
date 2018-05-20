@extends('layout')
@section('title')
    不同院校对比
@endsection
@section('navbar')
    <li class="navbar-a-underline navbar-a-active"><a href="javascript:;">不&nbsp;&nbsp;&nbsp;同&nbsp;&nbsp;&nbsp;院&nbsp;&nbsp;&nbsp;校&nbsp;&nbsp;&nbsp;对&nbsp;&nbsp;&nbsp;比</a></li>
@endsection
@section('main')
    <div class="row">
        <div class="col-md-4 col-md-offset-1 border-shadow" style="padding: 20px">
              <table class="table table-bordered" id="schoolList">
                  <tr>
                      <td colspan="3"  style="vertical-align: middle;text-align: left">
                          <div class="input-group">
                              <input type="text" class="form-control" id="schoolName" placeholder="输入学校名称搜索">
                              <div class="input-group-addon"  id="searchSchool"><span class="glyphicon glyphicon-search"></span></div>
                          </div>                            <hr/>
                          <label>
                              <input type="radio" name="classify" value="1" checked/> 理科
                          </label>
                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <label>
                              <input type="radio" name="classify" value="2"/> 文科
                          </label>
                          <br/>
                          <label>
                              <input type="radio" name="batch" value="0" /> 提前批
                          </label>
                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <label>
                              <input type="radio" name="batch" value="1" checked/> 本一批
                          </label>
                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <label>
                              <input type="radio" name="batch" value="2"/> 本二批
                          </label>
                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <label>
                              <input type="radio" name="batch" value="3"/> 专科
                          </label>
                      </td>
                  </tr>
                  <tr>
                      <th>院校名称</th>
                      <th>所在地&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list" id="addressFetch"></span></th>
                      <th>加入对比</th>
                  </tr>
              </table>
            <div class="text-center">
                <div class="loader-box">
                    <div class="loader">
                    </div>
                    <p>加载中，请稍候！</p>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-1 border-shadow" style="padding: 10px;">
            <div id="charts" style="width:100%;height:600px"></div>
        </div>
    </div>
@endsection
@section('modal')
<div class="modal-background" id="provinceList">
    <div style="width:600px;padding: 20px;" class="border-shadow">
        <table class="table text-center table-bordered fetchbox" id="provinceFetch">
            <tr>
                <td>四川</td>
                <td>北京</td>
                <td>上海</td>
                <td>重庆</td>
                <td>天津</td>
                <td>福建</td>
                <td>黑龙江</td>
            </tr>
            <tr>
                <td>吉林</td>
                <td>辽宁</td>
                <td>山东</td>
                <td>山西</td>
                <td>陕西</td>
                <td>河北</td>
                <td>河南</td>
            </tr>
            <tr>
                <td>湖北</td>
                <td>湖南</td>
                <td>江苏</td>
                <td>江西</td>
                <td>广东</td>
                <td>广西</td>
                <td>云南</td>
            </tr>
            <tr>
                <td>海南</td>
                <td>贵州</td>
                <td>西藏</td>
                <td>宁夏</td>
                <td>甘肃</td>
                <td>青海</td>
                <td>内蒙古</td>
            </tr>
            <tr>
                <td>新疆</td>
                <td>安徽</td>
                <td>浙江</td>
                <td>香港</td>
                <td>澳门</td>
                <td>台湾</td>
                <td style="background-color: white; color:rgb(78,201,142);cursor: pointer" id="fetch">
                    <span  class="glyphicon glyphicon-search"></span>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ URL::asset('js/echarts-line.min.js') }}"></script>
    <script src="{{ URL::asset('js/compare.js') }}"></script>
@endsection
