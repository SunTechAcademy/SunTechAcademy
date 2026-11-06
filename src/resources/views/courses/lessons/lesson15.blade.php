<x-app-layout>
    <x-slot name="header">
        <div class="lesson-breadcrumb"><a href="{{ route('courses.beginner') }}">初級 · エンジニア基礎</a><span aria-hidden="true">/</span><span>Lesson {{ $lesson->sort_order }}</span></div>
    </x-slot>

    <div class="lesson-page">
        <x-lesson-navigation :lesson="$lesson" :completed-chapter-ids="$completedChapterIds ?? []">
            @if(isset($lesson) && $lesson->chapters->count() > 0)
                @foreach($lesson->chapters as $chapter)
                    {{-- 完了状態の判定 --}}
                    @php
                        $completedChapterIds = $completedChapterIds ?? [];
                        $isDone = in_array($chapter->id, $completedChapterIds);
                    @endphp

                    <div id="chapter-{{ $chapter->id }}" class="lesson-chapter">
                        <div class="lesson-chapter-body">
                            <div class="lesson-chapter-heading">
                                <span class="lesson-chapter-badge">Chapter {{ $chapter->sort_order }}</span>
                                <h3 class="lesson-chapter-title">{{ $chapter->title }}</h3>
                            </div>

                            <div class="lesson-prose">
                                {!! $chapter->content !!}
                            </div>
                        </div>

                        {{-- チャプター完了ボタン --}}
                        <div class="lesson-chapter-actions">
                            <form action="{{ route('chapters.complete', $chapter->id) }}" method="POST">
                                @csrf
                                @if($isDone)
                                    <x-chapter-completed-button />
                                @else
                                    <button type="submit" class="lesson-complete-action"><span aria-hidden="true">✓</span> このチャプターを完了する</button>
                                @endif
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white p-12 rounded-2xl shadow text-center border border-dashed border-gray-300">
                    <p class="text-gray-500">チャプターがまだ登録されていません。現在準備中です。</p>
                </div>
            @endif

            {{-- レッスン完了セクション --}}
            <div class="lesson-finish">
                <div class="mb-8">
                    <div class="inline-block p-4 rounded-full bg-green-100 text-green-600 mb-4 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="lesson-chapter-title">お疲れ様でした！</p>
                    <p class="text-lg text-gray-800">Lesson {{ $lesson->sort_order ?? 15 }} の全チャプターを学習しました。</p>
                    <p class="text-gray-500 mt-2">インターネットの深淵に一歩踏み込みましたね。次のステップへ進みましょう。</p>
                </div>
                <a href="{{ route('lessons.show', 16) }}" class="lesson-next-action group">
                    次のレッスンへ
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </x-lesson-navigation>
    </div>
</x-app-layout>