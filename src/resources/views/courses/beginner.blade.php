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
            
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8 flex flex-col md:flex-row justify-around items-center divide-y md:divide-y-0 md:divide-x border border-gray-100">
                <div class="text-center px-4 py-2 w-full">
                    <p class="text-sm text-gray-500 mb-1">連続ログイン日数</p>
                    <p class="text-2xl font-bold text-gray-800"><span class="text-blue-600">12</span> 日</p>
                </div>
                <div class="text-center px-4 py-2 w-full">
                    <p class="text-sm text-gray-500 mb-1">カリキュラム進捗</p>
                    <p class="text-2xl font-bold text-gray-800"><span class="text-green-500">33.50</span> %</p>
                </div>
                <div class="text-center px-4 py-2 w-full">
                    <p class="text-sm text-gray-500 mb-1">課題進捗</p>
                    <p class="text-2xl font-bold text-gray-800"><span class="text-orange-500">6</span> / 19</p>
                </div>
            </div>

            <div class="mb-10 bg-white border shadow-sm">
                <div class="bg-[#6A73A6] text-white p-4 flex justify-between items-start">
                    <div>
                        <p class="text-sm font-semibold tracking-wider mb-1">Lesson 19</p>
                        <h3 class="text-xl font-bold">オリジナルWebサービスの構築</h3>
                    </div>
                    <div class="text-xs flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        目安40時間
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 bg-gray-50">
                    <a href="#" class="flex border-b md:border-r md:border-b-0 border-gray-200 hover:bg-gray-100 transition">
                        <div class="p-4 flex-grow bg-white text-sm">1. 学習の目標</div>
                        <div class="w-16 flex items-center justify-center bg-[#4CAF50] text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </a>
                    <a href="#" class="flex border-b md:border-r md:border-b-0 border-gray-200 hover:bg-gray-100 transition">
                        <div class="p-4 flex-grow bg-white text-sm">2. オリジナルサービス制作の流れ</div>
                        <div class="w-16 flex items-center justify-center bg-[#4CAF50] text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </a>
                    <a href="#" class="flex border-b border-gray-200 hover:bg-gray-100 transition">
                        <div class="p-4 flex-grow bg-white text-sm">3. （参考）Cacoo</div>
                        <div class="w-16 flex items-center justify-center bg-gray-300 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>