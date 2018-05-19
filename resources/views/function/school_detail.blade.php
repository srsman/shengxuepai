@extends('layout')
@section('navbar')
    <li class="navbar-a-underline navbar-a-active"><a href="javascript:;">目&nbsp;&nbsp;&nbsp;标&nbsp;&nbsp;&nbsp;大&nbsp;&nbsp;&nbsp;学&nbsp;&nbsp;&nbsp;详&nbsp;&nbsp;&nbsp;情</a></li>
@endsection
@section('main')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1 id="schoolName">{{ $basic->name }}</h1>
        <hr/>
        <table class="table table-bordered">
            <tr>
                <th width="10%">所在地区</th>
                <td width="20%">{{  $basic->province }}-{{ $basic->city }}</td>
                <th width="10%">全国排名</th>
                <td width="20%">{{ $basic->ranking_1 }}</td>
                <th width="10%">专业排名</th>
                <td width="30%">{{ $basic->ranking_3 }}</td>
            </tr>
            <tr>
                <th>高校隶属</th>
                <td>{{ $basic->level }}</td>
                <th>学校性质</th>
                <td>{{ $basic->public }}</td>
                <th>全省排名</th>
                <td>{{ $basic->ranking_2 }}</td>
            </tr>
            <tr>
                <th>硕士点</th>
                <td>{{ $classNums[6] }}</td>
                <th>博士点</th>
                <td>{{ $classNums[4] }}</td>
                <th>院校特色</th>
                <td> @if($basic->attr_num & (1 << 5))211 @endif  @if($basic->attr_num & (1 << 6))985 @endif</td>
            </tr>
            <tr>
                <th>卓越计划</th>
                <td colspan="3">
                    <span style="margin: 0px 10px" @if(!($basic->attr_num & (1 << 4)))hidden @endif><span class="ok-gly glyphicon glyphicon-ok"></span> 工程师</span>
                    <span style="margin: 0px 10px" @if(!($basic->attr_num & (1 << 3)))hidden @endif><span class="ok-gly glyphicon glyphicon-ok"></span> 医生</span>
                    <span style="margin: 0px 10px" @if(!($basic->attr_num & (1 << 2)))hidden @endif><span class="ok-gly glyphicon glyphicon-ok"></span> 法律</span>
                    <span style="margin: 0px 10px" @if(!($basic->attr_num & (1 << 1)))hidden @endif><span class="ok-gly glyphicon glyphicon-ok"></span> 教师</span>
                    <span style="margin: 0px 10px" @if(!($basic->attr_num & (1 << 0)))hidden @endif><span class="ok-gly glyphicon glyphicon-ok"></span> 农林</span>
                </td>
                <th>双一流</th>
                <td>@if($basic->attr_num & (1 << 7))一流学科 @endif @if($basic->attr_num & (1 << 8))一流大学 @endif</td>
            </tr>
            <tr>
                <th>招生官网</th>
                <td><a href="{{ $basic->s_z_url }}">点击查看</a></td>
                <th>招生电话</th>
                <td>{{ $basic->zs_phone }}</td>
                <th>招生章程</th>
                <td><a href="{{ $basic->zs_zc }}">点击查看</a></td>
            </tr>
        </table>
        <hr/>
        <div class="border-shadow" style="padding: 20px">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#schoolInfo" aria-controls="home" role="tab" data-toggle="tab">院校录取数据</a></li>
                <li role="presentation"><a href="#majorInfo" aria-controls="profile" role="tab" data-toggle="tab">专业录取数据</a></li>
                <li role="presentation"><a href="#schoolBasic" aria-controls="messages" role="tab" data-toggle="tab">各项指标</a></li>
                <li role="presentation"><a href="#description" aria-controls="settings" role="tab" data-toggle="tab">院校介绍</a></li>
                <li role="presentation"><a href="#videos" aria-controls="settings" role="tab" data-toggle="tab">相关视频</a></li>
            </ul>
            <hr/>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="schoolInfo">
                    <form class="form-inline text-center" style="margin-bottom: 10px">
                        <div class="form-group">
                            <select class="form-control" id="schoolS1">
                                <option value="0">理科</option>
                                <option value="1">文科</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-left: 30px">
                            <select class="form-control" id="schoolS2">
                                <option value="1">本一批</option>
                                <option value="2">本二批</option>
                                <option value="0">提前批</option>
                                <option value="3">专科</option>
                            </select>
                        </div>
                    </form>
                    <table class="table table-bordered" id="schoolScore">
                        <tr>
                            <th>年份</th>
                            <th>最低分</th>
                            <th>最低分差</th>
                            <th>平均分</th>
                            <th>平均分差</th>
                            <th>录取位次</th>
                            <th>招生计划</th>
                        </tr>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="majorInfo">
                    <form class="form-inline text-center" style="margin-bottom: 10px">
                        <div class="form-group">
                            <select class="form-control" id="majorS1">
                                <option value="1">理科</option>
                                <option value="2">文科</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-left: 30px">
                            <select class="form-control" id="majorS2">
                                <option value="1">本一批</option>
                                <option value="2">本二批</option>
                                <option value="0">提前批</option>
                                <option value="3">专科</option>
                            </select>
                        </div>
                    </form>
                    <table class="table table-bordered " id="majorScore">
                        <tr>
                            <th colspan="2"></th>
                            <th colspan="3">2017年</th>
                            <th colspan="3">2016年</th>
                            <th colspan="3">2015年</th>
                        </tr>
                        <tr>
                            <th width="30%">专业名称</th>
                            <th width="10%">科别</th>
                            <th width="5%">最低分</th>
                            <th width="5%">位次</th>
                            <th width="5%">招生数</th>
                            <th width="5%">最低分</th>
                            <th width="5%">位次</th>
                            <th width="5%">招生数</th>
                            <th width="5%">最低分</th>
                            <th width="5%">位次</th>
                            <th width="5%">招生数</th>
                        </tr>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane text-center" id="schoolBasic">
                    <table class="table table-bordered">
                        <tr>
                            <th rowspan="2">地域指标</th>
                            <th>省份</th>
                            <th>地域级别</th>
                            <th>城市</th>
                            <th>城市级别</th>
                        </tr>
                        <tr>
                            <td>{{ $basic->province }}</td>
                            <td>--</td>
                            <td>{{ $basic->city }}</td>
                            <td>--</td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <tr>
                            <th rowspan="2">教学指标</th>
                            <th>国家重点<br/>一级学科</th>
                            <th>国家重点<br/>二级学科</th>
                            <th>国家重点<br/>培育学科</th>
                            <th>博士学位<br/>一级学科</th>
                            <th>博士学位<br/>二级学科</th>
                            <th>硕士学位<br/>一级学科</th>
                            <th>硕士学位<br/>二级学科</th>
                            <th>专任教师</th>
                        </tr>
                        <tr>
                            <td>{{ $classNums[0] }}</td>
                            <td>{{ $classNums[1] }}</td>
                            <td>{{ $classNums[2] }}</td>
                            <td>{{ $classNums[3] }}</td>
                            <td>{{ $classNums[4] }}</td>
                            <td>{{ $classNums[5] }}</td>
                            <td>{{ $classNums[6] }}</td>
                            <td>--</td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <tr>
                            <th rowspan="6">专业指标</th>
                            <th colspan="2">自然科学</th>
                            <th colspan="2">理学</th>
                            <th colspan="2">工学</th>
                            <th colspan="2">农学</th>
                            <th colspan="2">医学</th>
                            <th colspan="2">社会科学</th>
                            <th colspan="2">哲学</th>
                        </tr>
                        <tr>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                        </tr>
                        <tr>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_1)){{ $majorLevels->m_1 }}@else -- @endif</td>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_3)){{ $majorLevels->m_3 }}@else -- @endif</td>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_4)){{ $majorLevels->m_4 }}@else -- @endif</td>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_5)){{ $majorLevels->m_5 }}@else -- @endif</td>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_6)){{ $majorLevels->m_6 }}@else -- @endif</td>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_2)){{ $majorLevels->m_2 }}@else -- @endif</td>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_7)){{ $majorLevels->m_7 }}@else -- @endif</td>
                        </tr>
                        <tr>
                            <th  colspan="2">经济学</th>
                            <th  colspan="2">法学</th>
                            <th  colspan="2">教育学</th>
                            <th  colspan="2">文学</th>
                            <th  colspan="2">历史学</th>
                            <th  colspan="2">管理学</th>
                            <th  colspan="2">艺术学</th>
                        </tr>
                        <tr>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                        </tr>
                        <tr>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_8)){{ $majorLevels->m_8 }}@else -- @endif</td>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_9)){{ $majorLevels->m_9 }}@else -- @endif</td>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_10)){{ $majorLevels->m_10 }}@else -- @endif</td>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_11)){{ $majorLevels->m_11 }}@else -- @endif</td>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_12)){{ $majorLevels->m_12 }}@else -- @endif</td>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_13)){{ $majorLevels->m_13 }}@else -- @endif</td>
                            <td>--</td>
                            <td class="text-danger">@if(isset($majorLevels->m_14)){{ $majorLevels->m_14 }}@else -- @endif</td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <tr>
                            <th rowspan="2">就业指标</th>
                            <th>毕业半年后平均就业率</th>
                            <th>毕业半年后平均工资</th>
                        </tr>
                        <tr>
                            <td>--</td>
                            <td>--</td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <tr>
                            <th rowspan="3">其他指标</th>
                            <th colspan="2">教师水平</th>
                            <th colspan="2">新生质量</th>
                            <th colspan="2">毕业生质量</th>
                        </tr>
                        <tr>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                            <td>名次</td>
                            <td>级别</td>
                        </tr>
                        <tr>
                            <td>@if(isset($teacerLevel->teacher_ranking)){{ $teacherLevel->teacher_ranking }}@else -- @endif</td>
                            <td class="text-danger">@if(isset($teacerLevel->teacher_level)){{ $teacherLevel->teacher_level }}@else -- @endif</td>
                            <td>@if(isset($teacerLevel->student_level)){{ $teacherLevel->student_level }}@else -- @endif</td>
                            <td class="text-danger">@if(isset($teacerLevel->student_ranking)){{ $teacherLevel->student_ranking }}@else -- @endif</td>
                            <td>--</td>
                            <td class="text-danger">@if(isset($teacerLevel->graduatio_score)){{ $teacherLevel->graduatio_score }}@else -- @endif</td>
                        </tr>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="description" style="padding: 0px 30px">
                    @if(isset($video->content)){!! $video->content !!}@endif
                    <hr/>
                    <a href="@if(isset($video->baike)){{ $video->baike }}@else javascript:;@endif">点击查看详细院校信息</a>
                </div>
                <div role="tabpanel" class="tab-pane text-center" id="videos">
                    {!! $video->video_html !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')

@endsection
@section('script')
    <script src="{{ URL::asset('js/school_detail.js') }}"></script>
@endsection