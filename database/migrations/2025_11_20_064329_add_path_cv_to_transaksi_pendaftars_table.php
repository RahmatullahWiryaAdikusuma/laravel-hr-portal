<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     
    public function up(): void
    {
        Schema::table('transaksi_pendaftars', function (Blueprint $table) {
            
            $table->string('path_cv')->after('ipk'); 
        });
    }

   
    public function down(): void
    {
        Schema::table('transaksi_pendaftars', function (Blueprint $table) {
            
            $table->dropColumn('path_cv');
        });
    }
};