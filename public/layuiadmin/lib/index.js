/**

 @Name：layuiAdmin iframe版主入口
 @Author：贤心
 @Site：http://www.layui.com/admin/
 @License：LPPL

 */

layui.extend({
    setter: 'config' //配置模块
    , admin: 'lib/admin' //核心模块
    , view: 'lib/view' //视图渲染模块
}).define(['setter', 'admin'], function (exports) {
    var setter = layui.setter
        , element = layui.element
        , admin = layui.admin
        , tabsPage = admin.tabsPage
        , view = layui.view

        //打开标签页
        , openTabsPage = function (url, text) {
            //遍历页签选项卡
            var matchTo
                , tabs = $('#LAY_app_tabsheader>li')
                , path = url.replace(/(^http(s*):)|(\?[\s\S]*$)/g, '');

            tabs.each(function (index) {
                var li = $(this)
                    , layid = li.attr('lay-id');

                if (layid === url) {
                    matchTo = true;
                    tabsPage.index = index;
                }
            });

            text = text || '新标签页';

            if (setter.pageTabs) {
                //如果未在选项卡中匹配到，则追加选项卡
                if (!matchTo) {
                    $(APP_BODY).append([
                        '<div class="layadmin-tabsbody-item layui-show">'
                        , '<iframe src="' + url + '" frameborder="0" class="layadmin-iframe"></iframe>'
                        , '</div>'
                    ].join(''));
                    tabsPage.index = tabs.length;
                    element.tabAdd(FILTER_TAB_TBAS, {
                        title: '<span>' + text + '</span>'
                        , id: url
                        , attr: path
                    });
                }
            } else {
                var iframe = admin.tabsBody(admin.tabsPage.index).find('.layadmin-iframe');
                iframe[0].contentWindow.location.href = url;
            }

            //定位当前tabs
            element.tabChange(FILTER_TAB_TBAS, url);
            admin.tabsBodyChange(tabsPage.index, {
                url: url
                , text: text
            });
        }

        , APP_BODY = '#LAY_app_body', FILTER_TAB_TBAS = 'layadmin-layout-tabs'
        , $ = layui.$, $win = $(window);

    //初始
    if (admin.screen() < 2) admin.sideFlexible();

    //将模块根路径设置为 controller 目录
    layui.config({
        base: setter.base + 'modules/'
    });

    //扩展 lib 目录下的其它模块
    layui.each(setter.extend, function (index, item) {
        var mods = {};
        mods[item] = '{/}' + setter.base + 'lib/extend/' + item;
        layui.extend(mods);
    });

    view().autoRender();

    //加载公共模块
    layui.use('common');

    //对外输出
    exports('index', {
        openTabsPage: openTabsPage
    });
});

/**
 * 关闭弹出层 父级页面刷新
 * @param isReload
 * @returns {boolean}
 */
function close_panel(isReload = false) {
    let index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
    if (isReload === true) {
        window.parent.location.reload()
    }
    layer.closeAll();
    parent.layer.close(index); //再执行关闭
    return true;
}

/**
 * 关闭弹出层 父级页面table刷新
 * @param table
 * @returns {boolean}
 */
function close_panel_reload_table(table = "test-table-toolbar") {
    parent.layui.table.reload('test-table-toolbar');
    layer.closeAll();
    let index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
    parent.layer.close(index); //再执行关闭
    return true;
}

/**
 *  table刷新
 * @param table
 * @param c
 * @returns {boolean}
 */
function table_reload(table, c) {
    table.reload(Object.keys(table.cache).shift(), {
        page: {
            curr: table.curr
        }
        , where: {
            //默认会带有上一次的条件
        }
    });
    c !== undefined ? c() : console.log("callback in not be defined")
    table.render();
    return true;
}
