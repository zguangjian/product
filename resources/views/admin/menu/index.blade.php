@extends('admin.layouts.app')
@section('content')
    <div class="demo-side">
            <table id="demoTreeTb"></table>
        </div>
@endsection

@section('js_ext')
    <!-- 表格操作列 -->
    <script type="text/html" id="tbBar">
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">修改</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>
    <script>
          layui.config({
              base: "{{url('layuiadmin')}}/" //静态资源所在路径
          }).use(['treeTable'], function () {
              var $ = layui.jquery;
              var treeTable = layui.treeTable;

              // 渲染树形表格
              var insTb = treeTable.render({
                  elem: '#demoTreeTb',
                  url: "{{url()->current()}}",
                  toolbar: 'default',
                  tree: {
                      iconIndex: 2,
                      isPidData: true,
                      idName: 'id',
                      pidName: 'parent_id',
                      arrowType: 'arrow2',
                      getIcon: 'ew-tree-icon-style2'
                  },
                  cols: [[
                      {type: 'numbers'},
                      {type: 'checkbox'},
                      {field: 'name', title: '菜单名称', minWidth: 165},
                      {field: 'url', title: '菜单地址'},
                      {field: 'status', title: '状态'},
                      {title: '类型', templet: '<p>菜单</p>', align: 'center', width: 60},
                      {field: 'created_at', title: '创建时间'},
                      {align: 'center', toolbar: '#tbBar', title: '操作', width: 120}
                  ]],
                  style: 'margin-top:0;'
              });
              // 头部工具栏点击事件
              treeTable.on('toolbar(demoTreeTb)', function (obj) {
                  switch (obj.event) {
                      case 'add':
                          location.href = "{{url()->route('menu-create')}}";
                          break;
                      case 'delete':
                          let ids = new Array();
                          JSON.stringify(insTb.checkStatus().map(function (d) {
                              ids.push(d.id)
                          }), null, 3)

                          console.log(ids);
                          break;
                      case 'update':
                          layer.msg('编辑');
                          break;
                      case 'LAYTABLE_TIPS':
                          layer.msg('提示');
                          break;
                  }
              });
          });
   </script>
@endsection
