<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">{{ Auth::user()->isSuperAdmin() ? '権限管理・受講者一覧' : '受講者一覧' }}</h2></x-slot>
    <x-course-page-styles />
    <div class="course-page"><div class="course-container">
        <div class="course-hero"><div><p class="course-eyebrow">MEMBER PERMISSIONS</p><h1>学びを支えるチームを管理</h1><p class="course-muted">管理者はタスクを発行・編集・削除できます。権限を変更できるのは最高管理者だけです。</p></div></div>
        @if(session('success'))<p class="course-notice" role="status">{{ session('success') }}</p>@endif
        @if($errors->any())<p class="course-notice" role="alert">{{ $errors->first() }}</p>@endif
        <form method="GET" action="{{ route('management.users') }}" class="role-search">
            <label for="member-search">受講者・管理者を検索</label>
            <div class="role-search-controls">
                <div class="role-search-field">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="10.5" cy="10.5" r="6.5"/><path d="m16 16 4.5 4.5" stroke-linecap="round"/></svg>
                    <input id="member-search" name="search" type="search" value="{{ $search }}" placeholder="名前・メールアドレスで検索">
                </div>
                <button class="course-button" type="submit">検索する</button>
                <a class="role-reset" href="{{ route('management.users') }}">全員表示</a>
            </div>
        </form>
        <p class="course-muted" style="margin:16px 0">登録ユーザー：{{ $totalUsers }}名 ／ 表示対象：{{ $users->total() }}名</p>
        <div class="role-members">
            @forelse($users as $member)
                <div class="role-member">
                    <div><strong><a href="{{ route('management.users.show', $member) }}">{{ $member->name }}</a></strong><p class="course-muted">{{ $member->email }}</p></div>
                    <div class="role-member-actions">
                        <a href="{{ route('management.users.show', $member) }}" class="role-progress-link" aria-label="{{ $member->name }}さんの進捗を見る">進捗を見る →</a>
                        @can('manage-roles')
                        <form method="POST" action="{{ route('management.users.role', $member) }}">
                            @csrf @method('PATCH')
                            <label class="sr-only" for="role-{{ $member->id }}">{{ $member->name }}さんの権限</label>
                            <div class="role-select-field">
                            <svg class="role-select-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="m12 3 8 3v6c0 4-5 7.5-8 9-3-1.5-8-5-8-9V6l8-3Z" stroke-linejoin="round"/><path d="m8.5 12 2.5 2.5 4.5-5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <select id="role-{{ $member->id }}" name="role">
                                <option value="student" @selected($member->role === 'student')>一般受講生</option>
                                <option value="admin" @selected($member->role === 'admin')>管理者</option>
                                <option value="super_admin" @selected($member->role === 'super_admin')>最高管理者</option>
                            </select>
                            <svg class="role-select-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m6 9 6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                            <button class="course-button" type="submit">保存</button>
                        </form>
                        @else
                            <span class="role-owner">{{ ['student' => '一般受講生', 'admin' => '管理者', 'super_admin' => '最高管理者'][$member->role] ?? '未設定' }}</span>
                        @endcan
                    </div>
                </div>
            @empty
                <p class="course-muted" style="padding:24px 0">該当するユーザーが見つかりません。検索条件を変更してください。</p>
            @endforelse
        </div>
        <div style="margin-top:24px">{{ $users->links() }}</div>
    </div></div>
    <style>
        .role-member-actions { display:flex;align-items:center;gap:16px;flex-wrap:wrap; }
        .role-progress-link { padding:12px 16px;border-radius:12px;background:#eef2fa;color:#6374a4;font-size:13px;font-weight:600;white-space:nowrap; }
        .role-progress-link:hover { background:#e2e9f7; }
        .role-progress-link:focus-visible,.role-member strong a:focus-visible { outline:3px solid #b5c2e1;outline-offset:3px; }
        .role-member strong a:hover { color:#6374a4;text-decoration:underline; }
        .role-search { padding:24px;background:linear-gradient(120deg,#fff,#f2f3fb);border:1px solid #e8eaf4;border-radius:20px; }
        .role-search > label { font-size:12px;font-weight:700;color:#69738e; }
        .role-search-controls { display:flex;gap:12px;align-items:center;flex-wrap:wrap;margin-top:12px; }
        .role-search-field { position:relative;flex:1;min-width:220px;max-width:520px; }
        .role-search-field > svg { position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#8992b3;pointer-events:none; }
        .role-search input { width:100%;height:50px;padding:12px 16px 12px 46px;background:#fff;border:1px solid #e1e5f0;border-radius:14px;font-size:14px;color:#414b65;box-shadow:0 2px 5px #343d6410;transition:border-color .2s,box-shadow .2s; }
        .role-search input::placeholder { color:#969eb3; }
        .role-reset { padding:12px;font-size:13px;font-weight:600;color:#7e87a2;border-radius:12px;transition:background .2s,color .2s; }
        .role-reset:hover { background:#e9ecf7;color:#596693; }
        .role-search .course-button,.role-member .course-button { min-height:48px;border-radius:14px; }
        .role-select-field { position:relative;color:#7985ac; }
        .role-select-icon,.role-select-chevron { position:absolute;top:50%;transform:translateY(-50%);pointer-events:none; }
        .role-select-icon { left:14px; }
        .role-select-chevron { right:14px; }
        .role-member .role-select-field select { appearance:none;background-image:none;background-color:#f4f5fb;min-width:188px;height:48px;padding:10px 40px;border:1px solid #e3e6f2;border-radius:14px;color:#59658b;font-size:13px;font-weight:600;cursor:pointer;transition:background-color .2s,border-color .2s,box-shadow .2s; }
        .role-member select:hover { background-color:#eceff9;border-color:#c9d0e6; }
        .role-search input:focus,.role-member select:focus { outline:0;border-color:#929fc9;box-shadow:0 0 0 4px #a5b0dc26;--tw-ring-shadow:0 0 #0000; }
        .role-reset:focus-visible { outline:3px solid #a5b0dc;outline-offset:2px; }
        .role-members { background:#fff;border:1px solid #e8eaf2;border-radius:20px;padding:8px 24px; }
        .role-member { display:flex;align-items:center;justify-content:space-between;gap:20px;padding:22px 0;border-bottom:1px solid #eef0f6; }
        .role-member:last-child { border-bottom:0; }
        .role-member > div { min-width:0;overflow-wrap:anywhere; }
        .role-member form { display:flex;gap:12px;align-items:center;flex-shrink:0; }
        .role-owner { padding:8px 16px;border-radius:20px;background:#efedfc;color:#7564a8;white-space:nowrap; }
        @media(max-width:600px) { .role-member { align-items:flex-start;flex-direction:column; } .role-search { padding:18px; } .role-search-field { min-width:0;flex-basis:100%; } .role-member form { width:100%;gap:10px; } .role-select-field { flex:1;min-width:0; } .role-member .role-select-field select { width:100%;min-width:0; } }
        @media(prefers-reduced-motion:reduce) { .role-search input,.role-member select,.role-reset { transition:none; } }
    </style>
</x-app-layout>
