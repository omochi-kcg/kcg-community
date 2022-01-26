<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-hidden rounded-lg h-72">
                        <img alt="content" class="object-cover object-center w-full h-full" src="{{ asset('images/school_building_ekimae.png') }}">
                    </div>
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-20 mx-auto">
                            <div class="flex flex-col w-full mb-20 text-center">
                                <h2 class="mb-4 text-2xl font-medium text-gray-900 sm:text-3xl title-font">Contents</h2>
                            </div>
                            <div class="flex flex-wrap">
                                <div class="px-8 py-6 border-l-2 border-gray-200 xl:w-1/3 lg:w-1/2 md:w-full border-opacity-60">
                                    <h2 class="mb-2 text-lg font-medium text-gray-900 sm:text-xl title-font">Discordサーバー
                                    </h2>
                                    <p class="mb-4 text-base leading-relaxed">Discordサーバーのメンバー募集や検索ができます</p>
                                    <a href="{{ route('discord-servers.index') }}" class="inline-flex items-center text-indigo-500">Enter
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="px-8 py-6 border-l-2 border-gray-200 xl:w-1/3 lg:w-1/2 md:w-full border-opacity-60">
                                    <h2 class="mb-2 text-lg font-medium text-gray-900 sm:text-xl title-font">掲示板
                                    </h2>
                                    <p class="mb-4 text-base leading-relaxed">誰でも自由にトピックを立てて話し合える掲示板です</p>
                                    <a href="{{ route('boards.board') }}" class="inline-flex items-center text-indigo-500">Enter
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">

                                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="px-8 py-6 border-l-2 border-gray-200 xl:w-1/3 lg:w-1/2 md:w-full border-opacity-60">
                                    <h2 class="mb-2 text-lg font-medium text-gray-900 sm:text-xl title-font">授業評価(予定)
                                    </h2>
                                    <p class="mb-4 text-base leading-relaxed">授業の評価をみんなと共有しましょう</p>
                                    <a class="inline-flex items-center text-indigo-500">Enter
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>