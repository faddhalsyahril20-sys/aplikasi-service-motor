<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarServis extends Model
{
    protected $table = 'daftar_servis';

    protected $fillable = [
        'pelanggan_id',
        'kendaraan_id',
        'keluhan_kendaraan',
        'tanggal_servis'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function dataService()
    {
        return $this->hasOne(DataService::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}