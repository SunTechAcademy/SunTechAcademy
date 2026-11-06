<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-favicon />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'SunTechAcademy') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
            }
        </script>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex items-center min-h-screen flex-col">
        <x-public-header />
        <main id="courses" class="flex-grow flex flex-col items-center px-4 sm:px-6 pb-12 w-full max-w-7xl">
            <div class="w-full">
                <div class="text-center mb-10">
                    <p class="text-xs font-bold tracking-widest mb-3" style="color: #747eae;">YOUR LEARNING JOURNEY</p>
                    <h1 class="text-3xl font-bold mb-4 dark:text-white">なりたい自分へ、ここから。</h1>
                    <p class="text-sm text-gray-500 leading-7">基礎から実践、そしてリーダーへ。成長につながる3つのコース。</p>
                </div>
                <x-course-cards :introduction="true" />
            </div>
        </main>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
        <footer class="w-full text-center px-4 pb-8 text-xs text-gray-500">
            <a href="{{ route('referral') }}" class="hover:text-indigo-600 underline underline-offset-4">お友達紹介キャンペーン</a>
        </footer>
        <x-referral-float />
    </body>
</html>
