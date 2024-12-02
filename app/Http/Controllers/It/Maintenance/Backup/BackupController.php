<?php

namespace App\Http\Controllers\It\Maintenance\Backup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\It\Maintenance\Backup\Backup;
use App\Models\It\Maintenance\Backup\KategoriBackup;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BackupController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_backup', only: ['index']),
            new Middleware('permission:view_backup', only: ['data']),
            new Middleware('permission:create_backup', only: ['clone']),
            new Middleware('permission:create_backup', only: ['store']),
            new Middleware('permission:update_backup', only: ['update']),
            new Middleware('permission:update_backup', only: ['edit']),
            new Middleware('permission:delete_backup', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori_backup = KategoriBackup::all()->pluck('kategori_backup', 'id_kategori_backup');
        return view('it.maintenance.backup.index', compact('kategori_backup'));
    }

    public function data()
    {
        // $backup = Backup::orderBy('id_backup', 'desc')->get();
        $backup = Backup::leftJoin('kategori_backup', 'backup.id_kategori_backup', '=', 'kategori_backup.id_kategori_backup')
        ->select('backup.*', 'kategori_backup.kategori_backup')
        ->orderBy('backup.id_backup', 'desc')
        ->get();

        return datatables()
            ->of($backup)
            ->addIndexColumn()
            ->addColumn('validasi_backup', function ($backup) {
                $class = ($backup->validasi_backup === 'Tidak Berhasil' || $backup->validasi_backup === 'Belum Diverifikasi') 
                         ? 'badge badge-danger' 
                         : 'badge badge-success';
                return '<span class="'. $class .' text-xs font-weight-normal">'. $backup->validasi_backup .'</span>';
            })
            ->addColumn('kategori_backup', function ($backup) {
                return $backup->kategori_backup;
            })
            ->addColumn('aksi', function ($backup) {
                $viewButton = auth()->user()->can('read_backup') 
                    ? '<button type="button" onclick="viewForm(`'. route('backup.show', $backup->id_backup) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
    
                $editButton = auth()->user()->can('update_backup') 
                    ? '<button type="button" onclick="editForm(`'. route('backup.update', $backup->id_backup) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';
    
                $deleteButton = auth()->user()->can('delete_backup') 
                    ? '<button type="button" onclick="deleteData(`'. route('backup.destroy', $backup->id_backup) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
                    : '';
                
                $cloneButton = auth()->user()->can('update_backup')
                    ? '<button type="button" onclick="cloneForm(`'. route('backup.clone', $backup->id_backup) .'`)" class="btn btn-success"><i class="fa fa-copy"></i></button>' 
                    : '';
    
                return '
                <div class="btn-group">
                    '. $viewButton .'
                    '. $editButton .'
                    '. $cloneButton .'
                    '. $deleteButton .'
                </div>
                ';
            })
            ->rawColumns(['aksi', 'validasi_backup'])
            ->make(true);
    }

    public function clone($id)
    {
        $backup = Backup::find($id);

        if (!$backup) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Return the backup data for cloning purpose
        return response()->json($backup);
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
            'id_kategori_backup' => 'required|string',
            'tanggal_backup' => 'required|date',
            'metode_backup' => 'required|string',
            'jenis_backup' => 'required|string',
            'waktu_backup' => 'required|string',
            'nama_file_backup' => 'required|string',
            'nama_petugas_backup' => 'required|string',
            'validasi_backup' => 'nullable|string',
            'nama_petugas_validasi' => 'nullable|string',
            'keterangan_backup' => 'nullable|string',
        ]);

        Backup::create($validatedData);

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
        $backup = Backup::findOrFail($id);

        return response()->json($backup);
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
            'id_kategori_backup' => 'required|string',
            'tanggal_backup' => 'required|date',
            'metode_backup' => 'required|string',
            'jenis_backup' => 'required|string',
            'waktu_backup' => 'required|string',
            'nama_file_backup' => 'required|string',
            'nama_petugas_backup' => 'required|string',
            'validasi_backup' => 'nullable|string',
            'nama_petugas_validasi' => 'nullable|string',
            'keterangan_backup' => 'nullable|string',
        ]);

        $backup = Backup::findOrFail($id);
        $backup->update($validatedData);

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
        $backup = Backup::findOrFail($id);

        $backup->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
