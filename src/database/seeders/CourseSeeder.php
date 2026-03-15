<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. コース作成
        $course = Course::create([
            'title' => 'エンジニア基礎教育',
            'description' => '初級コースです'
        ]);

        // 2. レッスン作成 (Lesson 19)
        $lesson19 = Lesson::create([
            'course_id' => $course->id,
            'title' => 'オリジナルWebサービスの構築',
            'estimated_time' => 2400, // 40時間
            'sort_order' => 1,
        ]);

        // 3. チャプター作成 (Lesson 19 の中身)
        Chapter::create([
            'lesson_id' => $lesson19->id,
            'title' => '1. 学習の目標',
            'is_assignment' => false,
            'sort_order' => 1,
        ]);

        Chapter::create([
            'lesson_id' => $lesson19->id,
            'title' => '2. オリジナルサービス制作の流れ',
            'is_assignment' => true, // 課題進捗にカウントされる
            'sort_order' => 2,
        ]);

        Chapter::create([
            'lesson_id' => $lesson19->id,
            'title' => '3. （参考）Cacoo',
            'is_assignment' => false,
            'sort_order' => 3,
        ]);
    }
}