<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-xl font-bold text-center">サーバー編集</h1>
                    <form action="{{ route('discord-servers.update', $server) }}" method="post"
                        class="grid grid-cols-1 gap-6 mt-16 md:mx-16 lg:mx-24 xl:mx-28">
                        @method('PATCH')
                        @csrf
                        @if (count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <label class="block">
                            <span class="font-semibold text-gray-700">サーバー名</span>
                            <input name="name" type="text" value="{{ old('name', $server->name) }}"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="">
                        </label>
                        <label class="block">
                            <span class="font-semibold text-gray-700">招待URL </span>※無期限URLにしてください。
                            <label class="block">
                                <input name="url" type="url" value="{{ old('url', $server->url) }}"
                                    class="block w-full my-1 placeholder-gray-300 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    placeholder="https://discord.gg/U96wKuret">
                            </label>
                            <a href="#" target="_blank" class="text-indigo-500 hover:text-indigo-600">期限なしURL取得方法</a>
                            <label class="block mt-2">
                                <span class="font-semibold text-gray-700">カテゴリ</span>
                                <select name="category_id"
                                    class="block w-full mt-1 text-gray-700 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach ($categories as $category)
                                        <option value="{{ old('category_id', $category->id) }}"
                                            {{ (int) old('category_id', $server->category->id) === $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="block mt-2 text-gray-700" id="tag">
                                <span class="font-semibold">#タグ</span>
                                @if (is_null(old('tags')))
                                    @foreach ($server->tags as $tag)
                                        <input type="text" name="tags[]" value="{{ $tag->name }}"
                                            class="block w-2/3 my-1 placeholder-gray-300 border-gray-300 rounded-md shadow-sm md:w-1/2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @endforeach
                                @else
                                    @foreach (array_unique(array_filter(old('tags'))) as $tagName)
                                    <input type="text" name="tags[]" value="{{ $tagName }}"
                                        class="block w-2/3 my-1 placeholder-gray-300 border-gray-300 rounded-md shadow-sm md:w-1/2 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @endforeach
                                @endif
                            </label>


                            <button type="button" id="add-button"
                                class="px-3 py-2 font-bold text-gray-500 border-2 rounded shadow-sm bg-gray-50 hover:text-gray-600 hover:bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="relative inline w-5 h-5 -top-0.5"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>タグを追加</span>
                            </button>
                            <label class="block my-2">
                                <span class="font-semibold text-gray-700">説明</span>
                                <textarea name="description"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    rows="10">{{ old('description', $server->description) }}</textarea>
                            </label>
                            <div class="mt-4 text-right">
                                <button
                                    class="px-8 py-2 text-lg font-bold text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">
                                    更新
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/discord-servers/tags.js') }}"></script>
</x-app-layout>
