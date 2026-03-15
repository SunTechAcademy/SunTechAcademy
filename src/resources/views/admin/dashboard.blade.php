<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            管理者ダッシュボード
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    ようこそ、{{ Auth::guard('admin')->user()->name }} さん (管理者権限)

                    <hr class="my-6">

                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">ユーザー管理</h3>
                        <a href="{{ route('register') }}" 
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            ＋ 新規ユーザーアカウント作成
                        </a>
                        <p class="mt-2 text-sm text-gray-600">新しい受講生のアカウントをこちらから発行できます。</p>
                    </div>

                    <hr class="my-6">
                    
                    <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
                        @csrf
                        <x-danger-button>ログアウト</x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>