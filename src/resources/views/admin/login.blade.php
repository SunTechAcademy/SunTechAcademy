<x-guest-layout>
    <div class="mb-4 text-xl font-bold text-center text-gray-700">管理者ログイン</div>
    
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div>
            <x-input-label for="email" value="メールアドレス" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="password" value="パスワード" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">ログイン</x-primary-button>
        </div>
    </form>
</x-guest-layout>