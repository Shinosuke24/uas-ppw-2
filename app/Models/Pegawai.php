<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'shinosuke_534826ugm_pegawai'; // Sesuaikan prefix database
    protected $fillable = ['nama', 'email', 'pekerjaan_id', 'gender'];


    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }
}
