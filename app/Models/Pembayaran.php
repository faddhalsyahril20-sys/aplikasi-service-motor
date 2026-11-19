<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'daftar_servis_id',
        'jumlah_biaya_servis',
        'jenis_pembayaran',
        'keterangan'
    ];

    public function daftarServis()
    {
        return $this->belongsTo(DaftarServis::class);
    }
}