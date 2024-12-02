<?php

namespace App\Http\Controllers\It\Maintenance\Evaluasi_kinerja_sistem;

use App\Http\Controllers\Controller;
use App\Models\It\Maintenance\Evaluasi_kinerja_sistem\Vendor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class VendorController extends Controller implements HasMiddleware
{

    public static function middleware(): array 
    {
        return [
            new Middleware('permission:kategori_evaluasi_kinerja_sistem', only: ['index']),
            new Middleware('permission:kategori_evaluasi_kinerja_sistem', only: ['data']),
            new Middleware('permission:kategori_evaluasi_kinerja_sistem', only: ['create']),
            new Middleware('permission:kategori_evaluasi_kinerja_sistem', only: ['store']),
            new Middleware('permission:kategori_evaluasi_kinerja_sistem', only: ['update']),
            new Middleware('permission:kategori_evaluasi_kinerja_sistem', only: ['edit']),
            new Middleware('permission:kategori_evaluasi_kinerja_sistem', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('it.maintenance.evaluasi_kinerja_sistem.vendor.index');
    }

    public function data()
    {
        $vendor = Vendor::orderBy('id_vendor', 'asc')->get();

        return datatables()
            ->of($vendor)
            ->addIndexColumn()
            ->addColumn('aksi', function ($vendor) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('vendor.update', $vendor->id_vendor) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>
                    <button type="button" onclick="deleteData(`'. route('vendor.destroy', $vendor->id_vendor) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
            'nama_vendor' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        Vendor::create($validatedData);

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
        $vendor = Vendor::findOrFail($id);

        return response()->json($vendor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_vendor' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        $vendor = Vendor::findOrFail($id);
        $vendor->update($validatedData);

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
        $vendor = Vendor::findOrFail($id);

        $vendor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
