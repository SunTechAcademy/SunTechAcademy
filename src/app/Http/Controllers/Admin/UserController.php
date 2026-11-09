<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IntermediateTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate(['search' => 'nullable|string|max:255', 'role' => ['nullable', Rule::in(['student', 'admin', 'super_admin'])]]);
        $search = trim($data['search'] ?? '');
        $role = $data['role'] ?? '';
        $users = User::query()
            ->when($search !== '', fn ($query) => $query->where(fn ($query) => $query->where('name', 'like', '%'.$search.'%')->orWhere('email', 'like', '%'.$search.'%')))
            ->when($role !== '', fn ($query) => $query->where('role', $role))
            ->withMax('loginHistories', 'login_date')->orderByDesc('id')->paginate(20)->withQueryString();
        return view('admin.users.index', compact('users', 'search', 'role'));
    }

    public function confirmDelete(User $user)
    {
        return view('admin.users.delete', [
            'user' => $user,
            'completedChapters' => $user->chapters()->count(),
            'activeTasks' => $user->completedIntermediateTasks()->where('status', 'assigned')->count(),
        ]);
    }

    public function destroy(Request $request, User $user)
    {
        $request->validate(['confirm_delete' => 'accepted']);
        $name = $user->name;
        DB::transaction(function () use ($user) {
            $target = User::whereKey($user->id)->lockForUpdate()->firstOrFail();
            if ($target->isSuperAdmin()) {
                throw ValidationException::withMessages(['confirm_delete' => '最高管理者は削除できません。先に最高管理者による権限変更が必要です。']);
            }
            // 発行者を外し、退社者が発行したタスクや他の受講者の実績を残す。
            IntermediateTask::where('user_id', $target->id)->update(['user_id' => null]);
            $assigned = IntermediateTask::where('status', 'assigned')
                ->whereHas('completedUsers', fn ($query) => $query->where('users.id', $target->id))
                ->lockForUpdate()->get();
            foreach ($assigned as $task) {
                if (!$task->completedUsers()->where('users.id', '!=', $target->id)->exists()) {
                    $task->update(['status' => 'incomplete']);
                }
            }
            DB::table('password_reset_tokens')->where('email', $target->email)->delete();
            $target->delete();
        }, 3);
        return redirect()->route('admin.users.index')->with('success', $name.'さんのアカウントを削除しました。');
    }
}
