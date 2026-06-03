<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('【中級】実務スキル習得コース') }}
            </h2>
            <a href="{{ route('courses.intermediate.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded text-sm transition shadow">
                + タスク新規作成
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                <p class="text-gray-700 leading-relaxed text-base">
                    実際に実務経験となるコースになります。開発現場に入るためには必須の業務スキルになります。
                </p>
            </div>

            <div class="bg-gradient-to-r from-orange-50 to-amber-50 p-6 rounded-xl border border-orange-200 shadow-sm">
                <h3 class="text-md font-bold text-orange-800 mb-4 flex items-center">
                    実務タスク完了ノルマ状況
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach(['implementation', 'operation'] as $nPhase)
                        @php
                            $current = $completedCounts[$nPhase] ?? 0;
                            $quota = $norms[$nPhase];
                            $percent = min(100, ($current / $quota) * 100);
                        @endphp
                        <div class="bg-white p-4 rounded-lg border border-orange-100 shadow-inner">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-gray-800 text-sm">{{ $phases[$nPhase] }}</span>
                                <span class="text-xs font-bold text-gray-600">
                                    完了: <span class="text-base text-orange-600">{{ $current }}</span> / {{ $quota }} 件
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-orange-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                            </div>
                            @if($current >= $quota)
                                <p class="text-xs text-green-600 font-bold mt-1 text-right">✓ ノルマ達成！</p>
                            @else
                                <p class="text-xs text-gray-400 mt-1 text-right">あと {{ $quota - $current }} 件</p>
                            @endif
                        </div>
                    @endforeach
                </div>
                <p class="text-xs text-gray-500 mt-4 leading-relaxed">
                    ※ 要件定義、基本設計、詳細設計、単体テスト、結合テスト、総合テストは、実装構築および保守運用の開発フロー内で全て横断的に経験するため、固有のノルマ数は設定されていません。
                </p>
            </div>

            <div>
                <h3 class="text-lg font-bold text-gray-700 mb-6">業務フェーズを選択してください</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($phases as $key => $label)
                        @php
                            $totalTasks = $taskCounts[$key] ?? 0;
                            $userCompleted = $completedCounts[$key] ?? 0;
                        @endphp
                        <a href="{{ route('courses.intermediate.phase', ['phase' => $key]) }}" class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md hover:border-orange-400 transition-all p-5 group">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-bold text-base text-gray-900 group-hover:text-orange-600 transition-colors">
                                    {{ $label }}
                                </h4>
                                <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold">
                                    {{ $userCompleted }} / {{ $totalTasks }} 完了
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 leading-relaxed flex-grow mt-1">
                                <span class="font-semibold text-gray-700">定義:</span> {{ $definitions[$key] }}
                            </p>
                            <div class="mt-4 pt-3 border-t border-gray-100 text-right text-xs font-bold text-orange-500 group-hover:translate-x-1 transition-transform">
                                タスク一覧を見る →
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>