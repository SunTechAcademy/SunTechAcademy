<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('intermediate_tasks', function (Blueprint $table) {
            $table->id();
            // requirements, basic_design, detail_design, implementation, unit_test, integration_test, system_test, operation
            $table->string('phase');
            $table->string('title');
            $table->text('description');
            $table->string('image_path')->nullable();
            $table->string('status')->default('incomplete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intermediate_tasks');
    }
};
