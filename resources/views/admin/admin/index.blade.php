@extends("admin.layouts.app")

@section("content")
    <div class="layui-fluid">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body">
                    <div class="layui-form-item">

                        <button class="layui-btn layui-btn-sm create" data-url="{{url('admin/role/create')}}">添加角色
                        </button>

                    </div>

                    <table class="layui-table ">
                        <thead>
                        <th width="30"></th>
                        <th>帐号</th>
                        <th>邮箱</th>
                        <th>状态</th>
                        <th>上次登录ip</th>
                        <th>上次登录时间</th>
                        <th>操作</th>

                        </thead>
                        <tbody>
                        @foreach($list as $key=>$value)
                            <tr>
                                <td>{{$value->id}}</td>
                                <td>{{$value->account}}</td>
                                <td>{{$value->email}}</td>
                                <td>{{$value->status}}</td>
                                <td>{{$value->loginIp}}</td>
                                <td>{{$value->loginTime}}</td>
                                <td>
                                    <button class="layui-btn layui-btn-sm layui-btn-{{$value->id == 1? 'disabled':'warm'}}  edit"
                                            data-url="{{url('admin/role/rule',['id'=>$value->id])}}">权限
                                    </button>
                                    <button class="layui-btn layui-btn-sm layui-btn-{{$value->id == 1? 'disabled':'normal'}} edit"
                                            data-url="{{url('admin/role/update',['id'=>$value->id])}}">编辑
                                    </button>

                                    <button class="layui-btn layui-btn-sm layui-btn-{{$value->id == 1? 'disabled':'danger'}} delete"
                                            data-url="{{url('admin/role/destroy',['id'=>$value->id])}}" id="delete">
                                        删除
                                    </button>
                                </td>
                            </tr>

                        @endforeach
                        @include("admin.layouts.paginator")
                </tbody>
                </table>
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
         }).use(['element', 'layer', 'laypage'], function () {
             var element = layui.element;
             var layer = layui.layer;
             var laypage = layui.laypage;
             $ = layui.jquery;

             var count = "{{$total}}";
             var cur_page = "{{$current_page}}";
             var limit = "{{$perPage}}";
             var txt = "{{$txt}}";
             laypage.render({
                 elem: 'userPage'
                 , curr: cur_page
                 , count: count
                 , limit: limit
                 , txt: txt
                 , layout: ['count', 'prev', 'page', 'next', 'limit', 'refresh', 'skip']
                 , jump: function (obj, first) {
                     // console.log(obj)
                     //url =window.location.href;
                     url = window.location.pathname;//当前页url不带参
                     var params = {page: obj.curr, per_num: obj.limit};
                     if (!empty(txt)) {
                         params['searchq'] = txt; //这个是搜索 参数
                     }
                     url = http_build_query(url, params);
                     if (!first) {  //跳转必须放在这个里边，不然无限刷新
                         window.location.href = url; //跳转
                     }
                 }
             });

         });
</script>
@endsection


