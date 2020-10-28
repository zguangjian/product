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
          }).use(['treeTable', 'util'], function () {
              var $ = layui.jquery,
                  util = layui.util,
                  treeTable = layui.treeTable;


              // 渲染树形表格
              var insTb = treeTable.render({
                  elem: '#demoTreeTb',
                  url: "{{url()->current()}}",
                  toolbar: 'default',
                  open: true,  // 默认展开
                  tree: {
                      iconIndex: 2,
                      isPidData: true,
                      idName: 'id',
                      pidName: 'parent_id',
                      //arrowType: 'arrow2',
                      //getIcon: 'ew-tree-icon-style2'
                  },
                  cols: [
                      [
                          {type: 'numbers'},
                          {type: 'checkbox'},
                          {field: 'name', title: '菜单名称', minWidth: 165},
                          {field: 'url', title: '菜单地址'},
                          {
                              title: '状态', templet: function (d) {
                                  return d.status == 0 ? '隐藏' : '显示';
                              }
                          },
                          {
                              title: '创建时间', templet: function (d) {
                                  return util.toDateString(d.created_at * 1000);
                              }
                          },
                          {align: 'center', toolbar: '#tbBar', title: '操作', width: 120}
                      ]
                  ],
                  style: 'margin-top:0;'
              });

              // 工具列点击事件
              treeTable.on('tool(demoTreeTb)', function (obj) {
                  var event = obj.event;
                  if (event === 'del') {
                      layer.confirm('是否要删除信息!', {
                          btn: ['确定', '取消']
                      }, function () {
                          layer.load();
                          $.ajax({
                              type: 'get',
                              url: "{{route('menu-destroy')}}",
                              data: {id: obj.data.id},
                              success: function (data) {
                                  layer.msg(data.msg, {icon: 1, time: 2000}, function () {
                                      insTb.refresh()
                                  });
                              }
                          })
                          layer.closeAll();  //关闭消息框

                      })

                  } else if (event === 'edit') {
                      var index = layer.open({
                          type: 2,
                          title: false,
                          closeBtn: 0,
                          shadeClose: true,
                          content: "{{route('menu-update')}}/" + obj.data.id,
                          area: ['300px', '300px'],
                          maxmin: true
                      });
                      layer.full(index);
                  }
              });
              // 头部工具栏点击事件
              treeTable.on('toolbar(demoTreeTb)', function (obj) {
                  switch (obj.event) {
                      case 'add':
                          var index = layer.open({
                              type: 2,
                              title: false,
                              closeBtn: 0,
                              shadeClose: true,
                              content: "{{url()->route('menu-create')}}",
                              area: ['300px', '300px'],
                              maxmin: true
                          });
                          layer.full(index);
                          break;
                      case 'delete':
                          let ids = new Array();
                          JSON.stringify(insTb.checkStatus().map(function (d) {
                              ids.push(d.id)
                          }), null, 3)
                          layer.confirm('是否要删除信息!', {
                              btn: ['确定', '取消']
                          }, function () {
                              layer.load();
                              $.ajax({
                                  type: 'get',
                                  url: "{{route('menu-destroy')}}",
                                  data: {id: ids},
                                  success: function (data) {
                                      layer.msg(data.msg, {icon: 1, time: 2000}, function () {
                                          insTb.refresh()
                                      });
                                  }
                              })
                              layer.closeAll();  //关闭消息框

                          })

                          break;
                      case 'update':

                          break;

                      case 'LAYTABLE_TIPS':

                          break;
                  }
              });
          });
   </script>
@endsection
