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
                  height: 'full-200',
                  open: true,  // 默认展开
                  tree: {
                      iconIndex: 2,
                      isPidData: true,
                      idName: 'id',
                      pidName: 'parent_id',
                      // arrowType: 'arrow2',
                      // getIcon: 'ew-tree-icon-style2'
                  },
                  cols: [
                      [
                          {title: '只是想演示一个三级表头', colspan: 9},
                      ],
                      [
                          {title: '只是想演示一个多级表头', colspan: 4},
                          {field: 'menuUrl', title: '菜单地址', rowspan: 2},
                          {title: '这是一个二级表头', colspan: 4}
                      ],
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
                                  console.log(d.created_at)
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
                                      obj.del();
                                  });
                              }
                          })
                          layer.closeAll();  //关闭消息框

                      })

                  } else if (event === 'edit') {
                      window.location.href = "{{route('menu-update')}}/" + obj.data.id;
                  }
              });
              // 头部工具栏点击事件
              treeTable.on('toolbar(demoTreeTb)', function (obj) {
                  switch (obj.event) {
                      case 'add':
                          location.href = "{{url()->route('menu-create')}}";
                          break;
                      case 'delete':
                          let ids = new Array();
                          layer.alert('<pre>' + JSON.stringify(insTb.checkStatus().map(function (d) {
                              return {
                                  authorityName: d.name,
                                  authorityId: d.id,
                                  LAY_INDETERMINATE: d.LAY_INDETERMINATE
                              };
                          }), null, 3) + '</pre>');
                          JSON.stringify(insTb.checkStatus().map(function (d) {
                              ids.push(d.id)
                          }), null, 3)
                          console.log(ids);
                          return false;
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
