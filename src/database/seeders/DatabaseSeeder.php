<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 外部キー制約を一時無効化してリセット
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Admin::truncate();
        User::truncate();
        DB::table('login_histories')->truncate();
        DB::table('chapter_user')->truncate();
        Chapter::truncate();
        Lesson::truncate();
        Course::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // --- 管理者データの作成 ---
        Admin::create([
            'id' => 1,
            'name' => '管理者テスト',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        // --- 一般ユーザーデータの作成 ---
        $user = User::create([
            'id' => 1,
            'name' => '鈴木智哉',
            'email' => 'test@test.com',
            'password' => Hash::make('Tomoya0218'),
        ]);

        // --- ログイン履歴の作成 ---
        DB::table('login_histories')->insert([
            ['user_id' => 1, 'login_date' => '2026-03-15'],
            ['user_id' => 1, 'login_date' => '2026-03-16'],
        ]);

        // 各Seederを呼び出し
        $this->call([
            Lesson1Seeder::class,
            Lesson2Seeder::class,
            Lesson2_1Seeder::class,
            Lesson2_2Seeder::class,
            Lesson2_3Seeder::class,
        ]);
        
        // 学習進捗の作成 
        $user->chapters()->attach([
            1 => ['completed_at' => '2026-03-16 14:38:50'],
            2 => ['completed_at' => '2026-03-16 14:12:02'],
            3 => ['completed_at' => '2026-03-16 14:12:12'],
            4 => ['completed_at' => '2026-03-16 14:38:48'],
        ]);
    }
}