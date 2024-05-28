@if ($paginator->hasPages())
<center>
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="hidden sm:block">
            <p class="text-sm leading-5 text-gray-700">
                {{__('Showing')}}
                <!-- <span class="font-medium">{{ $paginator->firstItem() }}</span> -->
                {{__('to')}}
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                {{__('of')}}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {{__('Results')}}
            </p>
        </div>
        <div class="flex-1 flex justify-between sm:justify-end">
            <span class="relative z-0 inline-flex shadow-sm">
                @if ($paginator->onFirstPage())
                <button type="button" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-300 transition ease-in-out duration-150 cursor-not-allowed" disabled>
                    <svg class="h-5 w-5" width="30" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                @else
                <button type="button" wire:click="previousPage" rel="prev" aria-label="@lang('pagination.previous')" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:outline-none active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                    <svg class="h-5 w-5" width="30" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>

                </button>
                @endif

                @if ($paginator->hasMorePages())
                <button type="button" wire:click="nextPage" rel="next" aria-label="@lang('pagination.next')" class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                    <svg class="h-5 w-5" width="30" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                @else
                <button type="button" class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-200 transition ease-in-out duration-150 cursor-not-allowed" disabled>
                    <svg class="h-5 w-5" width="30" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                @endif
            </span>
        </div>
    </div>
</center>
@endif