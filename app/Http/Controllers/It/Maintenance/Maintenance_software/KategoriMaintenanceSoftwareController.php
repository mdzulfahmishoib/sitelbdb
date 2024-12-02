<?php

namespace App\Http\Controllers\It\Maintenance\Maintenance_software;

use App\Http\Controllers\Controller;
use App\Models\It\Maintenance\Maintenance_software\KategoriMaintenanceSoftware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class KategoriMaintenanceSoftwareController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:kategori_maintenance_software', only: ['index']),
            new Middleware('permission:kategori_maintenance_software', only: ['data']),
            new Middleware('permission:kategori_maintenance_software', only: ['create']),
            new Middleware('permission:kategori_maintenance_software', only: ['store']),
            new Middleware('permission:kategori_maintenance_software', only: ['update']),
            new Middleware('permission:kategori_maintenance_software', only: ['edit']),
            new Middleware('permission:kategori_maintenance_software', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriMaintenanceSoftware::orderBy('kategori_maintenance_software')->get(); //untuk mengambil data supplier
        return view('it.maintenance.maintenance_software.kategori_maintenance_software.index', compact('kategori'));
    }

    public function data()
    {
        $kategori_maintenance_software = KategoriMaintenanceSoftware::orderBy('id_kategori_maintenance_software', 'desc')->get();

        return datatables()
            ->of($kategori_maintenance_software)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori_maintenance_software) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('kategori_maintenance_software.update', $kategori_maintenance_software->id_kategori_maintenance_software) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>
                    <button type="button" onclick="deleteData(`'. route('kategori_maintenance_software.destroy', $kategori_maintenance_software->id_kategori_maintenance_software) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
            'kategori_maintenance_software' => 'required|string'
        ]);

        KategoriMaintenanceSoftware::create($validatedData);

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
        $kategori_maintenance_software = KategoriMaintenanceSoftware::findOrFail($id);

        return response()->json($kategori_maintenance_software);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriMaintenanceSoftware $kategoriMaintenanceSoftware)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kategori_maintenance_software' => 'required|string'
        ]);

        $kategori_maintenance_software = KategoriMaintenanceSoftware::findOrFail($id);
        $kategori_maintenance_software->update($validatedData);

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
        $kategori_maintenance_software = KategoriMaintenanceSoftware::findOrFail($id);

        $kategori_maintenance_software->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
