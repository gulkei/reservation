<div class="pagination">

  {{-- 前のページへ --}}
  @unless ($paginator->onFirstPage())
  <a href="{{ $paginator->previousPageUrl() }}" class="pagination__arrow pagination__arrow--previous"></a>
  @endunless

  {{-- ページリンク --}}
  @foreach ($elements as $element)

    {{-- ページが1のみの場合 --}}
    @if (is_string($element))
    <span>{{ $element }}</span>
    @endif

    {{-- ページが複数ある場合 --}}
    @if (is_array($element))

      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <span>{{ $page }}</span>
        @else
        <a href="{{ $url }}" class="pagination__num">{{ $page }}</a>
        @endif
      @endforeach

    @endif

  @endforeach

  {{-- 次のページへ --}}
  @if ($paginator->hasMorePages())
  <a href="{{ $paginator->nextPageUrl() }}" class="pagination__arrow pagination__arrow--next"></a>
  @endif
</div>
