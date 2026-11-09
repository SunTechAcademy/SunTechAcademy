<x-admin-layout>
    <a class="admin-text-link" href="{{ route('admin.users.index') }}">← 登録ユーザーへ戻る</a>
    <section class="user-delete-card"><p class="admin-eyebrow">ACCOUNT REMOVAL</p><h1 class="admin-title">削除するユーザーの確認</h1><p class="admin-subtitle">対象のアカウントに間違いがないか確認してください。</p>
        <div class="user-delete-person"><strong>{{ $user->name }}</strong><p>{{ $user->email }}</p><span>{{ ['student'=>'一般受講生','admin'=>'管理者','super_admin'=>'最高管理者'][$user->role] ?? '未設定' }}</span></div>
        @if($user->isSuperAdmin())
            <p class="user-delete-warning">最高管理者は削除できません。削除する場合は、先に最高管理者がユーザー画面で権限を変更してください。</p>
        @else
            <div class="user-delete-explanation"><h2>削除されるもの</h2><ul><li>アカウントとログインする権利</li><li>本人の学習履歴（完了Chapter：{{ $completedChapters }}件）・ログイン履歴・担当記録</li></ul><h2>残るもの</h2><p>発行したタスクと添付画像、ほかの受講者の学習履歴は残ります。本人だけが担当している未完了タスクは「未対応」に戻ります（現在の担当中：{{ $activeTasks }}件）。</p></div>
            @if($errors->any())<p class="user-delete-warning" role="alert">{{ $errors->first() }}</p>@endif
            <form method="POST" action="{{ route('admin.users.destroy',$user) }}">@csrf @method('DELETE')
                <label class="user-delete-check"><input name="confirm_delete" type="checkbox" value="1" required><span>このユーザーを削除します。削除したアカウントと履歴は元に戻せないことを確認しました。</span></label>
                <div class="user-delete-footer"><a class="admin-text-link" href="{{ route('admin.users.index') }}">キャンセル</a><button class="user-delete-submit" type="submit">このユーザーを削除する</button></div>
            </form>
        @endif
    </section>
    <style>
        .user-delete-card{max-width:720px;margin:28px auto;background:white;border:1px solid #e5eaf4;border-radius:24px;padding:36px}.user-delete-person{background:#f7f9fd;border:1px solid #e9eef6;border-radius:16px;padding:22px;margin:26px 0;overflow-wrap:anywhere}.user-delete-person strong{font-size:18px;color:#657895}.user-delete-person p{font-size:13px;color:#8f9fba;margin:8px 0}.user-delete-person>span{font-size:11px;color:#a2adc1}.user-delete-explanation{font-size:12px;color:#97a5bb;line-height:1.9}.user-delete-explanation h2{font-size:13px;color:#7a8aa5;margin:18px 0 8px}.user-delete-explanation ul{padding-left:20px}.user-delete-check{display:flex;align-items:flex-start;gap:12px;font-size:12px;color:#a27e8f;line-height:1.9;padding:18px;background:#fcf3f6;border-radius:12px;margin-top:26px;cursor:pointer}.user-delete-check input{flex-shrink:0;accent-color:#ba8b9d;margin-top:5px;width:16px;height:16px}.user-delete-footer{display:flex;justify-content:flex-end;align-items:center;gap:24px;margin-top:26px}.user-delete-submit{border:0;padding:14px 20px;border-radius:12px;background:#b67f94;color:white;font-size:12px;font-weight:600;transition:background .2s}.user-delete-submit:hover{background:#a66c82}.user-delete-warning{font-size:13px;line-height:1.9;color:#b07d90;margin:20px 0}@media(max-width:600px){.user-delete-card{padding:24px 20px}.user-delete-footer{flex-wrap:wrap}.user-delete-submit{width:100%}}
    </style>
</x-admin-layout>
