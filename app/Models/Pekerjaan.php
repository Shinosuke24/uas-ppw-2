<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pekerjaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'shinosuke_534826ugm_pekerjaan'; // sesuaikan prefix

    protected $fillable = ['nama', 'deskripsi'];

    // Relasi ke Pegawai
    public function pegawai()
    {
        return $this->hasMany(\App\Models\Pegawai::class, 'pekerjaan_id');
    }
}
