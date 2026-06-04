<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                【初級】エンジニア基礎教育
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700">← コース一覧へ戻る</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            
            <div class="text-center px-4 py-2 w-full">
                <p class="text-sm text-gray-500 mb-1">連続ログイン日数</p>
                <p class="text-2xl font-bold text-gray-800"><span class="text-blue-600">{{ $streak }}</span> 日</p>
            </div>
            <div class="text-center px-4 py-2 w-full">
                <p class="text-sm text-gray-500 mb-1">カリキュラム進捗</p>
                <p class="text-2xl font-bold text-gray-800"><span class="text-green-500">{{ number_format($progress, 2) }}</span> %</p>
            </div>

            @foreach($lessons as $lesson)
                <div class="mb-10 bg-white border shadow-sm">
                    <div class="bg-[#6A73A6] text-white p-4 flex justify-between items-start">
                        <div>
                            <p class="text-sm font-semibold tracking-wider mb-1">Lesson {{ $lesson->sort_order }}</p>
                            <h3 class="text-xl font-bold">{{ $lesson->title }}</h3>
                        </div>
                        <div class="text-xs flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            目安{{ $lesson->estimated_time / 60 }}時間
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 bg-gray-50">
                        @foreach($lesson->chapters as $chapter)
                            <a href="{{ route('lessons.show', $lesson->id) }}" class="flex border-b border-gray-200 hover:bg-gray-100 transition">
                                <div class="p-4 flex-grow bg-white text-sm">
                                    {{ $chapter->title }}
                                </div>
                                <div class="w-16 flex items-center justify-center {{ $chapter->is_completed ? 'bg-[#4CAF50]' : 'bg-gray-300' }} text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>