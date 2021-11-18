<x-app-layout>
    <div class="pt-12">
        <div class="px-4 mt-5 xl:flex 2xl:px-16">
            <div class="p-12 bg-white border-r-4 xl:p-0 xl:w-2/12 border-gray-50 ">
                <h3 class="p-2 pt-6 text-xl text-gray-900"><span class="xl:ml-10">カテゴリ</span></h3>
                <ul>
                    @foreach ($categories as $category)
                        <li class="inline xl:block">
                            <a class="items-center inline-block px-3 py-1 mt-3 ml-4 text-base text-white transition duration-500 ease-in-out transform bg-gray-400 rounded-lg xl:ml-0 xl:px-4 xl:py-2 xl:text-gray-900 xl:w-full xl:inline-flex focus:shadow-outline hover:bg-gray-700 xl:hover:bg-gray-50 xl:bg-white"
                                href="#">
                                <span class="xl:border-b-2 xl:border-gray-100 xl:ml-10">{{ $category->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <h3 class="p-2 pt-6 text-xl text-gray-900"><span class="xl:ml-10">人気タグ</span></h3>
                <ul>
                    @foreach ($tags as $tag)
                        <li class="inline text-base text-gray-900 xl:block">
                            <a class="items-center inline-block px-3 py-1 mt-3 ml-4 text-base text-white transition duration-500 ease-in-out transform bg-green-500 rounded-lg xl:ml-0 opacity-80 xl:px-4 xl:py-2 xl:text-gray-900 xl:w-full xl:inline-flex focus:shadow-outline hover:bg-green-700 xl:hover:bg-gray-50 xl:bg-white"
                                href="#">
                                <span class="xl:ml-10 xl:border-b-2 xl:border-gray-100"># {{ $tag->name }}()</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="p-6 pb-0 bg-white border-b border-gray-200 xl:w-11/12">
                <div class="flex-wrap md:flex">
                    @foreach ($servers as $server)
                        <div class="flex flex-col items-start p-12 border-2 lg:w-1/2">
                            {{-- Todo N+1問題 --}}
                            <span
                                class="inline-block px-2 py-1 text-xs font-medium tracking-widest text-indigo-500 rounded bg-indigo-50">{{ $server->category->name }}</span>
                            <p class="mt-4 leading-relaxed">作成者: {{ $server->user->name }}</p>
                            <h2 class="mt-4 mb-4 text-2xl font-medium text-gray-900 sm:text-3xl title-font">
                                {{ $server->name }}</h2>
                            <p class="mb-8 leading-relaxed">
                                {{ $server->description }}
                            </p>
                            <div
                                class="flex flex-wrap items-center w-full pb-4 mt-auto mb-4 border-b-2 border-gray-100">
                                <a class="inline-flex items-center text-indigo-500">Learn More
                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                <span
                                    class="inline-flex items-center py-1 pr-3 ml-auto mr-3 text-sm leading-none text-gray-400 border-r-2 border-gray-200">
                                    <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>1.2K
                                </span>
                                <span class="inline-flex items-center text-sm leading-none text-gray-400">
                                    <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path
                                            d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z">
                                        </path>
                                    </svg>6
                                </span>
                            </div>
                            <a class="inline-flex items-center">
                                <img alt="blog" src="https://dummyimage.com/104x104"
                                    class="flex-shrink-0 object-cover object-center w-12 h-12 rounded-full">
                                <span class="flex flex-col flex-grow pl-4">
                                    <span class="font-medium text-gray-900 title-font">Holden Caulfield</span>
                                    <span class="text-gray-400 text-xs tracking-widest mt-0.5">UI DEVELOPER</span>
                                </span>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
</x-app-layout>
