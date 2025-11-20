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
        Schema::create('transaksi_pendaftars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lowongan_id')->constrained('master_lowongans')->cascadeOnDelete();
            $table->string('name');  
            $table->enum('gender', ['male', 'female']);
            $table->date('dob');  
            $table->string('address');
            $table->string('no_telp');
            $table->string('university');
            $table->string('major');  
            $table->double('ipk');  
            $table->enum('status', ['P', 'A', 'R'])->default('P');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pendaftars');
    }
};
