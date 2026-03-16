<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lesson {{ $lesson->sort_order }}: {{ $lesson->title }}
            </h2>
            <a href="{{ route('courses.beginner') }}" class="text-sm text-gray-500 hover:text-gray-700">← コース一覧へ戻る</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-12">
            @foreach($lesson->chapters as $chapter)
                @php $isDone = in_array($chapter->id, $completedChapterIds); @endphp
                <div id="chapter-{{ $chapter->id }}" class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-100 scroll-mt-24">
                    <div class="p-8 border-b">
                        {{-- 章のタイトル --}}
                        <div class="flex items-center gap-3 mb-6">
                            <span class="bg-[#6A73A6] text-white text-xs px-2 py-1 rounded">Chapter {{ $chapter->sort_order }}</span>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $chapter->title }}</h3>
                        </div>

                        {{-- 章の本文 (DBからHTMLとして出力) --}}
                        <div class="prose max-w-none text-gray-700 leading-relaxed">
                            {!! $chapter->content !!}
                        </div>
                    </div>

                    {{-- 完了ボタンエリア --}}
                    <div class="bg-gray-50 p-6 flex justify-center items-center">
                        <form action="{{ route('chapters.complete', $chapter->id) }}" method="POST">
                            @csrf
                            @if($isDone)
                                <button type="submit" class="group px-8 py-3 rounded-full bg-green-500 hover:bg-red-500 text-white font-bold flex items-center gap-2 transition-all shadow-md active:scale-95">
                                    <svg class="w-5 h-5 block group-hover:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    <svg class="w-5 h-5 hidden group-hover:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    <span class="block group-hover:hidden">このチャプターを完了しました</span>
                                    <span class="hidden group-hover:block">完了を取り消す</span>
                                </button>
                            @else
                                <button type="submit" class="px-8 py-3 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-bold transition-all shadow-md hover:shadow-lg active:scale-95">
                                    このチャプターを完了する
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>