<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">マイコース</h2>
    </x-slot>

    <div class="py-10 sm:py-14" style="background: radial-gradient(ellipse at top left, #efeffb, transparent 55%), #f7f8fc;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-9 sm:mb-12">
                <p class="text-xs font-bold tracking-widest mb-3" style="color: #747eae;">YOUR NEXT STEP</p>
                <h2 class="text-2xl sm:text-3xl font-bold tracking-tight mb-4" style="color: #30364b;">今日の一歩が、未来の自信に。</h2>
                <p class="text-sm leading-7" style="color: #737b8c;">基礎をつくる。実践で磨く。チームを導く。<br class="sm:hidden">あなたのペースで、次のステージへ。</p>
            </div>
            <x-course-cards />
            <p class="text-center text-xs mt-8 leading-6" style="color: #858c9c;">少しずつでも、大丈夫。ひとつの「できた」から始めよう。</p>
        </div>
    </div>
</x-app-layout>
