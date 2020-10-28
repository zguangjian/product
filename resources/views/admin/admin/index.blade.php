@extends("admin.layouts.app")

@section("content")
    <div class="layui-card layadmin-header">
    <div class="layui-breadcrumb" lay-filter="breadcrumb">
      <a lay-href="">主页</a>
      <a><cite>组件</cite></a>
      <a><cite>数据表格</cite></a>
      <a><cite>开启分页</cite></a>
    </div>
  </div>

    <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">开启分页</div>
          <div class="layui-card-body">
            <table class="layui-hide" id="test-table-page"></table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section("js_ext")
    <script>
  layui.config({
      base: "{{url('layuiadmin')}}/" //静态资源所在路径
  }).extend({
      index: 'lib/index' //主入口模块
  }).use(['index', 'table'], function () {
      var admin = layui.admin
          , table = layui.table;

      table.render({
          elem: '#test-table-page'
          , url: "{{url()->current()}}"
          , cols: [[
              {field: 'id', width: 80, title: 'ID', sort: true}
              , {field: 'account', width: 80, title: '用户名'}
              , {field: 'email', width: 80, title: '性别', sort: true}
              , {field: 'status', width: 80, title: '城市'}
              , {field: 'loginTime', title: '签名', minWidth: 150}
              , {field: 'loginIp', width: 80, title: '积分', sort: true}
          ]]
          , page: true
      });
  });
  </script>
@endsection


