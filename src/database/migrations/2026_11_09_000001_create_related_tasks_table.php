<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('intermediate_task_links', function (Blueprint $table) {
            $table->foreignId('task_id')->constrained('intermediate_tasks')->cascadeOnDelete();
            $table->foreignId('related_task_id')->constrained('intermediate_tasks')->cascadeOnDelete();
            $table->primary(['task_id', 'related_task_id']);
            $table->index('related_task_id');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('intermediate_task_links');
    }
};
