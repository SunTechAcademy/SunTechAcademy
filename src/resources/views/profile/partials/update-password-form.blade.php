<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            パスワード更新
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            アカウントのセキュリティを保つために、長くランダムなパスワードを使用してください。
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="現在のパスワード" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="新しいパスワード" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="パスワード確認" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="profile-form-actions">
            <button type="submit" class="profile-save">パスワードを更新する<span aria-hidden="true">→</span></button>

            @if (session('status') === 'password-updated')
                <p class="profile-saved" role="status">✓ パスワードを更新しました。</p>
            @endif
        </div>
    </form>
</section>
