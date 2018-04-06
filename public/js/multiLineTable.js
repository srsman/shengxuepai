;(function($) {
    $.fn.multiLineTable = function (options) {
        var defaults = {
            class : 'table table-bordered table-condensed ',
            title : [],
            titleLength : 1,
            data : [],
            originalData : [],
            showProgress : true,
            length : 15,
            wheelLength : 5,
            endTooltip : true,
            virLeft : 0,
            static : true, //数据滚动时，不请求数据，data中存放完整数据
            dataHandle : function(data){},
            userHandle : {},
        };
        var settings = $.extend({}, defaults, options);

        var virLeft = settings.virLeft; //虚拟左指针 [ )区间，0为起点

        var that = $(this);

        settings.originalData = settings.data;
        render();

        /**
         * 绑定鼠标滚动事件
         * 火狐
         */
        var stTarget = document.getElementById($(this).attr('id'));
        stTarget.addEventListener("DOMMouseScroll", function(event) {
            wheelMove(event.detail)
        });

        /**
         * 其他浏览器
         */
        stTarget.onmousewheel = function(event) {
            event = event || window.event;
            wheelMove(-event.wheelDelta);
        };
        for(var functionName in settings.userHandle) {
            window.addEventListener(functionName, function(e){
                settings.data = eval("settings.userHandle" + "." + functionName + "(settings.originalData)");
                render();
            });
        }

        /**
         * 根据虚拟的左右指针渲染数据
         */
        function render() {

            $(that).children().eq(0).children(":gt("+settings.titleLength+")").remove(); //删除多余部分
            var str = '';
            for(var i = virLeft; i < virLeft + settings.length && i < settings.data.length; i++) {
                str  += settings.dataHandle(settings.data[i]);
            }

            if(virLeft ===  settings.data.length - settings.length + 1 ) {
                str += '<tr><td colspan="'+$(that).children().eq(0).children("tr:last").children().length+'" class="text-center text-success">到底啦~</td></tr>';
            }
            $(that).append(str);
        }

        /**
         * 处理鼠标滚动列表刷新
         * @param angle
         */
        function wheelMove(angle) {
            if(angle > 0) { //向下
                virLeft += settings.wheelLength;
            } else {
                virLeft -= settings.wheelLength;
            }
            if(virLeft < 0) {
                virLeft = 0;
            } else if (virLeft >= settings.data.length - settings.length + 1) {
                virLeft = settings.data.length - settings.length + 1;
            }

            render(); //重新渲染
        }

        /**
         * 渲染表头 如果提供了表头
         */
        function initTitle() {
            //
        }
    }
})(jQuery);