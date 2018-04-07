# 多行浏览表格插件说明文档

>多行浏览表格插件是自定义jQuery插件的一种，目的是为了显示超长行的表格，
采用重新重绘表格部分单元的内容实现，是该项目中比较核心的js。现在把该插件的一些用法整理如下。

## 基本过程

数据目前使用一次性载入的方式实现，一次载入页面全部数据（这个数据量请控制在1000行以内)
载入数据以后，保存在两个地方，一是data用于实际使用的数据源，二是originData用于保存原始的数据。
data中的数据一般是经过筛选，排序后的数据。页面渲染的时候，通过参数virLeft控制渲染的起点，
通过length控制一次渲染的行数，渲染时，通过合成字符串写入DOM的方式实现（因此不建议一次显示过多行数）
鼠标滚动时，识别鼠标滚动事件，调整起点后，重新渲染。

## 参数说明

该js插件并没有太多的参数，但是请使用时请仔细思考，尤其是涉及到如何在外部过滤数据的时候，
千万不要让事件出现死循环。

参数表格如下：

| 参数名称 | 参数类型 | 默认值 | 含义 | 备注 |
| :------ | :------ | :------ | :------ |  :------ |
| class | string |  table table-bordered table-condensed | 表格的样式 | |
| title | array | [] | 表格标题 | 考虑到表头可能很复杂，尽量提前设置好，然后通过titleLength忽略 |
| titleLength | int | 1  | 表格表头的长度减1的大小 | 这个值用于重新渲染DOM时，指定需要保留的行数，仅保留小于或等于这个值的行数（从0开始）|
| data | array | []  | 数据源可以直接是JSON | |
| originalData | array | [] | 原始数据源 | 这个值可以忽略不计 |
| showProgress | boolean | true | 是否显示进度条 | |
| length |int |  15  | 一页显示的数据最大行数  |请根据屏幕适当调整 |
| wheelLength | int |  5 | 一次滚动出现的行数 | 建议设置为length的1/3|
| endTooltip | boolean | true | 是否在最后一行添加提醒 | 会提醒一个到底啦！ |
| virLeft | int | 0  | 页面第一次渲染的起点 | 一般为0，特殊情况，自行更改 |
| static | boolean |  true | 据滚动时，不请求数据，data中存放完整数据 | |
| dataHandle | function | function(data){}  |告诉插件如何渲染数据 | 由于表格内容各种各样，所以如何渲染表格的每一行，有开发者自行决定，避免后端进行过多的计算 |
| userHandle | array or object | {} | 告诉插件如何处理原始数据的自定义事件及其函数集合 | |
| userHandle | array or object | {} | 告诉插件如何处理正在使用中数据的自定义事件及其函数集合 | |

>必要参数就一个data，就可以让表格开始工作了。

## 如何自定义渲染方式？

为了尽可能避免后端进行计算，开发者发过来的数据可能是未经格式化的数据，很有可能并不是按照表格的一一对应关系，
所以允许（强制，后期可以照顾一下数据一一对应的情况）开发者告诉插件如何渲染某一行数据（仅渲染一行即可，插件内部自动循环）

这个自定义渲染位于dataHandle配置参数中，格式如下：

```javascript
$("#youTableID").multiLineTable({
    dataHandle : funtion(data) {
        var avg = (data.attr[0] + data.attr[1] + data.attr[2]) / 3;
        return '<tr>' +
            '<td>' + data.attr1 +'</td>' +
            '<td>' + data.attr2 +'</td>' +
            '<td>' + data.attr3 +'</td>' +
            '<td>' + data.attr5 +'</td>' +
            '<td>' + data.attr4 +'</td>' +
            '<td>' + avg +'</td>' +
        '</tr>';
    }
})
```

匿名函数中的data参数为原始数据中经过for循环后产生的某一行数据，请根据自己的实际数据访问元素。
从上述代码可以看出，avg参数是前端自动计算的值，不需要后端计算；也可以看出attr5可以放在attr4之前，完全自定义。
返回值是一个包含完整`<tr></tr>`的HTML字符串，可以在上面根据条件加一些自己的样式，比如显示红色字体等。

## 如何修改表格中已有的数据？

目前作者还没有想出什么完美的办法，目前主要流程如下：

- 配置自定义事件名称，以及事件发生时调用的匿名函数
- 匿名函数中，参数代表的是原始数据，就是页面第一次传入的全部数据
- 在匿名函数中，进行自定义处理，处理后返回完整的新的数据（数据行数可以修改，顺序可以修改，但是某一行数据的原始顺序不能打乱）
- 在插件外，需要修改数据是，发出信号，即会调用绑定的匿名函数
- 匿名函数返回值以后，首先调整virLeft为0，然后按照配置重新渲染数据。

请注意自定义事件命名时不要冲突，按照变量的命名规则进行命名，不要使用`空格 特殊字符\n \t \r`等，否则事件可能不会工作。

```javascript
$("#youTableID").multiLineTable({
    userHandle : {
        'eventName1' : function(oData) {
            var fetchArg = $("#xxxx").val();

            var res = [];
            for(var i = 0; i < oData.length; i++) {
                if(xxxxxx) {
                    res.push(oData[i]);
                }
            }
            return res;
        },
        'eventName2' : function(oData) {
            var sortArg = $("#xxxx").val();

            oData.sort(function(a, b) {
                return a.attr - b.attr;
            })
            return oData;
        }
    }
})

$("#xxxx").click(function(){
    window.dispatchEvent( new event('eventName1') );
})


$("#xxxx").dblclick(function(){
    window.dispatchEvent( new event('eventName2') );
})
```

修改数据的写法介绍如上，当需要更新数据时，请发出自定义事件（理解为信号可能跟贴切)。
特别说明`userHandle`和`userHandleLocal`的区别在于，Local指定的是，已经被自定义事件修改过的数据，
可能被筛选，可能被搜索过滤过，不同于原始数据。请根据实际开发需求采用不同的参数！