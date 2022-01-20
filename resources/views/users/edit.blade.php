<x-app-layout>
    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PATCH')

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name', $user->name)"
                    required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    更新
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
