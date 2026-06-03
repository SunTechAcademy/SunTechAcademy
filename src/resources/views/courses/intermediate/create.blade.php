<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('中級実務タスクの新規起票') }}
            </h2>
            <a href="{{ route('courses.intermediate.index') }}" class="text-sm font-bold text-gray-600 hover:text-gray-900">
                キャンセル
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-8 rounded-xl border border-gray-200 shadow-sm">
                <form action="{{ route('courses.intermediate.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="phase" class="block text-sm font-bold text-gray-700 mb-2">対応フェーズ（大項目）</label>
                        <select name="phase" id="phase" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm" required>
                            <option value="">-- フェーズを選択してください --</option>
                            @foreach($phases as $key => $label)
                                <option value="{{ $key }}" {{ old('phase') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-2">実務タスク名</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="例: ECサイト決済モジュールの基本設計資料作成" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm" required>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-bold text-gray-700 mb-2">詳細仕様・指示用テキスト（文言）</label>
                        <textarea name="description" id="description" rows="8" placeholder="要件定義書、設計書の内容、または実装上の制約・テスト手順などを詳しく記述してください。" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm" required>{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-bold text-gray-700 mb-2">設計図・指示書イメージ画像 (任意)</label>
                        <input type="file" name="image" id="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                        <p class="text-xs text-gray-400 mt-1">※ jpeg, png, gif等 (最大 2MB)</p>
                    </div>

                    <div class="pt-4 border-t flex justify-end">
                        <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2.5 px-6 rounded-md shadow text-sm transition">
                            実務タスクを保存して公開
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>