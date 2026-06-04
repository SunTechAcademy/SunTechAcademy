<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chapter;

class CheckBeginnerCourseCompletion
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // 未ログインなら先にログイン画面へ
        if (!$user) {
            return redirect()->route('login');
        }

        // 全チャプター数と、ユーザーが完了したチャプター数を取得
        $totalChapters = Chapter::count();
        $completedChaptersCount = $user->chapters()->count();

        // まだ全チャプター完了していない場合（またはチャプターが0件の初期状態）
        if ($totalChapters === 0 || $completedChaptersCount < $totalChapters) {
            
            // 初級コース画面に強制リダイレクトし、エラーメッセージを持たせる
            return redirect()->route('courses.beginner')
                ->with('error', '中級・上級コースへ進むには、まず初級コースの全チャプターを完了してください。');
        }

        // 完了していれば、そのまま目的のページへ通す
        return $next($request);
    }
}