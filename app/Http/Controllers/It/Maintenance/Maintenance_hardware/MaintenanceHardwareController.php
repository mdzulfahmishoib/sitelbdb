<?php

namespace App\Http\Controllers\It\Maintenance\Maintenance_hardware;

use App\Http\Controllers\Controller;
use App\Models\Informasi\Kantor;
use App\Models\It\Maintenance\Maintenance_hardware\KategoriMaintenanceHardware;
use App\Models\It\Maintenance\Maintenance_hardware\MaintenanceHardware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MaintenanceHardwareController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_maintenance_hardware', only: ['index']),
            new Middleware('permission:view_maintenance_hardware', only: ['data']),
            new Middleware('permission:create_maintenance_hardware', only: ['create']),
            new Middleware('permission:create_maintenance_hardware', only: ['store']),
            new Middleware('permission:update_maintenance_hardware', only: ['update']),
            new Middleware('permission:update_maintenance_hardware', only: ['edit']),
            new Middleware('permission:delete_maintenance_hardware', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriMaintenanceHardware::all()->pluck('kategori_maintenance_hardware', 'id_kategori_maintenance_hardware'); //untuk mengambil data supplier

        // Mengambil data kantor
        $kantor = Kantor::all()->pluck('nama_kantor', 'id_kantor');
        
        return view('it.maintenance.maintenance_hardware.index', compact('kategori', 'kantor'));
    }

    public function data()
    {
        $maintenance_hardware = MaintenanceHardware::leftJoin('kategori_maintenance_hardware', 'maintenance_hardware.id_kategori_maintenance_hardware', '=', 'kategori_maintenance_hardware.id_kategori_maintenance_hardware')
        ->leftJoin('kantor', 'maintenance_hardware.id_kantor', '=', 'kantor.id_kantor')
        ->select('maintenance_hardware.*', 'kategori_maintenance_hardware.kategori_maintenance_hardware', 'kantor.nama_kantor')
        ->orderBy('maintenance_hardware.id_maintenance_hardware', 'desc')
        ->get();

        return datatables()
            ->of($maintenance_hardware)
            ->addIndexColumn()
            ->addColumn('nama_kategori', function ($maintenance_hardware) {
                return $maintenance_hardware->kategori_maintenance_hardware;
            })
            ->addColumn('nama_kantor', function ($maintenance_hardware) {
                return $maintenance_hardware->nama_kantor;
            })
            ->addColumn('tanggal_maintenance_hardware', function ($maintenance_hardware) {
                return '<span class="badge badge-success text-sm font-weight-normal">'. $maintenance_hardware->tanggal_maintenance_hardware .'</span>';
            })
            ->addColumn('aksi', function ($maintenance_hardware) {
                $viewButton = auth()->user()->can('read_maintenance_hardware') 
                    ? '<button type="button" onclick="viewForm(`'. route('maintenance_hardware.show', $maintenance_hardware->id_maintenance_hardware) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
    
                $editButton = auth()->user()->can('update_maintenance_hardware') 
                    ? '<button type="button" onclick="editForm(`'. route('maintenance_hardware.update', $maintenance_hardware->id_maintenance_hardware) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';
    
                $deleteButton = auth()->user()->can('delete_maintenance_hardware') 
                    ? '<button type="button" onclick="deleteData(`'. route('maintenance_hardware.destroy', $maintenance_hardware->id_maintenance_hardware) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
                    : '';
    
                return '
                <div class="btn-group">
                    '. $viewButton .'
                    '. $editButton .'
                    '. $deleteButton .'
                </div>
                ';
            })
            ->rawColumns(['aksi', 'status', 'tanggal_maintenance_hardware'])
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
            'tanggal_maintenance_hardware' => 'required|date',
            'id_kategori_maintenance_hardware' => 'required|string',
            'kondisi_maintenance_hardware' => 'required|string',
            'keterangan_maintenance_hardware' => 'required|string',
            'id_kantor' => 'required|string',
            'dicek_oleh' => 'required|string',
            'keterangan_tambahan_maintenance_hardware' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240', // Validation for each file
        ]);

        $maintenance_hardware = MaintenanceHardware::create($validatedData);
    
        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            $fileNames = [];
    
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName(); // Ambil nama asli file
                $extension = $file->getClientOriginalExtension(); // Ambil ekstensi file
    
                // Menambahkan prefix time() sebelum nama file
                $newFileName = time() . '_' . $originalName;
    
                // Simpan file di storage dengan nama baru
                $file->storeAs('public/it/maintenance/maintenance_hardware', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Simpan nama file ke dalam kolom 'dokumentasi_db'
            $maintenance_hardware->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $maintenance_hardware = MaintenanceHardware::findOrFail($id);

        return response()->json($maintenance_hardware);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaintenanceHardware $maintenanceHardware)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal_maintenance_hardware' => 'required|date',
            'id_kategori_maintenance_hardware' => 'required|string',
            'kondisi_maintenance_hardware' => 'required|string',
            'keterangan_maintenance_hardware' => 'required|string',
            'id_kantor' => 'required|string',
            'dicek_oleh' => 'required|string',
            'keterangan_tambahan_maintenance_hardware' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240',
        ]);

        // Cari data berdasarkan ID
        $maintenance_hardware = MaintenanceHardware::findOrFail($id);
    
        // Update data selain file
        $maintenance_hardware->update($validatedData);
    
        // Proses jika ada file baru yang diunggah
        if ($request->hasFile('dokumentasi')) {
            // Hapus file lama yang sudah ada
            if ($maintenance_hardware->dokumentasi_db) {
                // Split nama file menjadi array berdasarkan koma
                $oldFiles = explode(',', $maintenance_hardware->dokumentasi_db);
    
                // Hapus setiap file lama dari storage
                foreach ($oldFiles as $oldFile) {
                    $oldFilePath = storage_path('app/public/it/maintenance/maintenance_hardware/' . $oldFile);
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
                $file->storeAs('public/it/maintenance/maintenance_hardware', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Update kolom 'dokumentasi_db' dengan nama file yang baru
            $maintenance_hardware->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $maintenance_hardware = MaintenanceHardware::findOrFail($id);
    
        // Hapus file-file yang terasosiasi jika ada
        if ($maintenance_hardware->dokumentasi_db) {
            // Split nama file menjadi array berdasarkan koma
            $fileNames = explode(',', $maintenance_hardware->dokumentasi_db);
    
            // Hapus setiap file dari storage
            foreach ($fileNames as $fileName) {
                $filePath = storage_path('app/public/it/maintenance/maintenance_hardware/' . $fileName);
    
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file dari server
                }
            }
        }
    
        // Hapus record dari database
        $maintenance_hardware->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
