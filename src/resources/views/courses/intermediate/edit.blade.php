<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('タスクの編集') }}
            </h2>
            <a href="{{ route('courses.intermediate.show_task', ['id' => $task->id]) }}" class="text-sm font-bold text-gray-600 hover:text-gray-900">
                ← 詳細に戻る
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
                <form action="{{ route('courses.intermediate.update_task', ['id' => $task->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">業務フェーズ</label>
                        <select name="phase" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm">
                            @foreach($phases as $key => $label)
                                <option value="{{ $key }}" {{ $task->phase === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">タスクタイトル</label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">実務要求・作業内容詳細</label>
                        <textarea name="description" rows="6" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm" required>{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">課題イメージ画像（任意）</label>
                        @if($task->image_path)
                            <div class="mb-2">
                                <img src="/storage/{{ $task->image_path }}" class="h-32 w-auto object-cover rounded border">
                                <p class="text-xs text-gray-400 mt-1">※新しい画像をアップロードすると上書きされます</p>
                            </div>
                        @endif
                        <input type="file" name="image" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2.5 px-6 rounded-lg text-sm transition shadow">
                            変更を保存する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>