<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // コーステーブル
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');        // コース名
            $table->text('description')->nullable(); // 説明
            $table->string('image_path')->nullable(); // 画像パス
            $table->timestamps();
        });

        // レッスンテーブル
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete(); // 初級・中級など
            $table->string('title'); // 「オリジナルWebサービスの構築」など
            $table->integer('estimated_time')->default(0); // 目安時間（分）
            $table->integer('sort_order'); // 並び順
            $table->timestamps();
        });

        // チャプターテーブル
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
            $table->string('title'); // 「1. 学習の目標」など
            $table->longText('content')->nullable();
            $table->tinyInteger('is_assignment')->default(0); // 課題かどうか（課題進捗の計算用）
            $table->integer('sort_order');
            $table->timestamps();
        });

        // 学習進捗テーブル
        Schema::create('chapter_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('chapter_id')->constrained()->cascadeOnDelete();
            $table->timestamp('completed_at'); // 完了日時
            $table->unique(['user_id', 'chapter_id']); // 重複登録防止
        });

        // ログイン履歴テーブル
        Schema::create('login_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('login_date'); // ログインした日付
            $table->unique(['user_id', 'login_date']); // 1日1レコード
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('login_histories');
        Schema::dropIfExists('chapter_user');
        Schema::dropIfExists('chapters');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('courses');
    }
};