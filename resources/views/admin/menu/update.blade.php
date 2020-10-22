@extends('admin.layouts.app')
@section('css_ext')
    <style>
        /*图标展示*/
        .site-doc-icon {
            width: 1050px;
            background-color: #fff
        }

        .site-doc-icon li {
            cursor: pointer;
            display: inline-block;
            vertical-align: middle;
            width: 127px;
            height: 105px;
            line-height: 25px;
            padding: 20px 0;
            margin-right: -1px;
            margin-bottom: -1px;
            border: 1px solid #e2e2e2;
            font-size: 14px;
            text-align: center;
            color: #666;
            transition: all .3s;
            -webkit-transition: all .3s;
        }

        .site-doc-anim li {
            height: auto;
        }

        .site-doc-icon li .layui-icon {
            display: inline-block;
            font-size: 36px;
        }

        .site-doc-icon li .doc-icon-name,
        .site-doc-icon li .doc-icon-code {
            color: #c2c2c2;
        }

        .site-doc-icon li .doc-icon-code xmp {
            margin: 0
        }

        .site-doc-icon li .doc-icon-fontclass {
            height: 40px;
            line-height: 20px;
            padding: 0 5px;
            font-size: 13px;
            color: #333;
        }

        .site-doc-icon li:hover {
            background-color: #f2f2f2;
            color: #000;
        }

    </style>
@endsection

@section('content')
    <div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-header">修改菜单</div>


      <div class="layui-card-body" style="padding: 15px;">
        <form class="layui-form" action="" lay-filter="component-form-group">
            <div class="layui-form-item">
                <label class="layui-form-label">父级菜单</label>
                <div class="layui-input-block">
                  <select name="parent_id" lay-filter="aihao">
                    <option value="0" {{$menu->parend_id == 0 ?'selected': '' }}>/</option>
                      @foreach(\App\Models\Menu::parentMenu() as $value)
                          <option value="{{$value['id']}}" {{$menu->parent_id == $value['id'] ? 'selected': '' }}>{{$value['name']}}</option>
                          @foreach($value['children'] as $v)
                              <option value="{{$v['id']}}" {{$menu->parent_id == $v['id'] ? 'selected': '' }}>{!!str_repeat('&nbsp;',$v['_level'] * 2)!!}{{$v['name']}}</option>
                          @endforeach
                      @endforeach
                  </select>
                </div>
          </div>
            <input type="hidden" name="id" value="{{$menu->id}}">
          <div class="layui-form-item">
            <label class="layui-form-label">菜单名称</label>
            <div class="layui-input-block">
              <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="菜单名称" class="layui-input" value="{{$menu->name}}">
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-inline">
              <label class="layui-form-label">路由地址</label>
              <div class="layui-input-inline">
                <select name="url" lay-verify="" lay-search="">
                  <option value="">直接选择或搜索选择</option>
                    @foreach(adminMenu() as $route)
                        <option value="{{$route['uri']}}"{{$route['uri'] == $menu->url ? 'selected':''}}>{{$route['uri']}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>

            <div class="layui-form-item">
                <label for="" class="layui-form-label">图标</label>
                <div class="layui-input-inline">
                    <input class="layui-input" type="hidden" name="icons" value="{{$menu->icons}}">
                </div>
                <div class="layui-form-mid layui-word-aux" id="icon_box">
                    <i class="layui-icon {{$menu->icons}}"></i>
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <button type="button" class="layui-btn layui-btn-xs" onclick="showIconsBox()">选择图标</button>
                </div>
            </div>
             <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-block">
                  <input type="text" name="sort" lay-verify="number" autocomplete="off" placeholder="排序" class="layui-input" value="{{$menu->sort}}">
                </div>
            </div>
          <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="显示" {{$menu->status == 1 ? 'checked':''}}>
                <input type="radio" name="status" value="0" title="隐藏" {{$menu->status == 0 ? 'checked':''}}>
            </div>
          </div>
            <input type="hidden" name="status" value="1">
          <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">描述</label>
            <div class="layui-input-block">
              <textarea name="content" placeholder="请输入内容" class="layui-textarea">{{$menu->content}}</textarea>
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
              layer.load();
              $.ajax({
                  type: 'post',
                  data: data.field,
                  dataType: 'json',
                  success: function (data) {
                      if (data.code == 1) {
                          layer.msg(data.msg, {icon: 1, time: 2000}, function () {
                              layer.closeAll();
                              window.location.href = data.data.url;
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
      });
  </script>
@endsection
