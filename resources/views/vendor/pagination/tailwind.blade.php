<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center mt-8">
    <div class="inline-flex items-center space-x-2">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 rounded-full bg-gray-100 text-gray-400 border border-gray-200 cursor-not-allowed">
                <i class="fa-solid fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
               class="px-4 py-2 rounded-full border border-[#34307A] text-[#34307A] bg-white hover:bg-[#34307A] hover:text-white transition duration-200">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-4 py-2 rounded-full bg-white border border-gray-200 text-gray-400 cursor-default">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page"
                              class="px-4 py-2 rounded-full bg-[#34307A] text-white border border-[#34307A] shadow-md cursor-default">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="px-4 py-2 rounded-full border border-[#34307A] text-[#34307A] bg-white hover:bg-[#34307A] hover:text-white transition duration-200">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
               class="px-4 py-2 rounded-full border border-[#34307A] text-[#34307A] bg-white hover:bg-[#34307A] hover:text-white transition duration-200">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        @else
            <span class="px-4 py-2 rounded-full bg-gray-100 text-gray-400 border border-gray-200 cursor-not-allowed">
                <i class="fa-solid fa-chevron-right"></i>
            </span>
        @endif

    </div>
</nav>