<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        return response()->json(
            Pembayaran::with('daftarServis.pelanggan')->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'daftar_servis_id' => 'required|exists:daftar_servis,id|unique:pembayarans,daftar_servis_id',
            'jumlah_biaya_servis' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'nullable|in:Cash / Tunai,Non Tunai',
            'keterangan' => 'nullable|string'
        ]);

        return response()->json([
            'message' => 'Pembayaran berhasil ditambahkan',
            'data' => Pembayaran::create($data)
        ], 201);
    }

    public function show(string $id)
    {
        return response()->json(Pembayaran::findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $data = $request->validate([
            'daftar_servis_id' => 'sometimes|required|exists:daftar_servis,id|unique:pembayarans,daftar_servis_id,'.$id,
            'jumlah_biaya_servis' => 'sometimes|required|numeric|min:0',
            'jenis_pembayaran' => 'nullable|in:Cash / Tunai,Non Tunai',
            'keterangan' => 'nullable|string'
        ]);

        $pembayaran->update($data);

        return response()->json([
            'message' => 'Pembayaran berhasil diperbarui',
            'data' => $pembayaran
        ]);
    }

    public function destroy(string $id)
    {
        Pembayaran::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Pembayaran berhasil dihapus'
        ]);
    }
}