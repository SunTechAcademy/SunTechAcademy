<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserRoleController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate(['search' => ['nullable', 'string', 'max:255']]);
        $search = trim($data['search'] ?? '');
        $users = User::query()
            ->when($search !== '', fn ($query) => $query->where(fn ($query) => $query
                ->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')))
            ->orderBy('id')->paginate(30)->withQueryString();

        return view('management.users', ['users' => $users, 'search' => $search, 'totalUsers' => User::count()]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate(['role' => ['required', Rule::in(['student', 'admin', 'super_admin'])]]);
        DB::transaction(function () use ($request, $user, $data) {
            // 同時変更でも最後の最高管理者を残し、操作する人の最新権限を確認する。
            $owners = User::where('role', 'super_admin')->orderBy('id')->lockForUpdate()->get();
            abort_unless($owners->contains('id', $request->user()->id), 403);
            $target = User::whereKey($user->id)->lockForUpdate()->firstOrFail();
            if ($target->isSuperAdmin() && $data['role'] !== 'super_admin' && $owners->count() <= 1) {
                throw ValidationException::withMessages(['role' => '最後の最高管理者は変更できません。先に別のユーザーを最高管理者に設定してください。']);
            }
            $target->role = $data['role'];
            $target->save();
        }, 3);

        if ($request->user()->id === $user->id && $data['role'] !== 'super_admin') {
            return redirect()->route('dashboard')->with('success', '権限を更新しました。');
        }

        return back()->with('success', $user->name.'さんの権限を更新しました。');
    }
}
