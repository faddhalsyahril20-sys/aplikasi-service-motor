<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataService;
use Illuminate\Http\Request;

class DataServiceController extends Controller
{
    public function index()
    {
        return response()->json(
            DataService::with('daftarServis.pelanggan')->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'daftar_servis_id' => 'required|exists:daftar_servis,id|unique:data_services,daftar_servis_id',
            'estimasi_service' => 'required|numeric|min:0',
            'nama_mekanik' => 'required|string',
            'sparepart_pengganti' => 'nullable|string'
        ]);

        return response()->json([
            'message' => 'Data pengerjaan berhasil ditambahkan',
            'data' => DataService::create($data)
        ], 201);
    }

    public function show(string $id)
    {
        return response()->json(DataService::findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        $service = DataService::findOrFail($id);

        $data = $request->validate([
            'daftar_servis_id' => 'sometimes|required|exists:daftar_servis,id|unique:data_services,daftar_servis_id,'.$id,
            'estimasi_service' => 'sometimes|required|numeric|min:0',
            'nama_mekanik' => 'sometimes|required|string',
            'sparepart_pengganti' => 'nullable|string'
        ]);

        $service->update($data);

        return response()->json([
            'message' => 'Data pengerjaan berhasil diperbarui',
            'data' => $service
        ]);
    }

    public function destroy(string $id)
    {
        DataService::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Data pengerjaan berhasil dihapus'
        ]);
    }
}