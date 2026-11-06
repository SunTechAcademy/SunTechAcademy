<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function beginner()
    {
        $user = Auth::user();
        
        // 2. カリキュラム進捗率の計算 (全チャプター数 / 完了チャプター数)
        $totalChapters = Chapter::count();
        $completedChaptersCount = $user->chapters()->count();
        $progress = $totalChapters > 0 ? ($completedChaptersCount / $totalChapters) * 100 : 0;

        // 3. 課題進捗 (課題フラグが立っているチャプター数)
        $totalAssignments = Lesson::whereHas('chapters', function ($query) {
            $query->where('is_assignment', 1);
        })->count();
        $completedAssignments = Lesson::whereHas('chapters', function ($query) {
            $query->where('is_assignment', 1);
        })->get()->filter(function ($lesson) use ($user) {
            // 1. そのレッスン内にある「課題チャプター」のID一覧を取得
            $assignmentChapterIds = $lesson->chapters()
                ->where('is_assignment', 1)
                ->pluck('id');

            // 2. ユーザーが完了したチャプターの中に、上記IDがいくつ含まれるかカウント
            $completedCount = $user->chapters()
                ->whereIn('chapter_id', $assignmentChapterIds)
                ->count();

            // 3. 「レッスン内の課題数」と「完了した課題数」が一致すれば、そのレッスンは完了！
            return $completedCount >= $assignmentChapterIds->count();
        })->count();

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

        return view('courses.beginner', compact('progress', 'totalAssignments', 'completedAssignments', 'lessons'));
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
        $chapter = Chapter::with('lesson.chapters')->findOrFail($chapterId);
        $user = Auth::user();
        $result = $user->chapters()->toggle([
            $chapterId => ['completed_at' => now()]
        ]);

        $response = redirect(route('lessons.show', $chapter->lesson_id) . "#chapter-{$chapterId}");
        if (!empty($result['attached'])) {
            $chapterIds = $chapter->lesson->chapters->pluck('id');
            $completed = $user->chapters()->whereIn('chapters.id', $chapterIds)->count();
            $response->with('chapterCelebration', [
                'lesson_id' => $chapter->lesson_id,
                'lesson_number' => $chapter->lesson->sort_order,
                'chapter_number' => $chapter->sort_order,
                'chapter_title' => $chapter->title,
                'completed' => $completed,
                'total' => $chapterIds->count(),
                'lesson_complete' => $completed === $chapterIds->count(),
            ]);
        }

        return $response;
    }
}
