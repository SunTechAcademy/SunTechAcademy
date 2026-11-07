<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 既存アカウントを一度だけ昇格。メール変更による権限取得は認めない。
        DB::table('users')->whereRaw('LOWER(email) = ?', ['test@test.com'])
            ->update(['role' => 'super_admin']);
    }

    public function down(): void
    {
        // データに付与した権限をロールバックで暗黙に剥奪しない。
    }
};
