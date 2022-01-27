<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-xl text-center">スレッド編集</h1>

                    <form method="post" action="{{ route('boards.update', $board) }}" class="grid grid-cols-1 gap-6 mt-16 md:mx-16 lg:mx-24 xl:mx-28">
                        @method('PATCH')
                        @csrf
                        <label class="block">
                            <span class="text-gray-700">タイトル</span>
                            <input name="title" type="text" value="{{ old('title', $board->title) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </label>
                        @error('title')
                        <div class="error">{{ $message }}</div>
                        @enderror
                        <label class="block my-2">
                            <span class="text-gray-700">本文</span>
                            <textarea name="description" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="10" required>{{ old('description', $board->description) }}</textarea>
                        </label>
                        @error('description')
                        <div class="error">{{ $message }}</div>
                        @enderror
                        <div class="mt-4 text-right">
                            <button class="px-8 py-2 text-lg font-bold text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">
                                保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>