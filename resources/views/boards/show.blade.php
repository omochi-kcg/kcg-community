<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-10 bg-white border-b border-gray-200">
                    <div class="mb-4 text-left">
                        &laquo; <a href="{{ route('boards.board') }}">一覧に戻る</a>
                    </div>

                    <div class="flex-wrap md:flex">
                        <div class="flex flex-col items-start break-all w-full p-12 border-2 mt-6 shadow rounded-2xl md:p-8 xl:p-6 lg:p-8">
                            <div class="flex justify-start w-full space-x-2">
                                <h2 class="mb-4 text-2xl font-extrabold text-gray-900 sm:text-3xl title-font">
                                    <span>{{ $board->title }}</span></br>
                                    @if (Auth::id() === $board->user_id)
                                    <a href="{{ route('boards.edit', $board) }}" class="px-2 py-1 text-base font-semibold text-center text-white transition duration-200 ease-in bg-green-500 shadow-md md:px-4 md:py-2 hover:bg-green-600 focus:ring-green-400 focus:ring-offset-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2">編集</a>
                                    <form method="post" action="{{ route('boards.destroy', $board) }}" id="delete_post" class="inline">
                                        @method('DELETE')
                                        @csrf
                                        <button class="px-2 py-1 text-base font-semibold text-center text-white transition duration-200 ease-in bg-red-500 shadow-md md:px-4 md:py-2 hover:bg-red-600 focus:ring-red-400 focus:ring-offset-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2">削除</button>
                                    </form>
                                    @endif
                                </h2>
                            </div>
                            <time class="text-secondary">
                                投稿日時: {{ $board->created_at->format('Y/m/d H:i') }}
                            </time>
                            <p class="mb-2 leading-relaxed">作成者: {{ $board->user->name }}</p>
                            <p class="mb-4 leading-relaxed">
                                {{ $board->description }}
                            </p>

                            <h2 class="mt-4 text-lg font-medium text-gray-900 sm:text-xl title-font border-b-2 border-gray-100">コメント</h2>
                            @foreach($board->comments as $comment)
                            <li class="list-none my-2">
                                <form method="post" action="{{ route('comments.destroy', $comment) }}" class="delete-comment">
                                    @method('DELETE')
                                    @csrf
                                    <div class="flex">
                                        @if (Auth::id() === $comment->user_id)
                                        <button class="text-red-500">[×]</button>
                                        @endif
                                        <p class="my-2 leading-relaxed text-gray-500 font-bold"> 投稿者: {{ $board->user->name }}</p>
                                    </div>
                                </form>
                                {{ $comment -> body }}
                            </li>
                            @endforeach

                            <form method="post" action="{{ route('comments.store', $board) }}" class="w-full">
                                @csrf
                                <label class="block mt-16 mb-2">
                                    <textarea name="body" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="5" required></textarea>
                                </label>
                                <div class="mt-4 text-left">
                                    <button class="px-8 py-2 text-lg font-bold text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">
                                        コメントを投稿する
                                    </button>
                                </div>
                            </form>


                            <script>
                                'use strict';

                                {
                                    document.getElementById('delete_post').addEventListener('submit', e => {
                                        e.preventDefault();

                                        if (!confirm('本当に削除しますか？')) {
                                            return;
                                        }
                                        e.target.submit();

                                    });
                                    document.querySelectorAll('.delete-comment').forEach(form => {
                                        form.addEventListener('submit', e => {
                                            e.preventDefault();

                                            if (!confirm('本当に削除しますか？')) {
                                                return;
                                            }
                                            form.submit();
                                        });
                                    });

                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>