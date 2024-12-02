<?php

namespace App\Http\Controllers\It\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\It\Maintenance\RegisterRuangServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RegisterRuangServerController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_register_ruang_server', only: ['index']),
            new Middleware('permission:view_register_ruang_server', only: ['data']),
            new Middleware('permission:create_register_ruang_server', only: ['create']),
            new Middleware('permission:create_register_ruang_server', only: ['store']),
            new Middleware('permission:update_register_ruang_server', only: ['update']),
            new Middleware('permission:update_register_ruang_server', only: ['edit']),
            new Middleware('permission:delete_register_ruang_server', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('it.maintenance.register_ruang_server.index');
    }

    public function data()
    {
        $register_ruang_server = RegisterRuangServer::orderBy('id_register_ruang_server', 'desc')->get();

        return datatables()
            ->of($register_ruang_server)
            ->addIndexColumn()
            ->addColumn('status', function ($register_ruang_server) {
                $class = $register_ruang_server->status === 'Belum Selesai' ? 'badge badge-danger' : 'badge badge-success';
                return '<span class="'. $class .' text-xs">'. $register_ruang_server->status .'</span>';
            })
            ->addColumn('tanggal_register_ruang_server', function ($register_ruang_server) {
                return '<span class="badge badge-success text-sm font-weight-normal">'. $register_ruang_server->tanggal_register_ruang_server .'</span>';
            })
            ->addColumn('aksi', function ($register_ruang_server) {
                $viewButton = auth()->user()->can('read_register_ruang_server') 
                    ? '<button type="button" onclick="viewForm(`'. route('register_ruang_server.show', $register_ruang_server->id_register_ruang_server) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
    
                $editButton = auth()->user()->can('update_register_ruang_server') 
                    ? '<button type="button" onclick="editForm(`'. route('register_ruang_server.update', $register_ruang_server->id_register_ruang_server) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';
    
                $deleteButton = auth()->user()->can('delete_register_ruang_server') 
                    ? '<button type="button" onclick="deleteData(`'. route('register_ruang_server.destroy', $register_ruang_server->id_register_ruang_server) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
                    : '';
                
                $cloneButton = auth()->user()->can('update_register_ruang_server')
                    ? '<button type="button" onclick="cloneForm(`'. route('register_ruang_server.clone', $register_ruang_server->id_register_ruang_server) .'`)" class="btn btn-success"><i class="fa fa-copy"></i></button>' 
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
            ->rawColumns(['aksi', 'status', 'tanggal_register_ruang_server'])
            ->make(true);
    }

    public function clone($id)
    {
        $register_ruang_server = RegisterRuangServer::find($id);

        if (!$register_ruang_server) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Return the register_ruang_server data for cloning purpose
        return response()->json($register_ruang_server);
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
            'tanggal_register_ruang_server' => 'required|date',
            'nama_petugas' => 'required|string',
            'keperluan' => 'required|string',
            'kategori_urgensi' => 'required|string',
            'pihak' => 'required|string',
            'bagian_instansi' => 'required|string',
            'keterangan_tambahan' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240', // Validation for each file
        ]);

        $register_ruang_server = RegisterRuangServer::create($validatedData);
    
        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            $fileNames = [];
    
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName(); // Ambil nama asli file
                $extension = $file->getClientOriginalExtension(); // Ambil ekstensi file
    
                // Menambahkan prefix time() sebelum nama file
                $newFileName = time() . '_' . $originalName;
    
                // Simpan file di storage dengan nama baru
                $file->storeAs('public/it/maintenance/register_ruang_server', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Simpan nama file ke dalam kolom 'dokumentasi_db'
            $register_ruang_server->update(['dokumentasi_db' => implode(',', $fileNames)]);
        }

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
        $register_ruang_server = RegisterRuangServer::findOrFail($id);

        return response()->json($register_ruang_server);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegisterRuangServer $registerRuangServer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal_register_ruang_server' => 'required|date',
            'nama_petugas' => 'required|string',
            'keperluan' => 'required|string',
            'kategori_urgensi' => 'required|string',
            'pihak' => 'required|string',
            'bagian_instansi' => 'required|string',
            'keterangan_tambahan' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240', // Validation for each file
        ]);

        // Cari data berdasarkan ID
        $register_ruang_server = RegisterRuangServer::findOrFail($id);
    
        // Update data selain file
        $register_ruang_server->update($validatedData);
    
        // Proses jika ada file baru yang diunggah
        if ($request->hasFile('dokumentasi')) {
            // Hapus file lama yang sudah ada
            if ($register_ruang_server->dokumentasi_db) {
                // Split nama file menjadi array berdasarkan koma
                $oldFiles = explode(',', $register_ruang_server->dokumentasi_db);
    
                // Hapus setiap file lama dari storage
                foreach ($oldFiles as $oldFile) {
                    $oldFilePath = storage_path('app/public/it/maintenance/register_ruang_server/' . $oldFile);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath); // Menghapus file lama
                    }
                }
            }
    
            // Simpan file baru
            $files = $request->file('dokumentasi');
            $fileNames = [];
    
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName(); // Ambil nama asli file
                $extension = $file->getClientOriginalExtension(); // Ambil ekstensi file
    
                // Menambahkan prefix time() sebelum nama file
                $newFileName = time() . '_' . $originalName;
    
                // Simpan file di storage dengan nama baru
                $file->storeAs('public/it/maintenance/register_ruang_server', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Update kolom 'dokumentasi_db' dengan nama file yang baru
            $register_ruang_server->update(['dokumentasi_db' => implode(',', $fileNames)]);
        }

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
        // Cari data berdasarkan ID
        $register_ruang_server = RegisterRuangServer::findOrFail($id);
    
        // Hapus file-file yang terasosiasi jika ada
        if ($register_ruang_server->dokumentasi_db) {
            // Split nama file menjadi array berdasarkan koma
            $fileNames = explode(',', $register_ruang_server->dokumentasi_db);
    
            // Hapus setiap file dari storage
            foreach ($fileNames as $fileName) {
                $filePath = storage_path('app/public/it/maintenance/register_ruang_server/' . $fileName);
    
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file dari server
                }
            }
        }
    
        // Hapus record dari database
        $register_ruang_server->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
