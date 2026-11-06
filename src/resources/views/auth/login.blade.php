<x-login-layout>
    <h2 id="login-title">ログイン</h2>
    <p class="login-intro">おかえりなさい。学びの続きを始めましょう。</p>
    @if(session('status'))
        <div class="login-status" role="status">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="login-field">
            <label for="email">メールアドレス</label>
            <input id="email" class="login-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="name@example.com" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" @if($errors->has('email')) aria-describedby="email-errors" @endif>
            @if($errors->has('email'))
                <ul id="email-errors" class="login-errors" role="alert">@foreach($errors->get('email') as $message)<li>{{ $message }}</li>@endforeach</ul>
            @endif
        </div>
        <div class="login-field">
            <label for="password">パスワード</label>
            <input id="password" class="login-input" type="password" name="password" required autocomplete="current-password" placeholder="パスワードを入力" aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" @if($errors->has('password')) aria-describedby="password-errors" @endif>
            @if($errors->has('password'))
                <ul id="password-errors" class="login-errors" role="alert">@foreach($errors->get('password') as $message)<li>{{ $message }}</li>@endforeach</ul>
            @endif
        </div>
        <label for="remember_me" class="login-remember"><input id="remember_me" type="checkbox" name="remember" @checked(old('remember'))><span>次回から自動ログイン</span></label>
        <button type="submit" class="login-submit">ログインして学習を続ける <span aria-hidden="true">→</span></button>
        @if (Route::has('password.request'))
            <p class="login-forgot"><a href="{{ route('password.request') }}">パスワードをお忘れですか？</a></p>
        @endif
    </form>
</x-login-layout>
