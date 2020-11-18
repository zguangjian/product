@extends('admin.layouts.app')
@section('content')
    <div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">
    <div class="layadmin-user-login-main">
      <div class="layadmin-user-login-box layadmin-user-login-header">
        <h2>@if(isset($meta)){{ $meta['title'] }}@else {{ env('APP_NAME') }} @endif</h2>
          {{--        <p>layui 官方出品的单页面后台管理模板系统</p>--}}
      </div>
      <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
          <input type="text" name="account" id="LAY-user-login-username" lay-verify="required" placeholder="用户名" class="layui-input">
        </div>
        <div class="layui-form-item">
          <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
          <input type="password" name="password" id="LAY-user-login-password" lay-verify="required" placeholder="密码" class="layui-input">
        </div>
        <div class="layui-form-item">
          <div class="layui-row">
            <div class="layui-col-xs7">
              <label class="layadmin-user-login-icon layui-icon layui-icon-vercode" for="LAY-user-login-vercode"></label>
              <input type="text" name="captcha" id="LAY-user-login-vercode" lay-verify="required" placeholder="图形验证码" class="layui-input">
            </div>
            <div class="layui-col-xs5">
              <div style="margin-left: 10px;">
                <img src="{{captcha_src()}}" class="layadmin-user-login-codeimg" onclick="this.src='{{captcha_src()}}'+Math.random()">
              </div>
            </div>
          </div>
        </div>
        <div class="layui-form-item">
          <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit">登 入</button>
        </div>
      </div>
    </div>

    <div class="layui-trans layadmin-user-login-footer">
      <p>© 2018 <a href="http://www.layui.com/" target="_blank">layui.com</a></p>
      <p>
        <span><a href="http://www.layui.com/admin/#get" target="_blank">获取授权</a></span>
        <span><a href="http://www.layui.com/admin/pro/" target="_blank">在线演示</a></span>
        <span><a href="http://www.layui.com/admin/" target="_blank">前往官网</a></span>
      </p>
    </div>
    </div>
@endsection

@section('js_ext')
    <script>
      layui.config({
          base: "{{url('layuiadmin')}}/" //静态资源所在路径
      }).extend({
          index: 'lib/index' //主入口模块
      }).use(['index', 'user'], function () {
          var $ = layui.$,
              form = layui.form;

          form.render();
          //提交
          form.on('submit(LAY-user-login-submit)', function (obj) {
              layer.load();
              //请求登入接口
              $.ajax({
                  data: obj.field,
                  type: 'post',
                  success: function (res) {
                      if (res.code === 0) {
                          layer.msg(res.msg, {icon: 1, time: 2000}, function () {
                              window.location.href = res.data.url;
                          })
                      } else {
                          layer.msg(res.msg, {icon: 2, time: 2000});
                      }
                  }
              })
              $('.layadmin-user-login-codeimg').attr('src', "{{captcha_src()}}" + Math.random());
              layer.closeAll();
          });
      });
  </script>
@endsection
