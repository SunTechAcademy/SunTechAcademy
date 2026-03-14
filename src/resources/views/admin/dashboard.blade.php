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
                    
                    <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
                        @csrf
                        <x-danger-button>ログアウト</x-danger-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>