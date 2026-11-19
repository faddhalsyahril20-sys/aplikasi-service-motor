<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use App\Models\DaftarServis;
use App\Models\DataService;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

// API PELANGGAN
Route::apiResource('pelanggan', App\Http\Controllers\Api\PelangganController::class);

// API KENDARAAN
Route::apiResource('kendaraan', App\Http\Controllers\Api\KendaraanController::class);

// API DAFTAR SERVIS
Route::apiResource('daftar-servis', App\Http\Controllers\Api\DaftarServisController::class);

// API DATA SERVICE
Route::apiResource('data-service', App\Http\Controllers\Api\DataServiceController::class);

// API PEMBAYARAN
Route::apiResource('pembayaran', App\Http\Controllers\Api\PembayaranController::class);