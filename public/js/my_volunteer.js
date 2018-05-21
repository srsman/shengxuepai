$(document).ready(function() {
   $.get(URL + "/fill/volunteer_list", function(response) {
      if(response.status) {
          for(var i = 0; i < response.data.length; i++) {
              if(response.data[i].type == 1) {
                  $("#gaokao").children().eq(0).append('<tr>' +
                        '<td>'+response.data[i].table_name+'</td>' +
                        '<td>'+response.data[i].batch+'</td>' +
                        '<td>'+response.data[i].classify+'</td>' +
                        '<td>'+response.data[i].created_at+'</td>' +
                        '<td><a href="#" onclick="delTable('+response.data[i].volunteer_id+', $(this))">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">查看或修改</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">导出</a></td>' +
                      '</tr>')
              } else {
                  $("#prepare").children().eq(0).append('<tr>' +
                      '<td>'+response.data[i].table_name+'</td>' +
                      '<td>'+response.data[i].batch+'</td>' +
                      '<td>'+response.data[i].classify+'</td>' +
                      '<td>'+response.data[i].created_at+'</td>' +
                      '<td><a href="#" onclick="delTable('+response.data[i].volunteer_id+', $(this))">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">查看或修改</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">导出</a></td>' +
                      '</tr>')
              }
          }
      }
   });


});

function delTable(id, that) {
    $("#deleteConfirm").children(".border-shadow").css('position', 'fixed');
    $("#deleteConfirm").children(".border-shadow").css('top', $(that).offset().top - document.documentElement.scrollTop+ 20);
    $("#deleteConfirm").children(".border-shadow").css('left', $(that).offset().left - 200);
    $("#deleteConfirm").fadeIn();
}