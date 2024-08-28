@if ($paginator->hasPages())
<nav>
     <ul class="pagination">
          {{-- Previous Page Link --}}
          @if ($paginator->onFirstPage())

          <li class="page-item"><a class="page-link" href="#">Previous</a></li>

          @else
          <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link"
                    style="text-decoration: none;" rel="prev">Previous</a>
          </li>
          @endif

          {{-- Pagination Elements --}}
          @foreach ($elements as $element)
          {{-- "Three Dots" Separator --}}
          @if (is_string($element))
          <li class="disabled" class="page-item"><span class="page-link" href="#">{{ $element }}</span></li>
          @endif

          {{-- Array Of Links --}}
          @if (is_array($element))
          @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
          <li class="active" class="page-item"><span class="page-link">&nbsp;{{ $page }}</span></li>
          @else
          <li class="page-item"><a href="{{ $url }}" style="text-decoration: none;" class="page-link">&nbsp;
                    {{ $page }}</a></li>
          @endif
          @endforeach
          @endif
          @endforeach

          {{-- Next Page Link --}}
          @if ($paginator->hasMorePages())
          <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" rel="next" style="text-decoration: none;"
                    class="page-link">&nbsp;Next</a>
          </li>
          @else
          <li class="page-item"><a class="page-link" href="#">Next</a></li>
          @endif
     </ul>
</nav>
@endif