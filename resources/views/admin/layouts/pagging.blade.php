<div class="pagination-container justify-content-center">
    <ul class="pagination pagination-success">
@if ($products->hasPages())
    <!-- Pagination -->
            {{-- Previous Page Link --}}
            @if ($products->onFirstPage())
                <li class="disabled">
                    <!-- <span><i class="fa fa-angle-double-left"></i></span> -->
                    <span aria-hidden="true"><span class="material-icons">
                            arrow_back
                        </span></span>
                </li>
            @else
                <!-- <li>
                    <a href="{{ $products->previousPageUrl() }}">
                        <span><i class="fa fa-angle-double-left"></i></span>
                    </a>
                </li> -->
                
                <li class="page-item">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true"><span class="material-icons">
                            arrow_back
                        </span></span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $products->currentPage())
                            <!-- <li class="active"><span>{{ $page }}</span></li> -->
                            <li class="page-item active">
                                <a class="page-link" href="javascript:;">{{ $page }}</a>
                            </li>
                        @elseif (($page == $products->currentPage() + 1 || $page == $products->currentPage() + 2) || $page == $products->lastPage())
                            <!-- <li><a href="{{ $url }}">{{ $page }}</a></li> -->
                            <li class="page-item active">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @elseif ($page == $products->lastPage() - 1)
                            <li class="disabled"><span><i class="fa fa-ellipsis-h"></i></span></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($products->hasMorePages())
                <!-- <li>
                    <a href="{{ $products->nextPageUrl() }}">
                        <span><i class="fa fa-angle-double-right"></i></span>
                    </a>
                </li> -->
                <li class="page-item disabled">
                    <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true"><span class="material-icons">
                            arrow_forward
                        </span></span>
                    </a>
                </li>
            @else
                <!-- <li class="disabled">
                    <span><i class="fa fa-angle-double-right"></i></span>
                </li> -->

                <li class="page-item disabled">
                    <a class="page-link" href="javascript:;" aria-label="Next">
                        <span aria-hidden="true"><span class="material-icons">
                            arrow_forward
                        </span></span>
                    </a>
                </li>
            @endif
    <!-- Pagination -->
@endif
    </ul>
</div>