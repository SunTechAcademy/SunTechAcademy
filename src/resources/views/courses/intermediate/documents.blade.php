<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('📝 開発ドキュメント・設計書リンク集') }}
            </h2>
            <a href="{{ route('courses.intermediate.index') }}" class="text-sm font-bold text-gray-600 hover:text-gray-900">
                ← 中級トップに戻る
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
                <p class="text-sm text-gray-500 mb-8 font-medium">開発を進める上で必要な各種設計書・仕様書のGoogleスプレッドシートやツールへのリンクです。別タブで開きます。</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ $urls['requirement'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 bg-gray-50 hover:bg-orange-50 border border-gray-200 hover:border-orange-300 rounded-xl font-bold text-gray-700 hover:text-orange-700 transition shadow-sm">
                        <span>📋 1. 要件定義書</span>
                        <span class="text-xs text-gray-400 font-normal">Google Sheets ↗</span>
                    </a>
                    <a href="{{ $urls['basic_design'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 bg-gray-50 hover:bg-orange-50 border border-gray-200 hover:border-orange-300 rounded-xl font-bold text-gray-700 hover:text-orange-700 transition shadow-sm">
                        <span>📐 2. 基本設計書</span>
                        <span class="text-xs text-gray-400 font-normal">Google Sheets ↗</span>
                    </a>
                    <a href="{{ $urls['detail_design'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 bg-gray-50 hover:bg-orange-50 border border-gray-200 hover:border-orange-300 rounded-xl font-bold text-gray-700 hover:text-orange-700 transition shadow-sm">
                        <span>🔍 3. 詳細設計書</span>
                        <span class="text-xs text-gray-400 font-normal">Google Sheets ↗</span>
                    </a>
                    <a href="{{ $urls['unit_test'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 bg-gray-50 hover:bg-orange-50 border border-gray-200 hover:border-orange-300 rounded-xl font-bold text-gray-700 hover:text-orange-700 transition shadow-sm">
                        <span>🧪 4. 単体テスト仕様書</span>
                        <span class="text-xs text-gray-400 font-normal">Google Sheets ↗</span>
                    </a>
                    <a href="{{ $urls['integration_test'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 bg-gray-50 hover:bg-orange-50 border border-gray-200 hover:border-orange-300 rounded-xl font-bold text-gray-700 hover:text-orange-700 transition shadow-sm">
                        <span>🧬 5. 結合テスト仕様書</span>
                        <span class="text-xs text-gray-400 font-normal">Google Sheets ↗</span>
                    </a>
                    <a href="{{ $urls['system_test'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 bg-gray-50 hover:bg-orange-50 border border-gray-200 hover:border-orange-300 rounded-xl font-bold text-gray-700 hover:text-orange-700 transition shadow-sm">
                        <span>🌐 6. 総合テスト仕様書</span>
                        <span class="text-xs text-gray-400 font-normal">Google Sheets ↗</span>
                    </a>
                    <a href="{{ $urls['er_diagram'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 bg-gray-50 hover:bg-orange-50 border border-gray-200 hover:border-orange-300 rounded-xl font-bold text-gray-700 hover:text-orange-700 transition shadow-sm">
                        <span>📊 7. データベースER図</span>
                        <span class="text-xs text-gray-400 font-normal">Notion ↗</span>
                    </a>
                    <a href="{{ $urls['db_definition'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 bg-gray-50 hover:bg-orange-50 border border-gray-200 hover:border-orange-300 rounded-xl font-bold text-gray-700 hover:text-orange-700 transition shadow-sm">
                        <span>🗄️ 8. DB（テーブル）定義書</span>
                        <span class="text-xs text-gray-400 font-normal">Google Sheets ↗</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>