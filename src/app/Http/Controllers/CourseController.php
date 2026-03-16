<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CourseController extends Controller
{
    public function beginner()
    {
        $user = Auth::user();
        
        // 1. 連続ログイン日数の計算
        $loginDates = $user->loginHistories()->orderBy('login_date', 'desc')->pluck('login_date')->toArray();
        $streak = 0;
        $currentDate = Carbon::today();
        foreach ($loginDates as $date) {
            if ($date == $currentDate->format('Y-m-d')) {
                $streak++;
                $currentDate->subDay();
            } else { break; }
        }

        // 2. カリキュラム進捗率の計算 (全チャプター数 / 完了チャプター数)
        $totalChapters = Chapter::count();
        $completedChaptersCount = $user->chapters()->count();
        $progress = $totalChapters > 0 ? ($completedChaptersCount / $totalChapters) * 100 : 0;

        // 3. 課題進捗 (課題フラグが立っているチャプター数)
        $totalAssignments = Chapter::where('is_assignment', 1)->count();
        $completedAssignments = $user->chapters()->where('is_assignment', 1)->count();

        // レッスン一覧を取得（チャプターも一緒に）
        $lessons = Lesson::with('chapters')->orderBy('sort_order')->get();

        // ログイン中のユーザーが完了したチャプターIDを配列で取得
        $completedIds = Auth::user()->chapters()->pluck('chapter_id')->toArray();

        // 各チャプターに「is_completed」という属性を動的に追加
        foreach ($lessons as $lesson) {
            foreach ($lesson->chapters as $chapter) {
                $chapter->is_completed = in_array($chapter->id, $completedIds);
            }
        }

        return view('courses.beginner', compact('streak', 'progress', 'totalAssignments', 'completedAssignments', 'lessons'));
    }

    public function showLesson($id)
    {
        $lesson = Lesson::with('chapters.users')->findOrFail($id);
        $user = Auth::user();
        
        // ユーザーが各チャプターを完了しているかのリスト
        $completedChapterIds = $user->chapters()->pluck('chapter_id')->toArray();

        // IDに基づいたビュー名を生成
        $viewName = "courses.lessons.lesson{$id}";

        // ビューファイルが存在しない場合のフォールバック
        if (!view()->exists($viewName)) {
            abort(404, "Lesson {$id} のコンテンツ準備中です。");
        }

        return view($viewName, compact('lesson', 'completedChapterIds'));
    }

    public function completeChapter(Request $request, $chapterId)
    {
        Auth::user()->chapters()->toggle([
            $chapterId => ['completed_at' => now()]
        ]);
        
        return redirect(url()->previous() . "#chapter-{$chapterId}");
    }
}