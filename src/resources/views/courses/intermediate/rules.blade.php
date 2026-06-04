<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('中級コースの運用ルール') }}
            </h2>
            <a href="{{ route('courses.intermediate.index') }}" class="text-sm font-bold text-gray-600 hover:text-gray-900">
                ← 中級トップに戻る
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200 space-y-6">
                <h3 class="text-lg font-bold text-gray-800 border-b pb-2">📜 運用ガイドライン</h3>
                
                <p class="text-sm text-gray-600 leading-relaxed">
                    中級コースにおける開発・運用の取り決めです。
                </p>
                
                <ul class="list-disc pl-5 space-y-3 text-sm text-gray-700">
                    <li><strong>環境構築の徹底:</strong> 事前にGitHubのREADMEに従い、ローカル環境を構築してください。</li>
                    <li><strong>タスクの管理:</strong> 自分が作成した実務タスクのみ、編集・削除を行うことができます。</li>
                    <li><strong>完了定義:</strong> 各タスクの要求を満たしたら、「完了状態にする」ボタンを押してください。</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>