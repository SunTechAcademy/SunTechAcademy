<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
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
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            <div class="flex-shrink-0">
                <a href="/">
                    <img src="{{ asset('images/SunTechAcademy.png') }}" alt="SunTechAcademy" class="h-12 w-auto">
                </a>
            </div>

            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            ダッシュボード
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            ログイン
                        </a>

                        <!-- @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                新規登録
                            </a>
                        @endif -->
                    @endauth
                </nav>
            @endif
        </header>
        <main class="flex-grow flex flex-col items-center px-6 pb-12 w-full max-w-7xl">
            <div class="w-full">
                <h1 class="text-3xl font-bold text-center mb-16 dark:text-white">コース紹介</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full items-stretch">
                    
                    <a href="{{ url('/dashboard') }}" class="flex flex-col bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] p-6 rounded-lg shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <img src="https://placehold.jp/24/3b82f6/ffffff/400x200.png?text=Beginner+Course" alt="初級" class="w-full h-40 object-cover">
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="inline-block self-start px-3 py-1 mb-4 text-xs font-semibold tracking-wider text-blue-600 uppercase bg-blue-100 rounded-full">初期フェーズ 3ヶ月〜</div>
                            <h2 class="text-xl font-bold mb-2 dark:text-white">【初級】エンジニア基礎教育</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">目的：未経験者がエンジニアとして案件参画できる最低限のスキルを習得する。</p>
                            <div class="space-y-3 text-sm dark:text-gray-300 flex-grow">
                                <h3 class="font-bold border-b pb-1">主な学習内容</h3>
                                <ul class="list-disc list-inside space-y-1">
                                    <li>プログラミング基礎</li>
                                    <li>Web開発基礎</li>
                                    <li>フレームワーク基礎</li>
                                    <li>開発ツール</li>
                                </ul>
                            </div>
                        </div>
                    </a>

                    <a href="{{ url('/dashboard') }}" class="flex flex-col bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] p-6 rounded-lg shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <img src="https://placehold.jp/24/f97316/ffffff/400x200.png?text=Intermediate+Course" alt="中級" class="w-full h-40 object-cover">
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="inline-block self-start px-3 py-1 mb-4 text-xs font-semibold tracking-wider text-orange-600 uppercase bg-orange-100 rounded-full">実務型 9ヶ月〜</div>
                            <h2 class="text-xl font-bold mb-2 dark:text-white">【中級】実務スキル習得</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">目的：現場で通用する実務能力を身につける。</p>
                            <div class="space-y-3 text-sm dark:text-gray-300 flex-grow">
                                <h3 class="font-bold border-b pb-1">内容</h3>
                                <p>自社サービス（サンテックアカデミー）やフリーランス案件サイトの保守・改修・運用・新規開発・要件定義・基本設計・詳細設計を担当。</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ url('/dashboard') }}" class="flex flex-col bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] p-6 rounded-lg shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <img src="https://placehold.jp/24/a855f7/ffffff/400x200.png?text=Advanced+Course" alt="上級" class="w-full h-40 object-cover">
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="inline-block self-start px-3 py-1 mb-4 text-xs font-semibold tracking-wider text-purple-600 uppercase bg-purple-100 rounded-full">プロレベル 1年〜</div>
                            <h2 class="text-xl font-bold mb-2 dark:text-white">【上級】PM、PMO、PLレベル</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">目的：技術で課題を解決できるエンジニアを育成する。</p>
                            <div class="space-y-3 text-sm dark:text-gray-300 flex-grow">
                                <h3 class="font-bold border-b pb-1">内容</h3>
                                <p>実際に実務経験のPM、PMO、PLレベルのスキルを習得します。</p>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </main>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
