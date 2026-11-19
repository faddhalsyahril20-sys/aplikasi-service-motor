<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarServis;
use Illuminate\Http\Request;

class DaftarServisController extends Controller
{
    public function index()
    {
        return response()->json(
            DaftarServis::with(['pelanggan', 'kendaraan'])->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'keluhan_kendaraan' => 'required|string',
            'tanggal_servis' => 'required|date'
        ]);

        return response()->json([
            'message' => 'Pendaftaran servis berhasil',
            'data' => DaftarServis::create($data)
        ], 201);
    }

    public function show(string $id)
    {
        return response()->json(
            DaftarServis::with(['pelanggan', 'kendaraan'])->findOrFail($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $servis = DaftarServis::findOrFail($id);

        $data = $request->validate([
            'pelanggan_id' => 'sometimes|required|exists:pelanggans,id',
            'kendaraan_id' => 'sometimes|required|exists:kendaraans,id',
            'keluhan_kendaraan' => 'sometimes|required|string',
            'tanggal_servis' => 'sometimes|required|date'
        ]);

        $servis->update($data);

        return response()->json([
            'message' => 'Data servis berhasil diperbarui',
            'data' => $servis
        ]);
    }

    public function destroy(string $id)
    {
        DaftarServis::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Data servis berhasil dihapus'
        ]);
    }
}