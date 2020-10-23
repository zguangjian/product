<ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
    @foreach(menu() as $value)
        @if(empty($value['children']))
            <li data-name="{{$value['id']}}" class="layui-nav-item">
              <a href="javascript:;" lay-href="{{$value['url']}}" lay-tips="{{$value['name']}}" lay-direction="2">
                <i class="layui-icon {{$value['icons']}}"></i>
                <cite>{{$value['name']}}</cite>
              </a>
            </li>
        @else
            <li data-name="{{$value['id']}}" class="layui-nav-item">
              <a href="javascript:" lay-tips="{{$value['name']}}" lay-direction="2">
                <i class="layui-icon {{$value['icons']}}"></i>
                <cite>{{$value['name']}}</cite>
              </a>
                <dl class="layui-nav-child">
                     @foreach($value['children'] as $v)
                        @if(empty($v['children']))
                            <dd data-name="{{$v['id']}}">
                                <a lay-href="{{$v['url']}}">{{$v['name']}}</a>
                            </dd>
                        @else
                            <dd data-name="{{$v['id']}}">
                                <a href="javascript:">{{$v['name']}}</a>
                                <dl class="layui-nav-child">
                                    @foreach($v['children'] as $item)
                                        <dd data-name="{{$item['id']}}"><a lay-href="{{$item['url']}}">{{$item['name']}}</a></dd>
                                    @endforeach
                                </dl>
                            </dd>
                        @endif
                    @endforeach
                </dl>
            </li>
        @endif
    @endforeach
</ul>

