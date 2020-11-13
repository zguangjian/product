@extends('admin.layouts.app')

@section('css_ext')
    <style>
        .cate-box {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f0f0f0;
            overflow: hidden;
        }

        .cate-box dt {
            margin-bottom: 10px;
            overflow: hidden;
        }

        .cate-box dt .cate-first {
            padding: 10px 20px;
            height: max-content;
        }

        .cate-box dd {
            padding: 0 50px;
            overflow: hidden;
        }

        .cate-box dd .cate-second {
            margin-bottom: 10px;
            height: max-content;
        }

        .cate-box dd .cate-third {
            padding: 0 40px;
            margin-bottom: 10px;
            overflow: hidden;
            display: block;
            width: 100%;
            height: max-content;
        }

        .cate-box dd .cate-four {
            padding: 0 60px;
            margin-bottom: 10px;
            float: left;
            overflow: hidden;
            height: max-content;
        }

        span {
            width: 85px;
        }


    </style>
@endsection

@section('content')
    <div class="layui-fluid">

    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <h2>角色 【{{$role->name}}】分配权限</h2>
        </div>
        <div class="layui-card-body">
           <form class="layui-form" action="">
               @foreach(menu() as $value)
                   <dl class="cate-box">
                        <dt>
                            <div class="cate-first">
                                <input id="menu{{$value['id']}}" type="checkbox" name="rule[]" value="{{$value['id']}}" title="{{$value['name']}}" lay-skin="primary" {{rule($value['id'],$roleRule,$role->id)}}>
                                <div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary">
                                    <span>{{$value['name']}}</span><i class="layui-icon layui-icon-ok"></i>
                                </div>
                            </div>
                        </dt>
                       @foreach($value['children'] as $v)
                           <dd>
                                <div class="cate-second">
                                    <input id="menu{{$value['id']}}-{{$v['id']}}" type="checkbox" name="rule[]" value="{{$v['id']}}" title="{{$v['name']}}" lay-skin="primary" {{rule($v['id'],$roleRule,$role->id)}}>
                                    <div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary">
                                        <span>{{$v['name']}}</span><i class="layui-icon layui-icon-ok"></i>
                                    </div>
                                </div>
                               @foreach($v['children'] as $item)
                                   <div class="cate-third">
                                        <input type="checkbox" id="menu{{$value['id']}}-{{$v['id']}}-{{$item['id']}}" name="rule[]" value="{{$item['id']}}" title="{{$item['name']}}" lay-skin="primary" {{rule($item['id'],$roleRule,$role->id)}}>
                                        <div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary">
                                            <span>{{$item['name']}}</span><i class="layui-icon layui-icon-ok"></i>
                                        </div>
                                    </div>
                                   @foreach($item['children'] as $child)
                                       <div class="cate-four">
                                                <input type="checkbox" id="menu{{$value['id']}}-{{$v['id']}}-{{$item['id']}}-{{$child['id']}}" name="rule[]" value="{{$child['id']}}" title="{{$child['name']}}" lay-skin="primary" {{rule($child['id'],$roleRule,$role->id)}}>
                                                <div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin="primary">
                                                    <span>{{$child['name']}}</span><i class="layui-icon layui-icon-ok"></i>
                                                </div>
                                        </div>
                                   @endforeach
                               @endforeach
                            </dd>
                       @endforeach
                    </dl>
               @endforeach
               <div class="layui-form-item layui-layout-admin">
                        <div class="layui-input-block">
                            <div class="layui-footer" style="left: 0;">
                                <button class="layui-btn" lay-submit lay-filter="component-form-element">提交
                                </button>
                                <button type="button" class="layui-btn layui-btn-primary" onclick="close_panel();return false;">取消
                                </button>
                            </div>
                        </div>
                    </div>
        </form>
        </div>
    </div>
    </div>
@endsection

@section('js_ext')
    <script type="text/javascript">
          layui.config({
              base: "{{url('layuiadmin')}}/" //静态资源所在路径
          }).extend({
              index: 'lib/index' //主入口模块
          }).use(['index', 'layer', 'table', 'form'], function () {
              let $ = layui.$;
              let form = layui.form;

              form.on('checkbox', function (data) {
                  var check = data.elem.checked;//是否选中
                  var checkId = data.elem.id;//当前操作的选项框
                  if (check) {
                      //选中
                      var ids = checkId.split("-");
                      if (ids.length == 4) {
                          //第四极菜单
                          //第四极菜单选中,则他的上级选中
                          $(this).prop("checked", true);
                          //$("#" + (ids[0])).prop("checked", true);
                      } else if (ids.length == 3) {
                          //第三极菜单
                          //第三极菜单选中,则他的上级选中
                          console.log("input[id*=" + ids[0] + '-' + ids[1] + '-' + ids[2] + "]")
                          //$("#" + (ids[0] + '-' + ids[1])).prop("checked", true);
                          $("input[id*=" + ids[0] + '-' + ids[1] + '-' + ids[2] + "]").each(function (i, ele) {
                              $(ele).prop("checked", true);
                          });
                      } else if (ids.length == 2) {
                          //第二季菜单
                          //$("#" + (ids[0])).prop("checked", true);
                          $("input[id*=" + ids[0] + '-' + ids[1] + "]").each(function (i, ele) {
                              $(ele).prop("checked", true);
                          });
                      } else {
                          //第一季菜单不需要做处理
                          $("input[id*=" + ids[0] + "-]").each(function (i, ele) {
                              $(ele).prop("checked", true);
                          });
                      }
                  } else {
                      //取消选中
                      var ids = checkId.split("-");
                      console.log(ids);
                      if (ids.length == 3) {
                          $("input[id*=" + ids[0] + '-' + ids[1] + '-' + ids[2] + "]").each(function (i, ele) {
                              $(ele).prop("checked", false);
                          });
                      } else if (ids.length == 2) {
                          //第二极菜单
                          $("input[id*=" + ids[0] + '-' + ids[1] + "]").each(function (i, ele) {
                              $(ele).prop("checked", false);
                          });
                      } else if (ids.length == 1) {
                          $("input[id*=" + ids[0] + "-]").each(function (i, ele) {
                              $(ele).prop("checked", false);
                          });
                      }
                  }
                  form.render();
              });
              /* 监听提交 */
              form.on('submit(component-form-element)', function (data) {
                  $.ajax({
                      type: 'post',
                      data: data.field,
                      dataType: 'json',
                      success: function (data) {
                          if (data.code == 0) {
                              layer.msg(data.msg, {icon: 1, time: 2000}, function () {
                                  close_panel()
                                  return false;
                              })
                          } else {
                              layer.msg(data.msg, {icon: 2, time: 2000}, function () {
                                  layer.closeAll();
                              })
                          }
                      }
                  })
                  return false;
              });
          })
    </script>
@endsection
