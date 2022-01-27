<x-app-layout>
    <div class="pt-12">
        <x-flash-message />
        <div class="px-4 mt-5 xl:flex 2xl:px-16">
            <div class="p-12 bg-white border-r-4 xl:p-0 xl:w-2/12 border-gray-50 ">
                <h3 class="p-2 pt-6 text-xl font-semibold text-gray-900"><span class="xl:ml-10">カテゴリ</span></h3>
                <ul>
                    @foreach ($categories as $category)
                        <li class="inline xl:block">
                            <a class="items-center inline-block px-3 py-1 mt-3 ml-4 text-base text-white transition duration-500 ease-in-out transform bg-gray-400 rounded-lg xl:ml-0 xl:px-4 xl:py-2 xl:text-gray-900 xl:w-full xl:inline-flex focus:shadow-outline hover:bg-gray-700 xl:hover:bg-gray-50 xl:bg-white"
                                href="?category={{ $category->id }}">
                                <span
                                    class="xl:border-b-2 xl:border-gray-100 xl:ml-10">{{ $category->name }}({{ $category->discord_servers_count }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <h3 class="p-2 pt-6 text-xl font-semibold text-gray-900"><span class="xl:ml-10">人気タグ</span></h3>
                <ul>
                    @foreach ($tags as $tag)
                        <li class="inline text-base text-gray-900 xl:block">
                            <a class="items-center inline-block px-3 py-1 mt-3 ml-4 text-base text-white transition duration-500 ease-in-out transform bg-green-500 rounded-lg xl:ml-0 opacity-80 xl:px-4 xl:py-2 xl:text-gray-900 xl:w-full xl:inline-flex focus:shadow-outline hover:bg-green-700 xl:hover:bg-gray-50 xl:bg-white"
                                href="?tag={{ $tag->id }}">
                                <span
                                    class="xl:ml-10 xl:border-b-2 xl:border-gray-100">#{{ $tag->name }}({{ $tag->discord_servers_count }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="p-6 bg-white border-b border-gray-200 xl:w-11/12">
                <form class="relative pt-2 mb-4 text-right text-gray-600">
                    <input
                        class="h-10 px-5 pr-16 text-sm bg-white border-2 border-gray-300 rounded-lg focus:outline-none"
                        type="search" name="search" placeholder="Search">
                    <button type="submit" class="absolute top-0 right-0 mt-5 mr-4">
                        <svg class="w-4 h-4 text-gray-600 fill-current" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                            xml:space="preserve" width="512px" height="512px">
                            <path
                                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </button>
                </form>
                <div class="my-4 text-right">
                    <a href="{{ route('discord-servers.create') }}"
                        class="inline-flex items-center px-4 py-2 font-bold text-white bg-indigo-500 rounded hover:bg-indigo-600 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="mt-1 font-semibold">サーバーを作成</span>
                    </a>
                </div>
                <div class="gap-6 space-y-2 md:grid md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($servers as $server)
                        <div
                            class="flex flex-col items-start w-full p-6 mt-2 border-2 shadow rounded-2xl md:p-8 xl:p-6 lg:p-8 ">
                            {{-- Todo N+1問題 --}}
                            <h2 class="mb-4 text-2xl font-bold text-gray-900 sm:text-3xl title-font">
                                {{ $server->name }}</h2>
                            <span
                                class="inline-block px-2 py-1 text-sm tracking-widest text-indigo-500 rounded bg-indigo-50"><a
                                    href="?category={{ $server->category_id }}">{{ $server->category->name }}</a></span>
                            <div class="my-1">
                                @foreach ($server->tags as $tag)
                                    <span
                                        class="inline-block px-2 py-1 text-sm tracking-widest text-green-500 rounded bg-green-50"><a
                                            href="?tag={{ $tag->id }}">#{{ $tag->name }}</a></span>
                                @endforeach
                            </div>
                            <h3 class="my-4 text-lg font-semibold text-green-900">説明</h3>
                            <p class="mb-4 leading-relaxed break-all">
                                {!! nl2br(e($server->description)) !!}
                            </p>
                            <p class="my-2 font-semibold leading-relaxed">作成者: {{ $server->user->name }}</p>
                            <div class="pb-2 mx-auto mt-auto mb-2 text-center border-b-2 border-gray-100 ">
                                <a href="{{ Auth::check() ? $server->url : route('login') }}"
                                    class="text-xl font-medium text-indigo-500 hover:text-indigo-700">
                                    サーバーに入る
                                </a>
                            </div>
                            @if (Auth::id() === $server->user_id)
                                <div class="flex justify-end w-full space-x-2">
                                    <a href="{{ route('discord-servers.edit', $server->id) }}"
                                        class="px-2 py-1 text-base font-semibold text-center text-white transition duration-200 ease-in bg-green-500 shadow-md md:px-4 md:py-2 hover:bg-green-600 focus:ring-green-400 focus:ring-offset-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2">編集</a>
                                    <form action="{{ route('discord-servers.destroy', $server->id) }}" method="post"
                                        class="delete">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            class="px-2 py-1 text-base font-semibold text-center text-white transition duration-200 ease-in bg-red-500 shadow-md md:px-4 md:py-2 hover:bg-red-600 focus:ring-red-400 focus:ring-offset-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2">削除</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $pagination->links() }}
                </div>
            </div>
        </div>
        <script src="{{ asset('js/discord-servers/index.js') }}"></script>
</x-app-layout>
