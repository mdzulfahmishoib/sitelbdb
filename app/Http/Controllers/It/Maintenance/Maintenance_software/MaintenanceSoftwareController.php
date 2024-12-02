<?php

namespace App\Http\Controllers\It\Maintenance\Maintenance_software;

use App\Http\Controllers\Controller;
use App\Models\Informasi\Kantor;
use App\Models\It\Maintenance\Maintenance_software\KategoriMaintenanceSoftware;
use App\Models\It\Maintenance\Maintenance_software\MaintenanceSoftware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MaintenanceSoftwareController extends Controller implements HasMiddleware
{

    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_maintenance_software', only: ['index']),
            new Middleware('permission:view_maintenance_software', only: ['data']),
            new Middleware('permission:create_maintenance_software', only: ['create']),
            new Middleware('permission:create_maintenance_software', only: ['store']),
            new Middleware('permission:update_maintenance_software', only: ['update']),
            new Middleware('permission:update_maintenance_software', only: ['edit']),
            new Middleware('permission:delete_maintenance_software', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data kategori
        $kategori = KategoriMaintenanceSoftware::all()->pluck('kategori_maintenance_software', 'id_kategori_maintenance_software'); 

        // Mengambil data kantor
        $kantor = Kantor::all()->pluck('nama_kantor', 'id_kantor');

        // Mengembalikan tampilan dengan data kategori dan kantor
        return view('it.maintenance.maintenance_software.index', compact('kategori', 'kantor'));

    }

    public function data()
    {
        $maintenance_software = MaintenanceSoftware::leftJoin('kategori_maintenance_software', 'maintenance_software.id_kategori_maintenance_software', '=', 'kategori_maintenance_software.id_kategori_maintenance_software')
        ->leftJoin('kantor', 'maintenance_software.id_kantor', '=', 'kantor.id_kantor')
        ->select('maintenance_software.*', 'kategori_maintenance_software.kategori_maintenance_software', 'kantor.nama_kantor')
        ->orderBy('maintenance_software.id_maintenance_software', 'desc')
        ->get();

        return datatables()
            ->of($maintenance_software)
            ->addIndexColumn()
            ->addColumn('nama_kategori', function ($maintenance_software) {
                return $maintenance_software->kategori_maintenance_software;
            })
            ->addColumn('nama_kantor', function ($maintenance_software) {
                return $maintenance_software->nama_kantor;
            })
            ->addColumn('tanggal_maintenance_software', function ($maintenance_software) {
                return '<span class="badge badge-success text-sm font-weight-normal">'. $maintenance_software->tanggal_maintenance_software .'</span>';
            })
            ->addColumn('aksi', function ($maintenance_software) {
                $viewButton = auth()->user()->can('read_maintenance_software') 
                    ? '<button type="button" onclick="viewForm(`'. route('maintenance_software.show', $maintenance_software->id_maintenance_software) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
    
                $editButton = auth()->user()->can('update_maintenance_software') 
                    ? '<button type="button" onclick="editForm(`'. route('maintenance_software.update', $maintenance_software->id_maintenance_software) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';
    
                $deleteButton = auth()->user()->can('delete_maintenance_software') 
                    ? '<button type="button" onclick="deleteData(`'. route('maintenance_software.destroy', $maintenance_software->id_maintenance_software) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
                    : '';
    
                return '
                <div class="btn-group">
                    '. $viewButton .'
                    '. $editButton .'
                    '. $deleteButton .'
                </div>
                ';
            })
            ->rawColumns(['aksi', 'status', 'tanggal_maintenance_software'])
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
            'tanggal_maintenance_software' => 'required|date',
            'id_kategori_maintenance_software' => 'required|string',
            'kondisi_maintenance_software' => 'required|string',
            'keterangan_maintenance_software' => 'required|string',
            'id_kantor' => 'required|string',
            'dicek_oleh' => 'required|string',
            'keterangan_tambahan_maintenance_software' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240', // Validation for each file
        ]);

        $maintenance_software = MaintenanceSoftware::create($validatedData);
    
        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            $fileNames = [];
    
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName(); // Ambil nama asli file
                $extension = $file->getClientOriginalExtension(); // Ambil ekstensi file
    
                // Menambahkan prefix time() sebelum nama file
                $newFileName = time() . '_' . $originalName;
    
                // Simpan file di storage dengan nama baru
                $file->storeAs('public/it/maintenance/maintenance_software', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Simpan nama file ke dalam kolom 'dokumentasi_db'
            $maintenance_software->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $maintenance_software = MaintenanceSoftware::findOrFail($id);

        return response()->json($maintenance_software);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaintenanceSoftware $maintenanceSoftware)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal_maintenance_software' => 'required|date',
            'id_kategori_maintenance_software' => 'required|string',
            'kondisi_maintenance_software' => 'required|string',
            'keterangan_maintenance_software' => 'required|string',
            'id_kantor' => 'required|string',
            'dicek_oleh' => 'required|string',
            'keterangan_tambahan_maintenance_software' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240', // Validation for each file
        ]);

        // Cari data berdasarkan ID
        $maintenance_software = MaintenanceSoftware::findOrFail($id);
    
        // Update data selain file
        $maintenance_software->update($validatedData);
    
        // Proses jika ada file baru yang diunggah
        if ($request->hasFile('dokumentasi')) {
            // Hapus file lama yang sudah ada
            if ($maintenance_software->dokumentasi_db) {
                // Split nama file menjadi array berdasarkan koma
                $oldFiles = explode(',', $maintenance_software->dokumentasi_db);
    
                // Hapus setiap file lama dari storage
                foreach ($oldFiles as $oldFile) {
                    $oldFilePath = storage_path('app/public/it/maintenance/maintenance_software/' . $oldFile);
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
                $file->storeAs('public/it/maintenance/maintenance_software', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Update kolom 'dokumentasi_db' dengan nama file yang baru
            $maintenance_software->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $maintenance_software = MaintenanceSoftware::findOrFail($id);
    
        // Hapus file-file yang terasosiasi jika ada
        if ($maintenance_software->dokumentasi_db) {
            // Split nama file menjadi array berdasarkan koma
            $fileNames = explode(',', $maintenance_software->dokumentasi_db);
    
            // Hapus setiap file dari storage
            foreach ($fileNames as $fileName) {
                $filePath = storage_path('app/public/it/maintenance/maintenance_software/' . $fileName);
    
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file dari server
                }
            }
        }
    
        // Hapus record dari database
        $maintenance_software->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
