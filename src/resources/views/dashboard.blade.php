<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('マイコース') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-lg font-bold mb-6 text-gray-700">受講中のコースを選択してください</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('courses.beginner') }}" class="flex flex-col bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all overflow-hidden group">
                    <img src="https://placehold.jp/24/3b82f6/ffffff/400x200.png?text=Beginner+Course" class="w-full h-32 object-cover">
                    <div class="p-5">
                        <h4 class="font-bold text-lg mb-2 group-hover:text-blue-600">【初級】エンジニア基礎</h4>
                        <p class="text-sm text-gray-600">プログラミングの基礎からWeb開発の土台を固めます。</p>
                        <div class="mt-4 text-xs font-bold text-blue-500">学習を始める →</div>
                    </div>
                </a>

                <a href="{{ route('courses.intermediate.index') }}" class="flex flex-col bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all overflow-hidden group">
                    <img src="https://placehold.jp/24/f97316/ffffff/400x200.png?text=Intermediate+Course" class="w-full h-32 object-cover">
                    <div class="p-5">
                        <h4 class="font-bold text-lg mb-2 group-hover:text-orange-600">【中級】実務スキル</h4>
                        <p class="text-sm text-gray-600">実際に実務経験となるコースになります。開発現場に入るためには必須の業務スキルになります。</p>
                        <div class="mt-4 text-xs font-bold text-orange-500">学習を始める →</div>
                    </div>
                </a>

                <a href="{{ route('courses.advanced') }}" class="flex flex-col bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all overflow-hidden group">
                    <img src="https://placehold.jp/24/a855f7/ffffff/400x200.png?text=Advanced+Course" class="w-full h-32 object-cover">
                    <div class="p-5">
                        <h4 class="font-bold text-lg mb-2 group-hover:text-purple-600">【上級】PM、PMO、PLレベル</h4>
                        <p class="text-sm text-gray-600">実際に実務経験のPM、PMO、PLレベルのスキルを習得します。</p>
                        <div class="mt-4 text-xs font-bold text-purple-500">学習を始める →</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
