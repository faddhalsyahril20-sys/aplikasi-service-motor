<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataService extends Model
{
    protected $fillable = [
        'daftar_servis_id',
        'estimasi_service',
        'nama_mekanik',
        'sparepart_pengganti'
    ];

    public function daftarServis()
    {
        return $this->belongsTo(DaftarServis::class);
    }
}