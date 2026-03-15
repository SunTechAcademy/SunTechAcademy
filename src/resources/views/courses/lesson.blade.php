<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lesson 19: オリジナルWebサービスの構築
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <div x-data="{ completed: true }" class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="p-8 border-b">
                    <h3 class="text-2xl font-bold border-l-4 border-[#6A73A6] pl-4 mb-6">1. 学習の目標</h3>
                    <div class="prose max-w-none text-gray-700">
                        <p>このレッスンでは、ゼロから自分だけのWebサービスを作る流れを学びます。</p>
                        <p>要件定義からデータベース設計、実装、デプロイまでを一気通貫で行います。</p>
                        </div>
                </div>
                
                <div class="bg-gray-50 p-6 flex justify-center items-center">
                    <button 
                        @click="completed = true" 
                        :class="completed ? 'bg-green-500 cursor-default' : 'bg-blue-600 hover:bg-blue-700'"
                        class="px-8 py-3 rounded-full text-white font-bold transition-colors duration-300 flex items-center gap-2"
                        :disabled="completed"
                    >
                        <svg x-show="completed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        <span x-text="completed ? 'このチャプターを完了しました' : 'このチャプターを完了する'"></span>
                    </button>
                </div>
            </div>

            <div x-data="{ completed: false }" class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="p-8 border-b">
                    <h3 class="text-2xl font-bold border-l-4 border-[#6A73A6] pl-4 mb-6">2. オリジナルサービス制作の流れ</h3>
                    <div class="prose max-w-none text-gray-700">
                        <p>まずはアイデア出しから始めましょう...</p>
                        <br><br><br><br><br>
                        <p>（長いコンテンツ）</p>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-6 flex justify-center items-center">
                    <button 
                        @click="completed = true" 
                        :class="completed ? 'bg-green-500 cursor-default' : 'bg-blue-600 hover:bg-blue-700'"
                        class="px-8 py-3 rounded-full text-white font-bold transition-colors duration-300 flex items-center gap-2"
                        :disabled="completed"
                    >
                        <svg x-show="completed" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        <span x-text="completed ? 'このチャプターを完了しました' : 'このチャプターを完了する'"></span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>