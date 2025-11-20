<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPendaftar extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pendaftars';

    protected $fillable = [
        'lowongan_id', 
        'name',
        'gender',
        'dob',
        'address',
        'no_telp',
        'university',
        'major',
        'ipk',
        'path_cv',
        'status',
    ];
   
    public function  lowongan() {
         return $this->belongsTo(MasterLowongan::class, 'lowongan_id'); }
}
