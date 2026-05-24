<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Lesson1Seeder extends Seeder
{
    public function run(): void
    {
        // 制約を一時解除してリセット
        Schema::disableForeignKeyConstraints();
        Chapter::truncate();
        Lesson::truncate();
        Course::truncate();
        Schema::enableForeignKeyConstraints();

        $course = Course::create([
            'title' => 'エンジニア基礎教育',
            'description' => '実務で役立つ知識とスキルを身につける初級コース'
        ]);

        $lesson1 = Lesson::create([
            'course_id' => $course->id,
            'title' => '学習の進め方と事前準備',
            'estimated_time' => 60,
            'sort_order' => 1,
        ]);

        // Chapter 1: はじめに
        Chapter::create([
            'lesson_id' => $lesson1->id,
            'title' => 'はじめに',
            'content' => '
                <div class="space-y-4">
                    <p>受講生の皆さん、サンテックアカデミーへようこそ！</p>
                    <p>サンテックアカデミーでは、実務で役立つ知識とスキルを短期間で身につけることを目指しています。短期集中の学習では、失敗をしたり挫折しそうになることも時にはあります。目指すゴールへ辿り着くためには、粘り強さと諦めない心が必要不可欠です。</p>
                    <p>くじけそうになりましたら、ぜひメンターのサポートをご活用ください。メンターは、皆さんの学習を支える心強い味方です。メンターへ質問したり、課題を提出したりする際には、メンターを実務上のパートナーと考え、コミュニケーションを取ってみましょう。</p>
                    <p>しかしながら、メンターはあくまでも学習の指導・サポートをする立場ですので、カリキュラムの内容をすべて説明したり、課題の解答を細かく教えることはできません。本コースの学習の成功は、皆さんの学習に対する主体性が鍵を握ります。</p>
                    <p>サンテックアカデミーは皆さん一人ひとりの成長を心から応援しています！</p>
                    <p class="font-bold text-blue-600">このレッスンでは、本コースの概要や、学習に必要なツールの準備方法について説明します。</p>
                </div>',
            'is_assignment' => 2,
            'sort_order' => 1,
        ]);

        // Chapter 2: Google Chromeのインストール
        Chapter::create([
            'lesson_id' => $lesson1->id,
            'title' => 'Google Chromeのインストール',
            'content' => '
                <div class="space-y-6">
                    <p>Google Chromeとは、Googleが開発したWebブラウザです。最新のWeb環境に対応した高速で、シンプル、安全な機能が世界的に評価されています。本カリキュラムの学習では、ブラウザは必ずGoogle Chromeを利用してください。</p>
                    
                    <div class="border-l-4 border-gray-400 pl-4">
                        <h4 class="text-xl font-bold mb-2">Macへのインストール方法</h4>
                        <p>（1）Safariを起動し、<a href="https://www.google.com/chrome/" class="text-blue-600 underline">Google Chromeダウンロードページ</a>へアクセスします。</p>
                        <p>（2）Chromeをダウンロードと書かれたボタンをクリックします。</p>
                        <p>（3）「許可」をクリックし、ダウンロードが完了したらインストーラーを開きます。</p>
                        <p>（4）Google Chromeを「アプリケーション」フォルダにドラッグ＆ドロップしましょう。</p>
                    </div>

                    <div class="border-l-4 border-gray-400 pl-4">
                        <h4 class="text-xl font-bold mb-2">Windowsへのインストール方法</h4>
                        <p>（1）Edgeを起動し、ダウンロードページへアクセスします。</p>
                        <p>（2）Chromeをダウンロードをクリック。ChromeSetUp.exeを実行します。</p>
                        <p>（3）インストールが完了すると、自動的にGoogle Chromeが開きます。</p>
                    </div>
                </div>',
            'is_assignment' => 2,
            'sort_order' => 2,
        ]);

        // Chapter 3: メンタリング
        Chapter::create([
            'lesson_id' => $lesson1->id,
            'title' => 'メンタリング',
            'content' => '
                <div class="space-y-6">
                    <p>メンタリングにはGoogleMeetというサービスを利用します。</p>
                    <h4 class="font-bold text-lg text-[#6A73A6]">■ メンタリングに関する注意点</h4>
                    <ul class="list-disc ml-6 space-y-2">
                        <li>事前キャンセルは開始時間の24時間前まで可能です。</li>
                        <li>無断欠席を連続2回されると、その後のメンタリングを中止します。</li>
                    </ul>
                    <h4 class="font-bold text-lg text-[#6A73A6]">■ 有意義なメンタリングにするためのポイント</h4>
                    <p>25分間のメンターとの対話を有効に使うために、以下の状況を具体的に伝えましょう。</p>
                    <ul class="list-disc ml-6 bg-gray-50 p-4 rounded shadow-inner">
                        <li>何を学習していたか</li>
                        <li>何を実現したかったか</li>
                        <li>どういった作業をしたか</li>
                        <li>どのようなトラブルが起きているか</li>
                    </ul>
                </div>',
            'is_assignment' => 1, // これを1にすると「課題進捗」にカウントされる
            'sort_order' => 3,
        ]);

        // Chapter 4: 学習の進め方
        Chapter::create([
            'lesson_id' => $lesson1->id,
            'title' => '学習の進め方',
            'content' => '
                <div class="space-y-4">
                    <p>チャプターの最後には、「このチャプターを完了する」が表示されます。学習が完了したら、クリックしてください。</p>
                    <p>クリックすると、「完了済み」に変化し、カリキュラム一覧にチェックがつきます。</p>
                </div>',
            'is_assignment' => 2,
            'sort_order' => 4,
        ]);
    }
}