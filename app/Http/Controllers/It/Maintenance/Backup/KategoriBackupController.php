<?php

namespace App\Http\Controllers\It\Maintenance\Backup;

use App\Http\Controllers\Controller;
use App\Models\It\Maintenance\Backup\KategoriBackup;
use Illuminate\Http\Request;

class KategoriBackupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('it.maintenance.backup.kategori_backup.index');
    }

    public function data()
    {
        $kategori_backup = KategoriBackup::orderBy('id_kategori_backup', 'desc')->get();

        return datatables()
            ->of($kategori_backup)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori_backup) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('kategori_backup.update', $kategori_backup->id_kategori_backup) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>
                    <button type="button" onclick="deleteData(`'. route('kategori_backup.destroy', $kategori_backup->id_kategori_backup) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
            'kategori_backup' => 'required|string',
        ]);

        KategoriBackup::create($validatedData);

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
        $kategori_backup = KategoriBackup::findOrFail($id);

        return response()->json($kategori_backup);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kategori_backup' => 'required|string',
        ]);

        $kategori_backup = KategoriBackup::findOrFail($id);
        $kategori_backup->update($validatedData);

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
        $kategori_backup = KategoriBackup::findOrFail($id);

        $kategori_backup->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
