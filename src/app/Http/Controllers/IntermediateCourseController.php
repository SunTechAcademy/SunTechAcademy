<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IntermediateTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IntermediateCourseController extends Controller
{
    /**
     * 中級コース ダッシュボード（大項目8個の一覧、ノルマ進捗）
     */
    public function index()
    {
        $user = Auth::user();
        
        // フェーズごとのタスク総数を取得
        $taskCounts = IntermediateTask::select('phase', \DB::raw('count(*) as total'))
            ->groupBy('phase')
            ->pluck('total', 'phase')
            ->toArray();

        // ログインユーザーの完了済みタスク数をフェーズごとに集計
        // $completedCounts = $user->completedIntermediateTasks()
        $completedCounts = $user->completedIntermediateTasks()
            ->select('phase', \DB::raw('count(*) as total'))
            ->groupBy('phase')
            ->pluck('total', 'phase')
            ->toArray();

        $phases = IntermediateTask::phaseLabels();
        $definitions = IntermediateTask::phaseDefinitions();

        // ノルマ設定
        $norms = [
            'implementation' => 10,
            'operation'      => 10,
        ];

        return view('courses.intermediate.index', compact('phases', 'definitions', 'taskCounts', 'completedCounts', 'norms'));
    }

    /**
     * 特定フェーズのタスク一覧画面
     */
    public function phaseTasks($phase)
    {
        $phases = IntermediateTask::phaseLabels();
        if (!array_key_exists($phase, $phases)) {
            abort(404);
        }

        $phaseLabel = $phases[$phase];
        $tasks = IntermediateTask::where('phase', $phase)->get();
        
        // ユーザーが完了しているタスクのIDリストを取得
        // $completedTaskIds = Auth::user()->completedIntermediateTasks()->pluck('intermediate_tasks.id')->toArray();

        // return view('courses.intermediate.phase', compact('tasks', 'phaseLabel', 'phase', 'completedTaskIds'));
        return view('courses.intermediate.phase', compact('tasks', 'phaseLabel', 'phase'));
    }

    /**
     * タスク詳細表示
     */
    public function showTask($id)
    {
        $task = IntermediateTask::findOrFail($id);
        $phases = IntermediateTask::phaseLabels();
        
        // $isCompleted = Auth::user()->completedIntermediateTasks()
        //     ->where('intermediate_task_id', $id)
        //     ->exists();

        $isCompleted = ($task->status === 'completed');

        return view('courses.intermediate.show', compact('task', 'phases', 'isCompleted'));
    }

    /**
     * タスクの完了処理
     */
    public function completeTask($id)
    {
        $user = Auth::user();
        $task = IntermediateTask::findOrFail($id);

        // 重複登録を防ぎつつ、中間テーブルに同期（トグルではなく、完了登録を維持）
        // $user->completedIntermediateTasks()->syncWithoutDetaching([$id => ['completed_at' => now()]]);

        $task->update(['status' => 'completed']);

        $user->completedIntermediateTasks()->syncWithoutDetaching([$id => ['completed_at' => now()]]);

        return redirect()->route('courses.intermediate.phase', ['phase' => $task->phase])
            ->with('success', 'タスクを完了にしました！');
    }

    /**
     * タスク作成画面（管理者権限限定）
     */
    public function create()
    {
        $phases = IntermediateTask::phaseLabels();
        return view('courses.intermediate.create', compact('phases'));
    }

    /**
     * タスクの保存処理（管理者権限限定）
     */
    public function store(Request $request)
    {
        $request->validate([
            'phase'       => 'required|string',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // publicディスクのintermediate_tasksフォルダへ保存
            $imagePath = $request->file('image')->store('intermediate_tasks', 'public');
        }

        IntermediateTask::create([
            'phase'       => $request->phase,
            'title'       => $request->title,
            'description' => $request->description,
            'image_path'  => $imagePath,
            'status'      => 'incomplete',
        ]);

        return redirect()->route('courses.intermediate.index')
            ->with('success', '新しい実務タスクを作成しました。');
    }
}