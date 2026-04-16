<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lesson {{ $lesson->sort_order ?? 4 }}: {{ $lesson->title ?? 'HTMLチュートリアル' }}
            </h2>
            {{-- エラー箇所を修正：courses.index → courses.beginner --}}
            <a href="{{ route('courses.beginner') }}" class="text-sm text-gray-500 hover:text-gray-700">← コース一覧へ戻る</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-12">
            @if(isset($lesson) && $lesson->chapters->count() > 0)
                @foreach($lesson->chapters as $chapter)
                    {{-- 完了状態の判定（コントローラーから渡されている想定） --}}
                    @php 
                        $completedChapterIds = $completedChapterIds ?? [];
                        $isDone = in_array($chapter->id, $completedChapterIds); 
                    @endphp

                    <div id="chapter-{{ $chapter->id }}" class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-100 scroll-mt-24">
                        <div class="p-8 border-b">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="bg-[#6A73A6] text-white text-xs px-2 py-1 rounded">Chapter {{ $chapter->sort_order }}</span>
                                <h3 class="text-2xl font-bold text-gray-800">{{ $chapter->title }}</h3>
                            </div>
                            <div class="prose max-w-none text-gray-700 leading-relaxed">
                                {!! $chapter->content !!}
                            </div>
                        </div>

                        {{-- チャプター完了ボタン --}}
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
            @else
                <div class="bg-white p-12 rounded-lg shadow text-center">
                    <p class="text-gray-500">チャプターが登録されていません。</p>
                </div>
            @endif

            {{-- レッスン完了セクション --}}
            <div class="mt-16 pb-12 text-center border-t border-gray-200 pt-12">
                <div class="mb-6">
                    <span class="inline-block p-3 rounded-full bg-green-100 text-green-600 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </span>
                    <p class="text-xl font-bold text-gray-800">お疲れ様でした！このレッスンはここまでです。</p>
                </div>
                <a href="{{ route('courses.beginner') }}" class="inline-flex items-center gap-2 px-10 py-4 bg-gray-800 text-white font-bold rounded-xl shadow-lg hover:bg-gray-900 transition-all active:scale-95">
                    コース一覧へ戻る
                </a>
            </div>
        </div>
    </div>
</x-app-layout>