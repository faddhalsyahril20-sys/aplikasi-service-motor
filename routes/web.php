<?php

use App\Models\Pelanggan;
use App\Models\Kendaraan;
use App\Models\DaftarServis;

Route::get('/service-motor', function () {
    return view('service_motor', [
        'pelanggans' => Pelanggan::all(),
        'kendaraans' => Kendaraan::all(),
        'daftarServis' => DaftarServis::with([
            'pelanggan',
            'kendaraan'
        ])->get(),
    ]);
})->name('service-motor');