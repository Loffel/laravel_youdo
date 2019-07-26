@if ($paginator->hasPages())
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12">
        <div class="pagination-container margin-top-30 margin-bottom-60">
            <nav class="pagination">
                <ul>
                    @if ($paginator->onFirstPage())
                        <li class="pagination-arrow"><a class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-left" disabled></i></a></li>
                    @else
                        <li class="pagination-arrow"><a href="{{ $paginator->previousPageUrl() }}" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
                    @endif
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li><a class="current-page ripple-effect">{{ $element }}</a></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li><a href="#" class="current-page ripple-effect">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ $url }}" class="ripple-effect">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if ($paginator->hasMorePages())
                        <li class="pagination-arrow"><a href="{{ $paginator->nextPageUrl() }}" rel="next" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                    @else
                        <li class="pagination-arrow"><a rel="next" class="ripple-effect" disabled><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
@endif