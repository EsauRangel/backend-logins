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
        Schema::create('teacher_tasks', function (Blueprint $table) {
            $table->id();
            $table->string("image_url")->nullable()->default(null);
            $table->string("description");
            $table->foreignId("student_id")->constrained();
            $table->boolean("active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_tasks');
    }
};
