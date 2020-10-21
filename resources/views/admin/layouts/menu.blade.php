<ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
    @foreach(menu() as $value)
        <li data-name="component" class="layui-nav-item">
              <a href="javascript:" lay-tips="{{$value['name']}}" lay-direction="2">
                <i class="layui-icon layui-icon-component"></i>
                <cite>{{$value['name']}}</cite>
              </a>
            @foreach($value['children'] as $v)
                @if(empty($v['children']))
                    <dd data-name="button">
                        <a lay-href="{{$v['url']}}">{{$v['name']}}</a>
                    </dd>
                @else
                    <dl class="layui-nav-child">
                        <dd data-name="grid">
                            <a href="javascript:">{{$v['name']}}</a>
                                <dl class="layui-nav-child">
                                  @foreach($v['children'] as $item)
                                        <dd data-name="list"><a lay-href="{{$item['url']}}">{{$item['name']}}</a></dd>
                                    @endforeach
                                </dl>
                        </dd>
                    </dl>
                @endif
            @endforeach
        </li>
    @endforeach
    <li data-name="get" class="layui-nav-item">
              <a href="javascript:;" lay-href="{{url()->route('menu-index')}}" lay-tips="授权" lay-direction="2">
                <i class="layui-icon layui-icon-auz"></i>
                <cite>授权</cite>
              </a>
            </li>
</ul>
