<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        return response()->json(Kendaraan::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'no_plat' => 'required|string|unique:kendaraans,no_plat',
            'jenis_kendaraan' => 'required|in:Matic,Manual Transmisi',
            'no_stnk' => 'required|string|unique:kendaraans,no_stnk',
            'tahun_pembuatan' => 'required|integer',
            'nama_pemilik' => 'required|string',
            'warna' => 'required|string'
        ]);

        return response()->json([
            'message' => 'Kendaraan berhasil ditambahkan',
            'data' => Kendaraan::create($data)
        ], 201);
    }

    public function show(string $id)
    {
        return response()->json(Kendaraan::findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $data = $request->validate([
            'no_plat' => 'sometimes|required|string|unique:kendaraans,no_plat,'.$id,
            'jenis_kendaraan' => 'sometimes|required|in:Matic,Manual Transmisi',
            'no_stnk' => 'sometimes|required|string|unique:kendaraans,no_stnk,'.$id,
            'tahun_pembuatan' => 'sometimes|required|integer',
            'nama_pemilik' => 'sometimes|required|string',
            'warna' => 'sometimes|required|string'
        ]);

        $kendaraan->update($data);

        return response()->json([
            'message' => 'Kendaraan berhasil diperbarui',
            'data' => $kendaraan
        ]);
    }

    public function destroy(string $id)
    {
        Kendaraan::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Kendaraan berhasil dihapus'
        ]);
    }
}