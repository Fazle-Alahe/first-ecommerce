@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination pagination-rounded">
        @if ($paginator->onFirstPage())
            <li class="page-item"><a href="#" class="page-link"><i data-feather="chevron-left"></i></a></li>
        @else
            <li class="page-item"><a href="{{$paginator->previousPageUrl()}}" class="page-link"><i data-feather="chevron-left"></i></a></li>
        @endif

        @foreach ($products as $product)
            @if (is_string($product))
                <li class="page-item disabled">{{$product}}</li>
            @endif
            @if (is_array($product))
                @foreach ($product as $page=>$url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a href="#" class="page-link">{{$page}}</a></li>
                    @else
                        <li class="page-item"><a href="{{$url}}" class="page-link">{{$page}}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="page-item"><a href="{{$paginator->nextPageUrl()}}" class="page-link"><i data-feather="chevron-right"></i></a></li>
        @else
            <li class="page-item"><a href="#" class="page-link"><i data-feather="chevron-right"></i></a></li>
        @endif
    </ul>
</nav>
@endif