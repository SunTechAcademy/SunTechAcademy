<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IntermediateTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IntermediateCourseController extends Controller
{
    /**
     * 運用ルール画面の表示
     */
    public function rules()
    {
        return view('courses.intermediate.rules');
    }

    /**
     * URLまとめ画面の表示用メソッドを追加
     */
    public function documents()
    {
        $urls = $this->getDocumentUrls();
        return view('courses.intermediate.documents', compact('urls'));
    }

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
        $completedCounts = $user->completedIntermediateTasks()
            ->where('status', 'completed')
            ->select('phase', \DB::raw('count(*) as total'))
            ->groupBy('phase')
            ->pluck('total', 'phase')
            ->toArray();

        $phases = IntermediateTask::phaseLabels();
        $definitions = IntermediateTask::phaseDefinitions();
        // 各カードへ渡す用のURLリストを取得
        $urls = $this->getDocumentUrls();

        // ノルマ設定
        $norms = [
            'implementation' => 15,
            'operation'      => 15,
        ];

        return view('courses.intermediate.index', compact('phases', 'definitions', 'taskCounts', 'completedCounts', 'norms', 'urls'));
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
        $tasks = IntermediateTask::where('phase', $phase)->with(['user', 'completedUsers'])->get();
        
        return view('courses.intermediate.phase', compact('tasks', 'phaseLabel', 'phase'));
    }

    /**
     * タスク詳細表示
     */
    public function showTask($id)
    {
        $task = IntermediateTask::with(['user', 'completedUsers'])->findOrFail($id);
        $phases = IntermediateTask::phaseLabels();

        $isCompleted = ($task->status === 'completed');
        $isAssigned = ($task->status === 'assigned');
        $isMyTask = $task->completedUsers->contains(Auth::id());

        return view('courses.intermediate.show', compact('task', 'phases', 'isCompleted', 'isAssigned', 'isMyTask'));
    }

    /**
     * タスクの担当登録処理
     */
    public function assignTask($id)
    {
        $user = Auth::user();
        $task = IntermediateTask::findOrFail($id);

        // 未対応（incomplete）の場合のみ担当になれる
        if ($task->status === 'incomplete') {
            // DBのタスクステータスを「担当中」に変更
            $task->update(['status' => 'assigned']);
            
            // 中間テーブルにログインユーザーを紐づける（担当者にする）
            $user->completedIntermediateTasks()->syncWithoutDetaching([$id => ['completed_at' => now()]]);
        }

        return redirect()->route('courses.intermediate.show_task', ['id' => $task->id])
            ->with('success', 'このタスクの担当になりました！実装を進めていきましょう。');
    }

    /**
     * 管理用のURL配列を返すプライベートメソッドを末尾に追記
     */
    private function getDocumentUrls()
    {
        return [
            'requirement'      => 'https://docs.google.com/spreadsheets/d/1lQxU8IBmf1GfjkClqQQp6hD-M6dntvdAfzwjr4Eo3qQ/edit?usp=sharing',
            'basic_design'     => 'https://docs.google.com/spreadsheets/d/1x6SHg0qwRfukNVU4Qsq-WLAXCAfl16xv0I8B5GnxaGE/edit?usp=sharing',
            'detail_design'    => 'https://docs.google.com/spreadsheets/d/1ZkaXjU1WRSRLrXGmGrVvoZprGCaZ6hCeeUVGCj_pGLI/edit?usp=sharing',
            'unit_test'        => 'https://docs.google.com/spreadsheets/d/1Dfh6Y66O_K1uGAaHmcM1wuRL2-OUCDomP9gfBGoC4jo/edit?usp=sharing',
            'integration_test' => 'https://docs.google.com/spreadsheets/d/1K8XcPXTwwQtl90P6GBwBqXrbCUE4bYvByi2m2GvR5_Y/edit?usp=sharing',
            'system_test'      => 'https://docs.google.com/spreadsheets/d/1zTgtF7cAZDetnEPrRV99Kwkq_dnt012_tqJokExMHAI/edit?usp=sharing',
            'er_diagram'       => 'https://bevel-street-08d.notion.site/ER-38005bbda9f280d29c68ecec180547c9?pvs=143',
            'db_definition'    => 'https://docs.google.com/spreadsheets/d/10j5T6Ro7UohA8_riikzBmaP92VKGd0Jz5fbldh1ApVI/edit?usp=sharing',
        ];
    }

    /**
     * タスクの完了処理
     */
    public function completeTask($id)
    {
        $user = Auth::user();
        $task = IntermediateTask::findOrFail($id);

        // 担当中かつ、自分が担当者の場合のみ完了できるようにガード
        if ($task->status === 'assigned' && $task->completedUsers->contains($user->id)) {
            // DBのタスクステータスを「完了」に変更
            $task->update(['status' => 'completed']);
            
            // 中間テーブルの完了日時を更新
            $user->completedIntermediateTasks()->updateExistingPivot($id, ['completed_at' => now()]);
        }

        return redirect()->route('courses.intermediate.phase', ['phase' => $task->phase])
            ->with('success', 'タスクを完了にしました！');
    }

    /**
     * タスク作成画面
     */
    public function preview(Request $request)
    {
        $data = $request->validate(['description' => 'nullable|string|max:100000']);
        return response()->json(['html' => \App\Support\TaskMarkdown::render($data['description'] ?? '')]);
    }

    public function create()
    {
        $phases = IntermediateTask::phaseLabels();
        $assignees = Auth::user()->isAdmin()
            ? \App\Models\User::orderBy('name')->get(['id', 'name', 'email'])
            : collect([Auth::user()]);
        return view('courses.intermediate.create', compact('phases', 'assignees'));
    }

    /**
     * タスクの保存処理（受講生は本人担当のみ）
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'assignee_id' => ['required', 'integer', \Illuminate\Validation\Rule::exists('users', 'id'),
                \Illuminate\Validation\Rule::in(Auth::user()->isAdmin() ? \App\Models\User::pluck('id')->all() : [Auth::id()])],
            'phase'       => ['required', \Illuminate\Validation\Rule::in(array_keys(IntermediateTask::phaseLabels()))],
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:100000',
            'images' => 'nullable|array|max:10',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'description_format' => 'nullable|in:plain,markdown',
        ]);

        $paths = [];
        try {
            foreach ($request->file('images', []) as $image) {
                $paths[] = $image->store('intermediate_tasks', 'public');
            }
            \Illuminate\Support\Facades\DB::transaction(function () use ($request, $validated, $paths) {
                $task = IntermediateTask::create([
                    'phase' => $validated['phase'],
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'description_format' => $validated['description_format'] ?? 'plain',
                    'image_paths' => $paths,
                    'image_path' => $paths[0] ?? null,
                    'status' => 'assigned',
                    'user_id' => Auth::id(),
                ]);
                $task->completedUsers()->attach($validated['assignee_id']);
            });
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($paths);
            throw $exception;
        }

        return redirect()->route('courses.intermediate.index')
            ->with('success', '新しい実務タスクを作成しました。');
    }

    /**
     * タスク編集画面
     */
    public function edit($id)
    {
        $task = IntermediateTask::findOrFail($id);
        
        // 管理者以上のみ編集できる
        if (!Auth::user()->isAdmin()) {
            abort(403, 'このタスクの編集権限がありません。');
        }

        $phases = IntermediateTask::phaseLabels();
        return view('courses.intermediate.edit', compact('task', 'phases'));
    }

    /**
     * タスク更新処理
     */
    public function update(Request $request, $id)
    {
        $task = IntermediateTask::findOrFail($id);

        if (!Auth::user()->isAdmin()) {
            abort(403, 'このタスクの更新権限がありません。');
        }

        $request->validate([
            'phase'       => ['required', \Illuminate\Validation\Rule::in(array_keys(IntermediateTask::phaseLabels()))],
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:100000',
            'images' => 'nullable|array|max:10',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'description_format' => 'nullable|in:plain,markdown',
        ]);

        $request->validate(['remove_images' => 'nullable|array', 'remove_images.*' => ['string', \Illuminate\Validation\Rule::in($task->attachmentPaths())]]);
        $removed = $request->input('remove_images', []);
        $retained = array_values(array_diff($task->attachmentPaths(), $removed));
        if (count($retained) + count($request->file('images', [])) > 10) {
            throw \Illuminate\Validation\ValidationException::withMessages(['images' => '画像は合計10枚まで登録できます。']);
        }
        $added = [];
        try {
            foreach ($request->file('images', []) as $image) {
                $added[] = $image->store('intermediate_tasks', 'public');
            }
            $paths = array_merge($retained, $added);
            $task->update([
                'phase' => $request->phase,
                'title' => $request->title,
                'description' => $request->description,
                'description_format' => $request->input('description_format', $task->description_format),
                'image_paths' => $paths,
                'image_path' => $paths[0] ?? null,
            ]);
        } catch (\Throwable $exception) {
            Storage::disk('public')->delete($added);
            throw $exception;
        }
        Storage::disk('public')->delete($removed);

        return redirect()->route('courses.intermediate.phase', ['phase' => $task->phase])
            ->with('success', 'タスクを更新しました。');
    }

    /**
     * タスク削除処理
     */
    public function destroy($id)
    {
        $task = IntermediateTask::findOrFail($id);

        if (!Auth::user()->isAdmin()) {
            abort(403, 'このタスクの削除権限がありません。');
        }

        Storage::disk('public')->delete($task->attachmentPaths());

        $phase = $task->phase;
        $task->delete();

        return redirect()->route('courses.intermediate.phase', ['phase' => $phase])
            ->with('success', 'タスクを削除しました。');
    }
}