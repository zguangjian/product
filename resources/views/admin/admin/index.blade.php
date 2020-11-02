@extends("admin.layouts.app")

@section("content")
    <div class="layui-card layadmin-header">

  </div>

    <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-body">
            <table class="layui-hide" id="test-table-toolbar" lay-filter="test-table-toolbar"></table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section("js_ext")
    <script type="text/html" id="test-table-toolbar-toolbarDemo">
    <div class="layui-btn-container">
                <button class="layui-btn layui-btn-danger layui-btn-sm" lay-event="create">添加</button>
                <button class="layui-btn layui-btn-sm" lay-event="getCheckData">批量删除</button>
              </div>
</script>
    <script type="text/html" id="test-table-toolbar-barDemo">
    <a class="layui-btn layui-btn-warm layui-btn-xs @{{d.id == 1 ? 'layui-btn-disabled':''}}" lay-event="password">修改密码</a>
    <a class="layui-btn layui-btn-xs @{{d.id == 1 ? 'layui-btn-disabled':''}}" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs @{{d.id == 1 ? 'layui-btn-disabled':''}}" lay-event="del">删除</a>
    </script>
    <script type="text/html" id="test-table-checkboxTpl">
     <input type="checkbox" name="status" title="启用" lay-filter="test-table-lockDemo"
            value="@{{d.id}}" data-json="@{{ encodeURIComponent(JSON.stringify(d)) }}" @{{d.status== 1 ? 'checked':''}}>
</script>
    <script>
  layui.config({
      base: "{{url('layuiadmin')}}/" //静态资源所在路径
  }).extend({
      index: 'lib/index' //主入口模块
  }).use(['index', 'table'], function () {
      var admin = layui.admin
          , form = layui.form
          , table = layui.table;

      table.render({
          elem: '#test-table-toolbar'
          , url: "{{url()->current()}}"
          , toolbar: '#test-table-toolbar-toolbarDemo'
          , cols: [[
              {type: 'checkbox', fixed: 'left'}
              , {field: 'account', title: '用户名', edit: 'text',}
              , {field: 'email', title: '邮箱', edit: 'text',}
              , {field: 'status', title: '状态', toolbar: '#test-table-checkboxTpl', unresize: true}
              , {field: 'loginTime', title: '登录时间', sort: true,}
              , {field: 'loginIp', title: '登录ip'}
              , {fixed: 'right', title: '操作', toolbar: '#test-table-toolbar-barDemo', width: 200}
          ]]
          , page: true
      });
      //头工具栏事件
      table.on('toolbar(test-table-toolbar)', function (obj) {
          var checkStatus = table.checkStatus(obj.config.id);

          switch (obj.event) {
              case 'getCheckData':
                  var data = checkStatus.data;
                  layer.alert(JSON.stringify(data));
                  break;
              case 'getCheckLength':
                  var data = checkStatus.data;
                  layer.msg('选中了：' + data.length + ' 个');
                  break;
              case 'isAll':
                  layer.msg(checkStatus.isAll ? '全选' : '未全选');
                  break;
              case 'create':
                  var index = layer.open({
                      type: 2,
                      title: false,
                      closeBtn: 0,
                      shadeClose: true,
                      content: "{{url()->route('admin-create')}}",
                      area: ['300px', '300px'],
                      maxmin: true
                  });
                  layer.full(index);
          }
          ;
      });

      //监听行工具事件
      table.on('tool(test-table-toolbar)', function (obj) {
          if (obj.data.id == 1) {
              return false;
          }
          var data = obj.data;
          if (obj.event === 'del') {
              layer.confirm('真的删除行么', function (index) {
                  obj.del();
                  layer.close(index);
              });
          } else if (obj.event === 'edit') {
              layer.prompt({
                  formType: 2
                  , value: data.email
              }, function (value, index) {
                  obj.update({
                      email: value
                  });
                  layer.close(index);
              });
          } else if (obj.event === "password") {
              layer.open({
                  title: "密码修改",
                  type: 1,
                  skin: 'layui-layer-rim',
                  area: ['420px', '240px'],
                  content: '<div style="padding: 10px;">任意html内容</div>'
              });
          }
      });
      table.on('edit(test-table-toolbar)', function (obj) {
          var value = obj.value //得到修改后的值
              , data = obj.data //得到所在行所有键值
              , field = obj.field; //得到字段
          layer.msg('[ID: ' + data.id + '] ' + field + ' 字段更改为：' + value, {
              offset: '15px'
          });

      });
      //监听锁定操作
      form.on('checkbox(test-table-lockDemo)', function (obj) {
          var json = JSON.parse(decodeURIComponent($(this).data('json')));
          layer.tips(this.value + ' ' + this.name + '：' + obj.elem.checked, obj.othis);

          json = table.clearCacheKey(json);
          let status = obj.elem.checked == true ? 1 : 0
          $.ajax({
              type: "post",
              data: {status:status},
              url:"{{url()->route('admin-edit')}}/1",
              success:function (data) {

              }
          })
          console.log(json); //当前行数据
      });
  });
  </script>
@endsection


