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
                    @if($errors->any())<div role="alert" class="text-red-700">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach<p>画像を追加する場合は、ファイルを再選択してください。</p></div>@endif
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">業務フェーズ</label>
                        <select name="phase" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm">
                            @foreach($phases as $key => $label)
                                <option value="{{ $key }}" {{ old('phase', $task->phase) === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">タスクタイトル</label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">実務要求・作業内容詳細</label>
                        <x-task-editor :value="$task->description" :format="$task->description_format" />
                    </div>

                    <x-task-images :paths="$task->attachmentPaths()" />
                    <x-related-task-picker :tasks="$relatedOptions" :selected="$selectedRelated" />

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