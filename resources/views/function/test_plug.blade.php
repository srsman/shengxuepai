@extends('layout')
@section('main')
    <table class="table table-striped table-bordered text-center" id="schoolTable">
        <tr>
            <th colspan="2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="输入学校名称查询" id="schoolName">
                    <div class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></div>
                </div>
            </th>
            <th colspan="3" class="text-center" style="vertical-align: middle">
                考生位次：{{ Session::get('rank') }}
            </th>
            <th colspan="3" class="text-center" style="vertical-align: middle">
                2017年
            </th>
            <th colspan="3" class="text-center" style="vertical-align: middle">
                2016年
            </th>
            <th colspan="3" class="text-center" style="vertical-align: middle">
                2015年
            </th>
            <th colspan="2" class="text-center" style="vertical-align: middle">
                2018年
            </th>
            <th>

            </th>
        </tr>
        <tr>
            <th>录取概率</th>
            <th>院校名称</th>
            <th>所在地&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-th-list"></span></th>
            <th>全国排名&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
            <th>三年平均位次&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
            <th>调档线&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
            <th>位次</th>
            <th>招生数&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
            <th>调档线&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
            <th>位次</th>
            <th>招生数&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
            <th>调档线&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
            <th>位次</th>
            <th>招生数&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
            <th>招生数&nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" class="glyphicon glyphicon-sort-by-attributes"></span></th>
            <th>院校备注</th>
            <th>操作</th>
        </tr>
    </table>
@endsection
@section('script')
<script src="{{ URL::asset('js/multiLineTable.js') }}"></script>
<script>
    $(document).ready(function () {
        $.get(URL + '/fill/get_school?classify=2&batch=1', function(response) {
            $("#schoolTable").multiLineTable({
                data : response.data,
                length : 15,
                wheelLength : 5,
                dataHandle : function(data) {
                    var avg = data.infos[2017][1] + data.infos[2016][1] + data.infos[2015][1];
                    var k = 3;
                    if (data.infos[2017][1] === 0)
                        k--;
                    if (data.infos[2016][1] === 0)
                        k--;
                    if (data.infos[2015][1] === 0)
                        k--;
                    k = k === 0 ? 1 : k;
                    avg /= k;
                    data.avg = parseInt(avg);
                    
                   return '<tr>' +
                        '<td>1%</td>' +
                        '<td>' + data.name + '</td>' +
                        '<td>' + data.address + '</td>' +
                        '<td>' + (data.rank == null ? '-' : data.rank) + '</td>' +
                        '<td>' + data.avg + '</td>' +
                        '<td>' + (data.infos[2017][0] === 0 ? '-' : data.infos[2017][0]) + '</td>' +
                        '<td>' + (data.infos[2017][1] === 0 ? '-' : data.infos[2017][1]) + '</td>' +
                        '<td>' + (data.infos[2017][2] === 0 ? '-' : data.infos[2017][2]) + '</td>' +
                        '<td>' + (data.infos[2016][0] === 0 ? '-' : data.infos[2016][0]) + '</td>' +
                        '<td>' + (data.infos[2016][1] === 0 ? '-' : data.infos[2016][1]) + '</td>' +
                        '<td>' + (data.infos[2016][2] === 0 ? '-' : data.infos[2016][2]) + '</td>' +
                        '<td>' + (data.infos[2015][0] === 0 ? '-' : data.infos[2015][0]) + '</td>' +
                        '<td>' + (data.infos[2015][1] === 0 ? '-' : data.infos[2015][1]) + '</td>' +
                        '<td>' + (data.infos[2015][2] === 0 ? '-' : data.infos[2015][2]) + '</td>' +
                        '<td>' + (data.infos[2018][0] === 0 ? '-' : data.infos[2018][0]) + '</td>' +
                        '<td>' + (data.infos[2018][1] === 0 ? '-' : data.infos[2018][1]) + '</td>' +
                        '<td style="padding: 2px"><button class="btn btn-default btn-sm"  style="padding: 5px 20px;" select-btn type="button"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;选择</button></td>' +
                        '</tr>';
                },
                userHandle : {
                        'fetchSchool' : function(data){

                            var name = $("#schoolName").val();
                            var res = new Array();
                            for(var i = 0; i < data.length; i++) {
                                if(data[i].name.indexOf(name) !== -1) {
                                   res.push(data[i])
                                }
                            }
                            return res;
                        },
                }
            });
        })

        $("#search").click(function(){
            window.dispatchEvent( new Event("fetchSchool"));
        })

        $("#schoolName").keyup(function() {
            window.dispatchEvent(new Event("fetchSchool"));
        })
    })
</script>
@endsection