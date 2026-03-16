<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class Lesson2_1Seeder extends Seeder
{
    public function run(): void
    {
        // 親となるLesson 2を取得（DatabaseSeederで作成済み前提）
        $lesson2 = Lesson::where('title', 'Web開発のために学ぶこと')->first();

        if (!$lesson2) return;

        // Chapter 2: Webアプリケーションと利用者間の通信のしくみ
        Chapter::updateOrCreate(
            [
                'lesson_id' => $lesson2->id,
                'sort_order' => 2 
            ],
            [
                'title' => 'Webアプリケーションと利用者間の通信のしくみ',
                'is_assignment' => 1,
                'content' => '
<div class="space-y-10">
    <div class="space-y-4">
        <p class="text-lg">本コースのゴールへ到達するには、多くの知識が必要です。ここから「どのような知識が必要か」について触れていきますが、先に「どうしてWebページを閲覧できるのか」をテーマに、コンピュータ間の通信について技術的に深掘りします。</p>
    </div>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">1</span>
            コンピュータもお客と店員のように会話する
        </h4>
        <div class="space-y-4 leading-relaxed text-gray-700">
            <p>コンピュータ同士の通信は、お客さんと店員のやり取りに似ています。</p>
            <p>お客さんは店員に要求し、店員はその要求に対して応えます。たとえば飲食店では、お客さんが注文し、店員が料理を渡します。これと同じことがコンピュータの世界でも行われています。</p>
            
            <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-[#6A73A6]">
                <p class="font-bold mb-2 underline">クライアントとサーバのリクエストとレスポンス</p>
                <p>情報を要求する側のコンピュータを<strong>クライアント</strong>と呼び、応答する側のコンピュータを<strong>サーバ</strong>と呼びます。</p>
                <p>そして、情報を要求することを<strong>リクエスト</strong>、それに対して返事をすることを<strong>レスポンス</strong>と呼びます。この通信方式を<strong>クライアント／サーバ モデル</strong>と呼び、コンピュータ通信のほとんどはこの仕組みで成り立っています。</p>
            </div>

            <div class="flex justify-center my-8">
                <img src="/images/Lesson2-4.png" alt="クライアント/サーバモデル" class="max-w-md w-full h-auto shadow-sm rounded border">
            </div>

            <p class="font-bold text-lg border-l-4 border-gray-400 pl-4">クライアント／サーバの役割はソフトウェアで決まる</p>
            <p>実際には、これは<strong>ソフトウェア同士の通信モデル</strong>です。コンピュータ本体はただの箱であり、中で動くソフトウェアが役割を決めます。</p>
            <ul class="list-disc ml-6 space-y-2">
                <li><strong>Webブラウザ（クライアント）:</strong> 「このページが見たい」とリクエストを出すソフトウェア。</li>
                <li><strong>Webサーバ（サーバ）:</strong> リクエストを受け取り、ページをレスポンスとして返すソフトウェア。</li>
            </ul>
            <p>1台のコンピュータの中に両方のソフトウェアを同居させることも可能です。役割を決めるのは「機械」ではなく「ソフトウェア」であると肝に銘じておきましょう。</p>

            <div class="flex justify-center my-8 text-center">
                <div class="p-4 bg-blue-50 rounded border border-blue-100">
                    <img src="/images/Lesson2-5.png" alt="WebブラウザとWebサーバの通信" class="max-w-md w-full h-auto mb-2">
                    <span class="text-xs text-gray-500">WebブラウザとWebサーバの通信（HTTP）</span>
                </div>
            </div>
        </div>
    </section>

    <section class="space-y-4">
        <h4 class="flex items-center gap-2 font-bold text-xl text-[#6A73A6] border-b-2 border-[#6A73A6] pb-2">
            <span class="bg-[#6A73A6] text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">2</span>
            HTTPプロトコル
        </h4>
        <div class="space-y-4 leading-relaxed">
            <p>URLの先頭にある「http」は、<strong>HTTPという通信プロトコルを用いる</strong>という宣言です。プロトコル（protocol）とは<strong>規約（約束事）</strong>のことです。</p>
            <p>日本語しか話せない人と英語しか話せない人が会話できないのと同様に、コンピュータ同士も同じプロトコルを使わないとデータの意味が理解できません。</p>
            
            <div class="bg-blue-50 p-6 rounded-lg">
                <p><strong>HTTP (Hypertext Transfer Protocol)</strong> は、HTML（Webページ）などのコンテンツを送受信するための専用の約束事です。</p>
            </div>

            <h5 class="font-bold text-[#6A73A6] text-lg">■ HTTPSとは何か</h5>
            <p>HTTPSの「S」は<strong>Secure（セキュア：安全）</strong>の略です。通信データを暗号化し、第三者に読み取られないように保護します。</p>
            <p class="text-red-600 font-bold">パスワードや個人情報を扱う現代のWebアプリケーションでは、HTTPSによる暗号化は必須の条件です。</p>
        </div>
    </section>
</div>'
            ]
        );
    }
}