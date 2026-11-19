<?php

namespace App\Http\Controllers;

use App\Models\DaftarServis;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class DaftarServisController extends Controller
{
    public function index()
    {
        $servis = DaftarServis::with(['pelanggan', 'kendaraan'])
            ->latest()->get();

        return view('daftar_servis.index', compact('servis'));
    }

use App\Models\Pelanggan;
use App\Models\Kendaraan;

public function create()
{
    $pelanggans = Pelanggan::all();
    $kendaraans = Kendaraan::all();

    return view('daftar_servis.create', compact(
        'pelanggans',
        'kendaraans'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'keluhan_kendaraan' => 'required',
            'tanggal_servis' => 'required|date'
        ]);

        DaftarServis::create($request->all());

        return redirect()->route('daftar-servis.index')
            ->with('success', 'Pendaftaran servis berhasil!');
    }

    public function edit(DaftarServis $daftar_servi)
    {
        $servis = $daftar_servi;
        $pelanggans = Pelanggan::all();
        $kendaraans = Kendaraan::all();

        return view('daftar_servis.edit', compact(
            'servis', 'pelanggans', 'kendaraans'
        ));
    }

    public function update(Request $request, DaftarServis $daftar_servi)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'keluhan_kendaraan' => 'required',
            'tanggal_servis' => 'required|date'
        ]);

        $daftar_servi->update($request->all());

        return redirect()->route('daftar-servis.index')
            ->with('success', 'Data servis berhasil diperbarui!');
    }

    public function destroy(DaftarServis $daftar_servi)
    {
        $daftar_servi->delete();

        return redirect()->route('daftar-servis.index')
            ->with('success', 'Data servis berhasil dihapus!');
    }
}