<?php

namespace App\Http\Controllers\It\Maintenance\Maintenance_hardware;

use App\Http\Controllers\Controller;
use App\Models\It\Maintenance\Maintenance_hardware\KategoriMaintenanceHardware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class KategoriMaintenanceHardwareController extends Controller implements HasMiddleware
{

    public static function middleware(): array 
    {
        return [
            new Middleware('permission:kategori_maintenance_hardware', only: ['index']),
            new Middleware('permission:kategori_maintenance_hardware', only: ['data']),
            new Middleware('permission:kategori_maintenance_hardware', only: ['create']),
            new Middleware('permission:kategori_maintenance_hardware', only: ['store']),
            new Middleware('permission:kategori_maintenance_hardware', only: ['update']),
            new Middleware('permission:kategori_maintenance_hardware', only: ['edit']),
            new Middleware('permission:kategori_maintenance_hardware', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriMaintenanceHardware::orderBy('kategori_maintenance_hardware')->get(); //untuk mengambil data supplier
        return view('it.maintenance.maintenance_hardware.kategori_maintenance_hardware.index', compact('kategori'));
    }

    public function data()
    {
        $kategori_maintenance_hardware = KategoriMaintenanceHardware::orderBy('id_kategori_maintenance_hardware', 'desc')->get();

        return datatables()
            ->of($kategori_maintenance_hardware)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori_maintenance_hardware) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('kategori_maintenance_hardware.update', $kategori_maintenance_hardware->id_kategori_maintenance_hardware) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>
                    <button type="button" onclick="deleteData(`'. route('kategori_maintenance_hardware.destroy', $kategori_maintenance_hardware->id_kategori_maintenance_hardware) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_maintenance_hardware' => 'required|string'
        ]);

        KategoriMaintenanceHardware::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori_maintenance_hardware = KategoriMaintenanceHardware::findOrFail($id);

        return response()->json($kategori_maintenance_hardware);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriMaintenanceHardware $kategoriMaintenanceHardware)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kategori_maintenance_hardware' => 'required|string'
        ]);

        $kategori_maintenance_hardware = KategoriMaintenanceHardware::findOrFail($id);
        $kategori_maintenance_hardware->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori_maintenance_hardware = KategoriMaintenanceHardware::findOrFail($id);

        $kategori_maintenance_hardware->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
