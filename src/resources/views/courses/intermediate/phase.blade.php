<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $phaseLabel }} {{ __('タスク一覧') }}
            </h2>
            <a href="{{ route('courses.intermediate.index') }}" class="text-sm font-bold text-gray-600 hover:text-gray-900">
                ← フェーズ一覧に戻る
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($tasks->isEmpty())
                <div class="bg-white p-12 text-center rounded-lg border border-gray-200 shadow-sm">
                    <p class="text-gray-500">現在、このフェーズに登録されている実務タスクはありません。</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($tasks as $task)
                        @php
                            $isCompleted = ($task->status === 'completed');
                        @endphp
                        <a href="{{ route('courses.intermediate.show_task', ['id' => $task->id]) }}" class="flex flex-col bg-white border {{ $isCompleted ? 'border-green-300 bg-green-50/10' : 'border-gray-200' }} rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden group relative">
                            
                            @if($isCompleted)
                                <div class="absolute top-2 right-2 bg-green-600 text-white font-bold text-xxs px-2 py-0.5 rounded-full z-10 shadow">
                                    ✓ 完了済み
                                </div>
                            @endif

                            @if($task->image_path)
                                <!-- <img src="{{ asset('storage/' . $task->image_path) }}" class="w-full h-40 object-cover"> -->
                                 <img src="/storage/{{ $task->image_path }}" class="w-full h-40 object-cover">
                            @else
                                <div class="w-full h-40 bg-gray-100 flex items-center justify-center border-b text-gray-400 font-mono text-sm">
                                    No Assignment Image
                                </div>
                            @endif

                            <div class="p-5 flex flex-col flex-grow">
                                <h4 class="font-bold text-base text-gray-900 mb-2 group-hover:text-orange-600 transition-colors">
                                    {{ $task->title }}
                                </h4>
                                <p class="text-xs text-gray-600 line-clamp-3 flex-grow leading-relaxed">
                                    {{ Str::limit($task->description, 90, '...') }}
                                </p>
                                <div class="mt-4 pt-3 border-t border-gray-100 flex justify-between items-center text-xs font-bold">
                                    <span class="text-gray-400">{{ $task->created_at->format('Y/m/d') }}</span>
                                    <span class="text-orange-500 group-hover:underline">詳細要件・着手 →</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>