<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterLowongan extends Model
{   
    use HasFactory;

    protected $table = 'master_lowongans';
    protected $fillable = [
        'dept_id',
        'posisi',
        'quota',
        'deskripsi',
        'is_active',
        'user_create',
        'user_update'
    ];
    public function  departemen() { 
        return $this->belongsTo(MasterDepartemen::class, 'dept_id'); }
    
    public function  pendaftar() { 
        return $this->hasMany(TransaksiPendaftar::class, 'lowongan_id'); }
}
