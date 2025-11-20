<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterDepartemen extends Model
{
    use HasFactory;

    protected $table = 'master_departemens';
    protected $fillable = [
        'name',
    ];

            public function  lowongan() { 
        return $this->hasMany(MasterLowongan::class, 'dept_id'); }
}
