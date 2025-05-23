<div class="pagination">
    <div class="pagination-container">
        <!-- Previous page -->
        @if ($paginator->onFirstPage())
            <button disabled class="pagination-button">
                «
            </button>
        @else
            <button wire:click="previousPage" onclick="scrollToTop()" class="pagination-button">
                «
            </button>
        @endif

        <!-- numbers of pages -->
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-page active">
                            {{ $page }}
                        </span>
                    @else
                        <button wire:click="gotoPage({{ $page }})" onclick="scrollToTop()" class="pagination-page">
                            {{ $page }}
                        </button>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next page -->
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" onclick="scrollToTop()" class="pagination-button">
                »
            </button>
        @else
            <button disabled class="pagination-button">
                »
            </button>
        @endif
    </div>

    <!-- Information about articles -->
    <div class="pagination-info">
        <b>Prikazano {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} od {{ $paginator->total() }} proizvoda</b>
    </div>
</div>

<script>
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>
