<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // コース詳細
    Route::get('/courses/beginner', [CourseController::class, 'beginner'])->name('courses.beginner');

    Route::get('/courses/intermediate', function () { 
        return "中級コースは準備中です。"; 
    })->name('courses.intermediate');
    
    Route::get('/courses/advanced', function () { 
        return "上級コースは準備中です。"; 
    })->name('courses.advanced');

    // レッスン詳細画面（フォルダ階層に合わせる）
    Route::get('/courses/lessons/{id}', [CourseController::class, 'showLesson'])->name('lessons.show');
    // 完了ボタン用
    Route::post('/chapters/{id}/complete', [CourseController::class, 'completeChapter'])->name('chapters.complete');
});

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function () {
    // 未ログイン時のみ
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AuthController::class, 'create'])->name('login');
        Route::post('login', [AuthController::class, 'store']);
    });

    // ログイン済みのみ
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
    });
});