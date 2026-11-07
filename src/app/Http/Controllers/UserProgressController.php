<?php

namespace App\Http\Controllers;

use App\Models\IntermediateTask;
use App\Models\Lesson;
use App\Models\User;

class UserProgressController extends Controller
{
    public function show(User $user)
    {
        $lessons = Lesson::with('chapters')->orderBy('sort_order')->get();
        $completedChapters = $user->chapters()->get()->keyBy('id');
        $totalChapters = $lessons->sum(fn ($lesson) => $lesson->chapters->count());
        $completedCount = $lessons->sum(fn ($lesson) => $lesson->chapters->filter(fn ($chapter) => $completedChapters->has($chapter->id))->count());
        $completedLessons = $lessons->filter(fn ($lesson) => $lesson->chapters->isNotEmpty() && $lesson->chapters->every(fn ($chapter) => $completedChapters->has($chapter->id)))->count();
        $progress = $totalChapters ? round($completedCount / $totalChapters * 100, 1) : 0;
        $nextChapter = $lessons->flatMap->chapters->first(fn ($chapter) => !$completedChapters->has($chapter->id));
        $taskQuery = IntermediateTask::whereHas('completedUsers', fn ($query) => $query->where('users.id', $user->id));
        $taskCounts = (clone $taskQuery)->selectRaw('phase, status, count(*) as total')->groupBy('phase', 'status')->get();
        $completedTasks = $taskCounts->where('status', 'completed')->sum('total');
        $activeTasks = $taskCounts->where('status', 'assigned')->sum('total');
        $tasks = $user->completedIntermediateTasks()->orderByRaw("CASE WHEN status = 'assigned' THEN 0 ELSE 1 END")->orderByDesc('intermediate_tasks.updated_at')->paginate(15)->withQueryString();
        $phases = IntermediateTask::phaseLabels();
        $lastLogin = $user->loginHistories()->max('login_date');
        $lastCompletion = $completedChapters->map(fn ($chapter) => $chapter->pivot->completed_at)->filter()->max();
        return view('management.user-progress', compact('user', 'lessons', 'completedChapters', 'totalChapters', 'completedCount', 'completedLessons', 'progress', 'nextChapter', 'taskCounts', 'completedTasks', 'activeTasks', 'tasks', 'phases', 'lastLogin', 'lastCompletion'));
    }
}
