/**

 @Name：layuiAdmin 公共业务
 @Author：贤心
 @Site：http://www.layui.com/admin/
 @License：LPPL

 */

layui.define(function (exports) {
    var $ = layui.$
        , layer = layui.layer
        , laytpl = layui.laytpl
        , setter = layui.setter
        , view = layui.view
        , admin = layui.admin

    exports('common', {});

});

//选择图标界面

layui.use(['jquery'], function () {
    $ = layui.jquery;
});


//选择图标页面
function showIconsBox() {
    var index = layer.load();
    $.get("/api/information/icons", function (res) {
        layer.close(index);
        if (res.code == 1 && res.data.icons.length > 0) {
            var html = '<ul class="site-doc-icon">';
            $.each(res.data.icons, function (index, item) {
                html += '<li onclick="chioceIcon(this)" data-id="' + item.id + '" data-class="' + item.class + '" data-name="' + item.name + '" >';
                html += '   <i class="layui-icon ' + item.class + '"></i>';
                html += '   <div class="doc-icon-name">' + item.name + '</div>';
                html += '   <div class="doc-icon-code"><xmp>' + item.unicode + '</xmp></div>';
                html += '   <div class="doc-icon-fontclass">' + item.class + '</div>';
                html += '</li>'
            });
            html += '</ul>';
            layer.open({
                type: 1,
                title: '选择图标',
                area: ['1080px', '600px'],
                content: html
            })
        } else {
            layer.msg(res.msg);
        }
    }, 'json')
}

//选择图标
function chioceIcon(obj) {
    var icon_id = $(obj).data('id');
    var name = $(obj).data('class')
    $("input[name='icons']").val(name);
    $("#icon_box").html('<i class="layui-icon ' + $(obj).data('class') + '"></i> ');
    layer.closeAll();
}







