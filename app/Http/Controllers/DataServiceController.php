<?php

namespace App\Http\Controllers;

use App\Models\DataService;
use App\Models\DaftarServis;
use Illuminate\Http\Request;

class DataServiceController extends Controller
{
    public function index()
    {
        $services = DataService::with('daftarServis.pelanggan')->latest()->get();

        return view('data_service.index', compact('services'));
    }

use App\Models\DaftarServis;

public function create()
{
    $daftarServis = DaftarServis::with([
        'pelanggan',
        'kendaraan'
    ])->get();

    return view('data_service.create', compact(
        'daftarServis'
    ));
}
    public function store(Request $request)
    {
        $request->validate([
            'daftar_servis_id' => 'required|exists:daftar_servis,id|unique:data_services,daftar_servis_id',
            'estimasi_service' => 'required|numeric|min:0',
            'nama_mekanik' => 'required',
            'sparepart_pengganti' => 'nullable'
        ]);

        DataService::create($request->all());

        return redirect()->route('data-service.index')
            ->with('success', 'Data pengerjaan berhasil disimpan!');
    }

    public function edit(DataService $data_service)
    {
        $servis = DaftarServis::with('pelanggan')->get();

        return view('data_service.edit', compact('data_service', 'servis'));
    }

    public function update(Request $request, DataService $data_service)
    {
        $request->validate([
            'daftar_servis_id' => 'required|exists:daftar_servis,id|unique:data_services,daftar_servis_id,'.$data_service->id,
            'estimasi_service' => 'required|numeric|min:0',
            'nama_mekanik' => 'required',
            'sparepart_pengganti' => 'nullable'
        ]);

        $data_service->update($request->all());

        return redirect()->route('data-service.index')
            ->with('success', 'Data pengerjaan berhasil diperbarui!');
    }

    public function destroy(DataService $data_service)
    {
        $data_service->delete();

        return redirect()->route('data-service.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}