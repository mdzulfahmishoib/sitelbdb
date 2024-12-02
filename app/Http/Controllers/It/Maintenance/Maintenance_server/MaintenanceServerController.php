<?php

namespace App\Http\Controllers\It\Maintenance\Maintenance_server;

use App\Http\Controllers\Controller;
use App\Models\Informasi\Kantor;
use App\Models\It\Maintenance\Maintenance_server\KategoriMaintenanceServer;
use App\Models\It\Maintenance\Maintenance_server\MaintenanceServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MaintenanceServerController extends Controller implements HasMiddleware
{

    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_maintenance_server', only: ['index']),
            new Middleware('permission:view_maintenance_server', only: ['data']),
            new Middleware('permission:create_maintenance_server', only: ['create']),
            new Middleware('permission:create_maintenance_server', only: ['store']),
            new Middleware('permission:update_maintenance_server', only: ['update']),
            new Middleware('permission:update_maintenance_server', only: ['edit']),
            new Middleware('permission:delete_maintenance_server', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriMaintenanceServer::all()->pluck('kategori_maintenance_server', 'id_kategori_maintenance_server'); //untuk mengambil data supplier

        // Mengambil data kantor
        $kantor = Kantor::all()->pluck('nama_kantor', 'id_kantor');
        
        return view('it.maintenance.maintenance_server.index', compact('kategori', 'kantor'));
    }

    public function data()
    {
        $maintenance_server = MaintenanceServer::leftJoin('kategori_maintenance_server', 'maintenance_server.id_kategori_maintenance_server', '=', 'kategori_maintenance_server.id_kategori_maintenance_server')
        ->leftJoin('kantor', 'maintenance_server.id_kantor', '=', 'kantor.id_kantor')
        ->select('maintenance_server.*', 'kategori_maintenance_server.kategori_maintenance_server', 'kantor.nama_kantor')
        ->orderBy('maintenance_server.id_maintenance_server', 'desc')
        ->get();

        return datatables()
            ->of($maintenance_server)
            ->addIndexColumn()
            ->addColumn('nama_kategori', function ($maintenance_server) {
                return $maintenance_server->kategori_maintenance_server;
            })
            ->addColumn('nama_kantor', function ($maintenance_server) {
                return $maintenance_server->nama_kantor;
            })
            ->addColumn('tanggal_maintenance_server', function ($maintenance_server) {
                return '<span class="badge badge-success text-sm font-weight-normal">'. $maintenance_server->tanggal_maintenance_server .'</span>';
            })
            ->addColumn('aksi', function ($maintenance_server) {
                $viewButton = auth()->user()->can('read_maintenance_server') 
                    ? '<button type="button" onclick="viewForm(`'. route('maintenance_server.show', $maintenance_server->id_maintenance_server) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
    
                $editButton = auth()->user()->can('update_maintenance_server') 
                    ? '<button type="button" onclick="editForm(`'. route('maintenance_server.update', $maintenance_server->id_maintenance_server) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';
    
                $deleteButton = auth()->user()->can('delete_maintenance_server') 
                    ? '<button type="button" onclick="deleteData(`'. route('maintenance_server.destroy', $maintenance_server->id_maintenance_server) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
                    : '';
    
                return '
                <div class="btn-group">
                    '. $viewButton .'
                    '. $editButton .'
                    '. $deleteButton .'
                </div>
                ';
            })
            ->rawColumns(['aksi', 'status', 'tanggal_maintenance_server'])
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
            'tanggal_maintenance_server' => 'required|date',
            'id_kategori_maintenance_server' => 'required|string',
            'kondisi_maintenance_server' => 'required|string',
            'keterangan_maintenance_server' => 'required|string',
            'id_kantor' => 'required|string',
            'dicek_oleh' => 'required|string',
            'keterangan_tambahan_maintenance_server' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240', // Validation for each file
        ]);

        $maintenance_server = MaintenanceServer::create($validatedData);
    
        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            $fileNames = [];
    
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName(); // Ambil nama asli file
                $extension = $file->getClientOriginalExtension(); // Ambil ekstensi file
    
                // Menambahkan prefix time() sebelum nama file
                $newFileName = time() . '_' . $originalName;
    
                // Simpan file di storage dengan nama baru
                $file->storeAs('public/it/maintenance/maintenance_server', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Simpan nama file ke dalam kolom 'dokumentasi_db'
            $maintenance_server->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $maintenance_server = MaintenanceServer::findOrFail($id);

        return response()->json($maintenance_server);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaintenanceServer $maintenanceServer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal_maintenance_server' => 'required|date',
            'id_kategori_maintenance_server' => 'required|string',
            'kondisi_maintenance_server' => 'required|string',
            'keterangan_maintenance_server' => 'required|string',
            'id_kantor' => 'required|string',
            'dicek_oleh' => 'required|string',
            'keterangan_tambahan_maintenance_server' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240', // Validation for each file
        ]);

        // Cari data berdasarkan ID
        $maintenance_server = MaintenanceServer::findOrFail($id);
    
        // Update data selain file
        $maintenance_server->update($validatedData);
    
        // Proses jika ada file baru yang diunggah
        if ($request->hasFile('dokumentasi')) {
            // Hapus file lama yang sudah ada
            if ($maintenance_server->dokumentasi_db) {
                // Split nama file menjadi array berdasarkan koma
                $oldFiles = explode(',', $maintenance_server->dokumentasi_db);
    
                // Hapus setiap file lama dari storage
                foreach ($oldFiles as $oldFile) {
                    $oldFilePath = storage_path('app/public/it/maintenance/maintenance_server/' . $oldFile);
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
                $file->storeAs('public/it/maintenance/maintenance_server', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Update kolom 'dokumentasi_db' dengan nama file yang baru
            $maintenance_server->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $maintenance_server = MaintenanceServer::findOrFail($id);
    
        // Hapus file-file yang terasosiasi jika ada
        if ($maintenance_server->dokumentasi_db) {
            // Split nama file menjadi array berdasarkan koma
            $fileNames = explode(',', $maintenance_server->dokumentasi_db);
    
            // Hapus setiap file dari storage
            foreach ($fileNames as $fileName) {
                $filePath = storage_path('app/public/it/maintenance/maintenance_server/' . $fileName);
    
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file dari server
                }
            }
        }
    
        // Hapus record dari database
        $maintenance_server->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
