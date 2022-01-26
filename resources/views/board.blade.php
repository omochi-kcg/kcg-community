<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-10 bg-white border-b border-gray-200">
                    <div class="mb-4 text-right">
                        <a href="{{ route('boards.create') }}" type="button" class="inline-flex items-center px-4 py-2 font-bold text-white bg-indigo-500 rounded hover:bg-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="mt-1">スレッドを作成</span>
                        </a>
                    </div>

                    <div class="flex-wrap md:flex">
                        @foreach ($boards as $board)
                        <div class="flex flex-col items-start break-all w-full p-12 border-2 mt-6 shadow rounded-2xl md:p-8 xl:p-6 lg:p-8">
                            <h2 class="mb-4 text-2xl font-medium text-gray-900 sm:text-3xl title-font">
                                {{ $board->title }}
                            </h2>
                            <time class="text-secondary">
                                投稿日時: {{ $board->created_at->format('Y/m/d H:i') }}
                            </time>
                            <p class="mb-2 leading-relaxed">作成者: {{ $board->user->name }}</p>
                            <p class="mb-4 leading-relaxed">
                                {{ $board->description }}
                            </p>

                            <div class="pb-2 mx-auto mt-auto mb-2 border-b-2 text-right border-gray-100 ">
                                <a href="{{ route('boards.show', $board) }}" class="text-lg text-indigo-500">
                                    >>コメントを見る({{ $board->comments->count() }})
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>