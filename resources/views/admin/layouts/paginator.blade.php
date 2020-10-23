@if ($paginator->hasPages())
    <div class="layui-card-body">
        <div id="test-laypage-demo0">
            <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-1">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <a class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        首页
                    </a>
                @else
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       aria-label="@lang('pagination.previous')"> 上一页</a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <a class="page-item disabled" aria-disabled="true">{{ $element }}</a>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="layui-laypage-curr">
                                <em class="layui-laypage-em"></em>
                                 <em>{{ $page }}</em>
                                 </span>
                            @else
                                <a class="" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a class="layui-laypage-next" href="{{ $paginator->nextPageUrl() }}" rel="next"
                       aria-label="@lang('pagination.next')">下一页</a>
                @else
                    <a class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        尾页
                    </a>
                @endif
            </div>
        </div>
    </div>
@endif
