<?php

namespace App\Http\Controllers\Informasi;

use App\Http\Controllers\Controller;
use App\Models\Informasi\UnitBagian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UnitBagianController extends Controller implements HasMiddleware
{

    public static function middleware(): array 
    {
        return [
            new Middleware('permission:kategori_unit_bagian', only: ['index']),
            new Middleware('permission:kategori_unit_bagian', only: ['data']),
            new Middleware('permission:kategori_unit_bagian', only: ['create']),
            new Middleware('permission:kategori_unit_bagian', only: ['store']),
            new Middleware('permission:kategori_unit_bagian', only: ['update']),
            new Middleware('permission:kategori_unit_bagian', only: ['edit']),
            new Middleware('permission:kategori_unit_bagian', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('informasi.kantor.unit_bagian.index');
    }

    public function data()
    {
        $unit_bagian = UnitBagian::orderBy('nama_unit_bagian', 'asc')->get();

        return datatables()
            ->of($unit_bagian)
            ->addIndexColumn()
            ->addColumn('aksi', function ($unit_bagian) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('unit_bagian.update', $unit_bagian->id_unit_bagian) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>
                    <button type="button" onclick="deleteData(`'. route('unit_bagian.destroy', $unit_bagian->id_unit_bagian) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
            'nama_unit_bagian' => 'required|string'
        ]);

        UnitBagian::create($validatedData);

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
        $unit_bagian = UnitBagian::findOrFail($id);

        return response()->json($unit_bagian);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnitBagian $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_unit_bagian' => 'required|string'
        ]);

        $unit_bagian = UnitBagian::findOrFail($id);
        $unit_bagian->update($validatedData);

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
        $unit_bagian = UnitBagian::findOrFail($id);

        $unit_bagian->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
