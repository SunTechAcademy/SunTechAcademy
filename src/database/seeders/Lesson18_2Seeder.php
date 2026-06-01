<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson18_2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 対象のLessonを取得
        $lesson = Lesson::where('title', 'Laravelを用いたWebアプリケーション開発：応用')->first();

        if (!$lesson) {
            return;
        }

        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'sort_order' => 2,
            ],
            [
                'title' => '今回作成するWebアプリケーション',
                'is_assignment' => 0,
                'content' => <<<'EOF'
<div class="space-y-12 pb-20 text-left text-gray-700">

    <section>
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4 mb-6">今回作成するWebアプリケーション</h2>
        <div class="prose max-w-none text-sm leading-relaxed space-y-4">
            <p>
                今回作成するWebアプリケーションはX（旧Twitter）のクローンになります。名前は<strong>Microposts</strong>にします。
            </p>
        </div>
    </section>

    <section class="space-y-6">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">機能一覧</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        ユーザ登録／認証
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        ツイート（Micropost）の一覧表示
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        フォロー／フォロワー機能
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                        <span class="font-bold text-orange-600">お気に入り機能（提出課題）</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="space-y-8">
        <h3 class="text-xl font-bold text-gray-800 border-b pb-2">（参考）画面イメージ</h3>
        
        <div class="grid grid-cols-1 gap-12">
            <div class="space-y-4">
                <p class="font-bold text-gray-600 flex items-center gap-2">
                    <span class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded">1</span> トップページ（ログイン前）
                </p>
                <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner">
                    <img src="/images/Lesson18-1.png" alt="トップページ（ログイン前）" class="max-w-2xl w-full h-auto shadow-sm rounded border mx-auto">
                </div>
            </div>

            <div class="space-y-4">
                <p class="font-bold text-gray-600 flex items-center gap-2">
                    <span class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded">2</span> ユーザ登録ページ
                </p>
                <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner">
                    <img src="/images/Lesson18-2.png" alt="ユーザ登録ページ" class="max-w-2xl w-full h-auto shadow-sm rounded border mx-auto">
                </div>
            </div>

            <div class="space-y-4">
                <p class="font-bold text-gray-600 flex items-center gap-2">
                    <span class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded">3</span> ログインページ
                </p>
                <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner">
                    <img src="/images/Lesson18-3.png" alt="ログインページ" class="max-w-2xl w-full h-auto shadow-sm rounded border mx-auto">
                </div>
            </div>

            <div class="space-y-4">
                <p class="font-bold text-gray-600 flex items-center gap-2">
                    <span class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded">4</span> トップページ（ログイン後）
                </p>
                <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner">
                    <img src="/images/Lesson18-4.png" alt="トップページ（ログイン後）" class="max-w-2xl w-full h-auto shadow-sm rounded border mx-auto">
                </div>
            </div>

            <div class="space-y-4">
                <p class="font-bold text-gray-600 flex items-center gap-2">
                    <span class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded">5</span> ユーザ一覧ページ
                </p>
                <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner">
                    <img src="/images/Lesson18-5.png" alt="ユーザ一覧ページ" class="max-w-2xl w-full h-auto shadow-sm rounded border mx-auto">
                </div>
            </div>

            <div class="space-y-4">
                <p class="font-bold text-gray-600 flex items-center gap-2">
                    <span class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded">6</span> ユーザ詳細ページ
                </p>
                <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner">
                    <img src="/images/Lesson18-6.png" alt="ユーザ詳細ページ" class="max-w-2xl w-full h-auto shadow-sm rounded border mx-auto">
                </div>
            </div>

            <div class="space-y-4">
                <p class="font-bold text-gray-600 flex items-center gap-2">
                    <span class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded">7</span> 該当ユーザがフォローしているユーザページ
                </p>
                <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner">
                    <img src="/images/Lesson18-7.png" alt="該当ユーザがフォローしているユーザページ" class="max-w-2xl w-full h-auto shadow-sm rounded border mx-auto">
                </div>
            </div>

            <div class="space-y-4">
                <p class="font-bold text-gray-600 flex items-center gap-2">
                    <span class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded">8</span> 該当ユーザをフォローしているユーザページ
                </p>
                <div class="border border-gray-200 rounded-xl p-4 bg-white shadow-inner">
                    <img src="/images/Lesson18-8.png" alt="該当ユーザをフォローしているユーザページ" class="max-w-2xl w-full h-auto shadow-sm rounded border mx-auto">
                </div>
            </div>
        </div>
    </section>

</div>
EOF
            ]
        );
    }
}