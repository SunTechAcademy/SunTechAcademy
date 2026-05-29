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
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 外部キー制約を一時無効化してリセット
        Schema::disableForeignKeyConstraints();
        Admin::truncate();
        User::truncate();
        DB::table('login_histories')->truncate();
        DB::table('chapter_user')->truncate();
        Chapter::truncate();
        Lesson::truncate();
        Course::truncate();
        Schema::enableForeignKeyConstraints();

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
            Lesson3Seeder::class,
            Lesson3_1Seeder::class,
            Lesson3_2Seeder::class,
            Lesson3_3Seeder::class,
            Lesson3_4Seeder::class,
            Lesson3_5Seeder::class,
            Lesson3_6Seeder::class,
            Lesson3_7Seeder::class,
            Lesson3_8Seeder::class,
            Lesson4Seeder::class,
            Lesson4_2Seeder::class,
            Lesson4_3Seeder::class,
            Lesson4_4Seeder::class,
            Lesson4_5Seeder::class,
            Lesson4_6Seeder::class,
            Lesson4_7Seeder::class,
            Lesson4_8Seeder::class,
            Lesson5Seeder::class,
            Lesson5_1Seeder::class,
            Lesson6Seeder::class,
            Lesson6_2Seeder::class,
            Lesson6_3Seeder::class,
            Lesson7Seeder::class,
            Lesson7_2Seeder::class,
            Lesson7_3Seeder::class,
            Lesson7_4Seeder::class,
            Lesson7_5Seeder::class,
            Lesson8Seeder::class,
            Lesson8_2Seeder::class,
            Lesson8_3Seeder::class,
            Lesson8_4Seeder::class,
            Lesson8_5Seeder::class,
            Lesson8_6Seeder::class,
            Lesson9Seeder::class,
            Lesson9_2Seeder::class,
            Lesson9_3Seeder::class,
            Lesson9_4Seeder::class,
            Lesson10Seeder::class,
            Lesson10_2Seeder::class,
            Lesson10_3Seeder::class,
            Lesson10_4Seeder::class,
            Lesson10_5Seeder::class,
            Lesson10_6Seeder::class,
            Lesson10_7Seeder::class,
            Lesson10_8Seeder::class,
            Lesson10_9Seeder::class,
            Lesson10_10Seeder::class,
            Lesson10_11Seeder::class,
            Lesson10_12Seeder::class,
            Lesson10_13Seeder::class,
            Lesson10_14Seeder::class,
            Lesson10_15Seeder::class,
            Lesson11Seeder::class,
            Lesson11_2Seeder::class,
            Lesson11_3Seeder::class,
            Lesson11_4Seeder::class,
            Lesson11_5Seeder::class,
            Lesson12Seeder::class,
            Lesson12_2Seeder::class,
            Lesson12_3Seeder::class,
            Lesson12_4Seeder::class,
            Lesson12_5Seeder::class,
            Lesson12_6Seeder::class,
            Lesson12_7Seeder::class,
            Lesson12_8Seeder::class,
            Lesson12_9Seeder::class,
            Lesson12_10Seeder::class,
            Lesson12_11Seeder::class,
            Lesson12_12Seeder::class,
            Lesson12_13Seeder::class,
            Lesson12_14Seeder::class,
            Lesson12_15Seeder::class,
            Lesson13Seeder::class,
            Lesson13_2Seeder::class,
            Lesson13_3Seeder::class,
            Lesson13_4Seeder::class,
            Lesson13_5Seeder::class,
            Lesson13_6Seeder::class,
            Lesson13_7Seeder::class,
            Lesson13_8Seeder::class,
            Lesson13_9Seeder::class,
            Lesson14Seeder::class,
            Lesson14_2Seeder::class,
            Lesson14_3Seeder::class,
            Lesson14_4Seeder::class,
            Lesson14_5Seeder::class,
            Lesson14_6Seeder::class,
            Lesson14_7Seeder::class,
            Lesson14_8Seeder::class,
            Lesson14_9Seeder::class,
            Lesson15Seeder::class,
            Lesson15_2Seeder::class,
            Lesson15_3Seeder::class,
            Lesson15_4Seeder::class,
            Lesson15_5Seeder::class,
            Lesson15_6Seeder::class,
            Lesson16Seeder::class,
            Lesson16_2Seeder::class,
            Lesson16_3Seeder::class,
            Lesson16_4Seeder::class,
            Lesson16_5Seeder::class,
            Lesson16_6Seeder::class,
            Lesson16_7Seeder::class,
            Lesson16_8Seeder::class,
            Lesson16_9Seeder::class,
            Lesson16_10Seeder::class,
            Lesson16_11Seeder::class,
            Lesson16_12Seeder::class,
            Lesson16_13Seeder::class,
            Lesson16_14Seeder::class,
            Lesson17Seeder::class,
            Lesson17_2Seeder::class,
            Lesson17_3Seeder::class,
            Lesson17_4Seeder::class,
            Lesson17_5Seeder::class,
            Lesson17_6Seeder::class,
            Lesson17_7Seeder::class,
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