<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\DaftarServis;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('daftarServis.pelanggan')->latest()->get();

        return view('pembayaran.index', compact('pembayarans'));
    }

use App\Models\DaftarServis;

public function create()
{
    $daftarServis = DaftarServis::with([
        'pelanggan',
        'kendaraan'
    ])->get();

    return view('pembayaran.create', compact(
        'daftarServis'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'daftar_servis_id' => 'required|exists:daftar_servis,id|unique:pembayarans,daftar_servis_id',
            'jumlah_biaya_servis' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'nullable|in:Cash / Tunai,Non Tunai',
            'keterangan' => 'nullable'
        ]);

        Pembayaran::create($request->all());

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil disimpan!');
    }

    public function edit(Pembayaran $pembayaran)
    {
        $servis = DaftarServis::with('pelanggan')->get();

        return view('pembayaran.edit', compact('pembayaran', 'servis'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'daftar_servis_id' => 'required|exists:daftar_servis,id|unique:pembayarans,daftar_servis_id,'.$pembayaran->id,
            'jumlah_biaya_servis' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'nullable|in:Cash / Tunai,Non Tunai',
            'keterangan' => 'nullable'
        ]);

        $pembayaran->update($request->all());

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil diperbarui!');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus!');
    }
}