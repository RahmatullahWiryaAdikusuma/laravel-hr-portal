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
        Schema::create('master_lowongans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dept_id')->constrained('master_departemens')->cascadeOnDelete();  
            $table->string('posisi');
            $table->integer('quota');
            $table->string('deskripsi');
            $table->string('user_create')->nullable(); 
            $table->string('user_update')->nullable();  
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_lowongans');
    }
};
