@extends('admin.layouts.app')

@section('content')
    <div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
      <div class="layui-header">
        <!-- 头部区域 -->
        <ul class="layui-nav layui-layout-left">
          <li class="layui-nav-item layadmin-flexible" lay-unselect>
            <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
              <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="{{request()->getSchemeAndHttpHost()}}" target="_blank" title="前台">
              <i class="layui-icon layui-icon-website"></i>
            </a>
          </li>
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;" layadmin-event="refresh" title="刷新">
              <i class="layui-icon layui-icon-refresh-3"></i>
            </a>
          </li>

        </ul>
        <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">

{{--          <li class="layui-nav-item" lay-unselect>--}}
{{--            <a lay-href="app/message/index.html" layadmin-event="message" lay-text="消息中心">--}}
{{--              <i class="layui-icon layui-icon-notice"></i>--}}

{{--                <!-- 如果有新消息，则显示小圆点 -->--}}
{{--              <span class="layui-badge-dot"></span>--}}
{{--            </a>--}}
{{--          </li>--}}
{{--          <li class="layui-nav-item layui-hide-xs" lay-unselect>--}}
{{--            <a href="javascript:;" layadmin-event="theme">--}}
{{--              <i class="layui-icon layui-icon-theme"></i>--}}
{{--            </a>--}}
{{--          </li>--}}
{{--          <li class="layui-nav-item layui-hide-xs" lay-unselect>--}}
{{--            <a href="javascript:;" layadmin-event="note">--}}
{{--              <i class="layui-icon layui-icon-note"></i>--}}
{{--            </a>--}}
{{--          </li>--}}
{{--          <li class="layui-nav-item layui-hide-xs" lay-unselect>--}}
{{--            <a href="javascript:;" layadmin-event="fullscreen">--}}
{{--              <i class="layui-icon layui-icon-screen-full"></i>--}}
{{--            </a>--}}
{{--          </li>--}}
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;">

                <cite>{{admin()->account}}</cite>
            </a>
            <dl class="layui-nav-child">
              <dd><a lay-href="set/user/info.html">基本资料</a></dd>
              <dd><a lay-href="set/user/password.html">修改密码</a></dd>
              <hr>

              <dd layadmin-event="logout" style="text-align: center;"><a href="{{url()->route('admin-login-out')}}">退出</a></dd>
            </dl>
          </li>

          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="about"><i class="layui-icon layui-icon-more-vertical"></i></a>
          </li>
          <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-unselect>
            <a href="javascript:;" layadmin-event="more"><i class="layui-icon layui-icon-more-vertical"></i></a>
          </li>
        </ul>
      </div>

        <!-- 侧边菜单 -->
      <div class="layui-side layui-side-menu">
        <div class="layui-side-scroll">
          <div class="layui-logo" lay-href="home/console.html">
            <span>@if(isset($meta)){{ $meta['title'] }}@else {{ env('APP_NAME') }} @endif</span>
          </div>
            @include('admin.layouts.menu')
        </div>
      </div>

        <!-- 页面标签 -->
      <div class="layadmin-pagetabs" id="LAY_app_tabs">
        <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-down">
          <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
            <li class="layui-nav-item" lay-unselect>
              <a href="javascript:;"></a>
              <dl class="layui-nav-child layui-anim-fadein">
                <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
              </dl>
            </li>
          </ul>
        </div>
        <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
          <ul class="layui-tab-title" id="LAY_app_tabsheader">
            <li lay-id="home/console.html" lay-attr="home/console.html" class="layui-this"><i class="layui-icon layui-icon-home"></i></li>
          </ul>
        </div>
      </div>


        <!-- 主体内容 -->
      <div class="layui-body" id="LAY_app_body">
        <div class="layadmin-tabsbody-item layui-show">
          <iframe src="{{url()->route('admin-welcome')}}" frameborder="0" class="layadmin-iframe"></iframe>
        </div>
      </div>

        <!-- 辅助元素，一般用于移动设备下遮罩 -->
      <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
  </div>
@endsection

@section('js_ext')
    <script>
          layui.config({
              base: "{{url('layuiadmin')}}/" //静态资源所在路径
          }).extend({
              index: 'lib/index' //主入口模块
          }).use('index', function () {
              var $ = layui.$,
                  admin = layui.admin;

              //退出
              admin.events.logout = function () {
                  //执行退出接口
                  admin.req({
                      url: "{{url()->route('admin-login-out')}}"
                      , type: 'get'
                      , data: {}
                      , done: function (res) { //这里要说明一下：done 是只有 response 的 code 正常才会执行。而 succese 则是只要 http 为 200 就会执行

                          //清空本地记录的 token，并跳转到登入页
                          admin.exit(function () {
                              location.href = "{{url()->route('admin-login')}}";
                          });
                      }
                  });
              };
          });
    </script>
@endsection
