@extends('admin.layouts.app')

@section('content')
    <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">修改密码</div>
          <div class="layui-card-body" pad15>

            <div class="layui-form" lay-filter="">
              <div class="layui-form-item">
                <label class="layui-form-label">当前密码</label>
                <div class="layui-input-inline">
                  <input type="password" name="oldPassword" lay-verify="required" lay-verType="tips" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">新密码</label>
                <div class="layui-input-inline">
                  <input type="password" name="password" lay-verify="pass" lay-verType="tips" autocomplete="off" id="LAY_password" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">6到16个字符</div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">确认新密码</label>
                <div class="layui-input-inline">
                  <input type="password" name="repassword" lay-verify="repass" lay-verType="tips" autocomplete="off" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit lay-filter="setmypass">确认修改</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('js_ext')
    <script>
  layui.config({
      base: '../../../layuiadmin/' //静态资源所在路径
  }).extend({
      index: 'lib/index' //主入口模块
  }).use(['index', 'set'], function () {
      let $ = layui.$,
          admin = layui.admin,
          form = layui.form;

      form.on('submit(setmypass)', function (obj) {
          layer.load();
          //提交修改
          admin.req({
              type: 'post'
              , data: obj.field
              , success: function (data) {
                  layer.msg(data.msg, {icon: 1, time: 2000}, function () {
                      layer.closeAll();
                  })
              }
          });
          return false;
      });
  });
  </script>
@endsection
