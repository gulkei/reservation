<nav aria-label="Page navigation">
  <ul class="pagination">

    {{-- 前のページへ --}}
    @unless ($paginator->onFirstPage())
    <li class="page-item">
      <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    @endunless

    {{-- ページリンク --}}
    @foreach ($elements as $element)

      {{-- ページが1のみの場合 --}}
      @if (is_string($element))
      <li class="page-item"><span class="page-link">{{ $element }}</span></li>
      @endif

      {{-- ページが複数ある場合 --}}
      @if (is_array($element))

        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
          <li class="page-item"><span class="page-link">{{ $page }}</span></li>

          @else
          <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach

      @endif
    @endforeach

    {{-- 次のページへ --}}
    @if ($paginator->hasMorePages())
    <li class="page-item">
      <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
    @endif
  </ul>
</nav>
