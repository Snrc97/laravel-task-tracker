<aside class="w-64 bg-white dark:bg-[#1A1A1A] border-r border-[#E5E5EA] dark:border-[#3E3E3A] h-screen px-4 py-6">
    <ul class="space-y-2">
        @foreach ($sidebarItems as $item)
            @if (isset($item['children']))
                <li class="relative">
                    <button
                        class="flex items-center justify-between w-full px-2 py-2 font-semibold text-left text-gray-600 dark:text-[#EDEDEC] focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                        type="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        {{ $item['title'] }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul
                        class="absolute top-0 left-0 w-full bg-white dark:bg-[#1A1A1A] border-t border-b border-[#E5E5EA] dark:border-[#3E3E3A] transform -translate-y-full transition duration-300 ease-in-out"
                        aria-label="{{ $item['title'] }}"
                        role="menu"
                    >
                        @foreach ($item['children'] as $child)
                            <li class="px-2 py-2">
                                <a
                                    href="{{ $child['href'] }}"
                                    class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 dark:text-[#EDEDEC] hover:bg-gray-100 dark:hover:bg-[#2B2B2B] focus:outline-none focus:bg-gray-100 dark:focus:bg-[#2B2B2B]"
                                    role="menuitem"
                                >
                                    {{ $child['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="px-2 py-2">
                    <a
                        href="{{ $item['href'] }}"
                        class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 dark:text-[#EDEDEC] hover:bg-gray-100 dark:hover:bg-[#2B2B2B] focus:outline-none focus:bg-gray-100 dark:focus:bg-[#2B2B2B]"
                    >
                        {{ $item['title'] }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</aside>
