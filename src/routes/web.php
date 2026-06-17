<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\IntermediateCourseController;
use App\Http\Middleware\CheckBeginnerCourseCompletion;
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

    Route::middleware([CheckBeginnerCourseCompletion::class])->group(function () {
        // --- 中級コース関連ルート ---
        Route::prefix('courses/intermediate')->name('courses.intermediate.')->group(function () {
            Route::get('/', [IntermediateCourseController::class, 'index'])->name('index');
            Route::get('/rules', [IntermediateCourseController::class, 'rules'])->name('rules');
            Route::get('/documents', [IntermediateCourseController::class, 'documents'])->name('documents');
            Route::get('/create', [IntermediateCourseController::class, 'create'])->name('create');
            Route::post('/store', [IntermediateCourseController::class, 'store'])->name('store');
            Route::get('/phase/{phase}', [IntermediateCourseController::class, 'phaseTasks'])->name('phase');
            Route::get('/tasks/{id}', [IntermediateCourseController::class, 'showTask'])->name('show_task');
            Route::post('/tasks/{id}/assign', [IntermediateCourseController::class, 'assignTask'])->name('assign_task');
            Route::post('/tasks/{id}/complete', [IntermediateCourseController::class, 'completeTask'])->name('complete_task');
            Route::get('/tasks/{id}/edit', [IntermediateCourseController::class, 'edit'])->name('edit_task');
            Route::put('/tasks/{id}', [IntermediateCourseController::class, 'update'])->name('update_task');
            Route::delete('/tasks/{id}', [IntermediateCourseController::class, 'destroy'])->name('destroy_task');
        });
        
        Route::get('/courses/advanced', function () { 
            return "上級コースは準備中です。"; 
        })->name('courses.advanced');
    });

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