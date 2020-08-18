@extends('admin.layouts.app')

@section('content')
    <div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-header">添加菜单</div>


      <div class="layui-card-body" style="padding: 15px;">
        <form class="layui-form" action="" lay-filter="component-form-group">
            <div class="layui-form-item">
                <label class="layui-form-label">单行选择框</label>
                <div class="layui-input-block">
                  <select name="interest" lay-filter="aihao">
                    <option value=""></option>
                    <option value="0">写作</option>
                    <option value="1" selected="">阅读</option>
                    <option value="2">游戏</option>
                    <option value="3">音乐</option>
                    <option value="4">旅行</option>
                  </select>
                </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">菜单名称</label>
            <div class="layui-input-block">
              <input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="菜单名称" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">路由地址</label>
            <div class="layui-input-block">
              <input type="text" name="url" lay-verify="required" placeholder="路由地址" autocomplete="off" class="layui-input">
            </div>
          </div>
            <div class="layui-form-item">
                <label class="layui-form-label">icon</label>
                <div class="layui-input-block">
                  <input type="text" name="name" autocomplete="off" placeholder="icon" class="layui-input">
                </div>
            </div>
             <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-block">
                  <input type="text" name="name" lay-verify="number" autocomplete="off" placeholder="排序" class="layui-input" value="999">
                </div>
            </div>
          <div class="layui-form-item">
            <label class="layui-form-label">开关-默认开</label>
            <div class="layui-input-block">
              <input type="checkbox" checked="" name="switch" lay-skin="switch" lay-filter="component-form-switchTest" lay-text="ON|OFF" value="1">
            </div>
          </div>
            <input type="hidden" name="status" value="1">
          <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">普通文本域</label>
            <div class="layui-input-block">
              <textarea name="text" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
          </div>
          <div class="layui-form-item layui-layout-admin">
            <div class="layui-input-block">
              <div class="layui-footer" style="left: 0;">
                <button class="layui-btn" lay-submit="" lay-filter="component-form-demo1">提交</button>
                <button class="layui-btn layui-btn-primary" onclick="window.location.href='{{url()->route('menu-index')}}';return false;">返回</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('js_ext')
    <script>
      layui.config({
          base: "{{url('layuiadmin')}}/" //静态资源所在路径
      }).extend({
          index: 'lib/index' //主入口模块
      }).use(['index', 'form', 'laydate'], function () {
          var $ = layui.$
              , admin = layui.admin
              , element = layui.element
              , layer = layui.layer
              , laydate = layui.laydate
              , form = layui.form;

          form.render(null, 'component-form-group');

          laydate.render({
              elem: '#LAY-component-form-group-date'
          });

          /* 自定义验证规则 */
          form.verify({
              title: function (value) {
                  if (value.length < 5) {
                      return '标题至少得5个字符啊';
                  }
              }
              , pass: [/(.+){6,12}$/, '密码必须6到12位']
              , content: function (value) {
                  layedit.sync(editIndex);
              }
          });

          /* 监听指定开关 */
          form.on('switch(component-form-switchTest)', function (data) {
              console.log(data)
              if (this.cheked) {
                  $('input[name=status]').val(1)
              } else {
                  $('input[name=status]').val(0)
              }
              console.log($('input[name=status]').val())
          });

          /* 监听提交 */
          form.on('submit(component-form-demo1)', function (data) {
              parent.layer.alert(JSON.stringify(data.field), {
                  title: '最终的提交信息'
              })
              return false;
          });
      });
  </script>
@endsection
