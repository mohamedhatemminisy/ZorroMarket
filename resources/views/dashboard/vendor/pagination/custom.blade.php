@if ($paginator->hasPages())
    <nav>
        <ul class="pagination pagination-lg justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled " aria-disabled="true" aria-label="@lang('pagination.previous')" >
                    <a  aria-hidden="true" class="page-link">&lsaquo;  @lang('pagination.previous_')</a>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="page-link">&lsaquo;@lang('pagination.previous_') </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled page-item" aria-disabled="true">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active page-item" aria-current="page" >
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item"">
                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}"  class="page-link" >&lsaquo;@lang('pagination.next_')</a>
                </li>
            @else
                <li class="page-item disabled " aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a aria-hidden="true" class="page-link">@lang('pagination.next_') &rsaquo; </a>
                </li>
            @endif
        </ul>
    </nav>
@endif




{{-- ***************************************** --}}
