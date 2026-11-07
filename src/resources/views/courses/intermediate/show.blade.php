<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $phases[$task->phase] }}：{{ $task->title }}
            </h2>
            <a href="{{ route('courses.intermediate.phase', ['phase' => $task->phase]) }}" class="text-sm font-bold text-gray-600 hover:text-gray-900">
                ← タスク一覧へ戻る
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                
                @if(count($task->attachmentPaths()))
                    <div class="grid grid-cols-2 gap-4 p-4 bg-gray-50 border-b">
                        @foreach($task->attachmentPaths() as $path)
                            <a href="{{ Storage::disk('public')->url($path) }}" target="_blank" rel="noopener noreferrer"><img src="{{ Storage::disk('public')->url($path) }}" alt="参考画像 {{ $loop->iteration }}" class="w-full h-48 object-contain rounded" loading="lazy"></a>
                        @endforeach
                    </div>
                @endif

                <div class="p-8 space-y-6">
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 bg-orange-100 text-orange-800 text-xs font-bold rounded-full">
                            {{ $phases[$task->phase] }}フェーズ
                        </span>
                        
                        @if($isCompleted)
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full">
                                ✓ 完了（担当者: {{ $task->completedUsers->first()->name ?? '不明' }}）
                            </span>
                        @elseif($isAssigned)
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-bold rounded-full">
                                ⏳ 担当中（担当者: {{ $task->completedUsers->first()->name ?? '不明' }}）
                            </span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full">
                                💤 未対応（担当者なし）
                            </span>
                        @endif
                        
                        <span class="text-xs text-gray-500 pl-2">
                            作成者: <strong class="text-gray-700">{{ $task->user->name ?? '不明' }}</strong>
                        </span>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-3">📋 実務要求・作業内容詳細</h3>
                        <x-task-content-styles />
                        @if($task->description_format === 'markdown')
                            <div class="task-rich-text">{!! \App\Support\TaskMarkdown::render($task->description) !!}</div>
                        @else
                            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $task->description }}</p>
                        @endif
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-between items-center">
                        <div>
                            @can('manage-tasks')
                                <a href="{{ route('courses.intermediate.edit_task', ['id' => $task->id]) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-xs mr-2 transition shadow-sm">
                                    編集
                                </a>
                                <form action="{{ route('courses.intermediate.destroy_task', ['id' => $task->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('本当にこのタスクを削除しますか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-xs transition shadow-sm">
                                        削除
                                    </button>
                                </form>
                            @endcan
                        </div>
                        <div>
                            @if($task->status === 'incomplete')
                                <form action="{{ route('courses.intermediate.assign_task', ['id' => $task->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-lg shadow-md hover:shadow transition-all text-sm">
                                        このタスクを担当する
                                    </button>
                                </form>
                            @elseif($task->status === 'assigned')
                                @if($isMyTask)
                                    <form action="{{ route('courses.intermediate.complete_task', ['id' => $task->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow-md hover:shadow transition-all text-sm">
                                            この実務タスクを完了状態にする
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="bg-gray-200 text-gray-400 font-bold py-3 px-8 rounded-lg text-sm cursor-not-allowed">
                                        他のユーザーが担当中です
                                    </button>
                                @endif
                            @else
                                <button disabled class="bg-gray-200 text-gray-400 font-bold py-3 px-8 rounded-lg text-sm cursor-not-allowed">
                                    完了済みタスクです
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>