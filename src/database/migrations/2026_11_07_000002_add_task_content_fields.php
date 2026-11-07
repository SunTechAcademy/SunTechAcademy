<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('intermediate_tasks', function (Blueprint $table) {
            $table->json('image_paths')->nullable();
            $table->string('description_format')->default('plain');
        });
    }
    public function down(): void
    {
        Schema::table('intermediate_tasks', fn (Blueprint $table) => $table->dropColumn(['image_paths', 'description_format']));
    }
};
