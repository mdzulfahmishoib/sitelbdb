<?php

namespace App\Http\Controllers\It\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\Informasi\Kantor;
use App\Models\It\Maintenance\PengecekanUnitBagian;
use App\Models\Informasi\UnitBagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PengecekanUnitBagianController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_pengecekan_unit_bagian', only: ['index']),
            new Middleware('permission:view_pengecekan_unit_bagian', only: ['data']),
            new Middleware('permission:create_pengecekan_unit_bagian', only: ['create']),
            new Middleware('permission:create_pengecekan_unit_bagian', only: ['store']),
            new Middleware('permission:update_pengecekan_unit_bagian', only: ['update']),
            new Middleware('permission:update_pengecekan_unit_bagian', only: ['edit']),
            new Middleware('permission:delete_pengecekan_unit_bagian', only: ['destroy']),
        ];
    }

    public function index()
    {
        $unit_bagian = UnitBagian::all()->pluck('nama_unit_bagian', 'id_unit_bagian');
        $kantor = Kantor::all()->pluck('nama_kantor', 'id_kantor');
        
        return view('it.maintenance.pengecekan_unit_bagian.index', compact('unit_bagian', 'kantor'));
    }

    public function data()
    {
        $pengecekan_unit_bagian = PengecekanUnitBagian::leftJoin('kantor', 'pengecekan_unit_bagian.id_kantor', '=', 'kantor.id_kantor')
            ->leftJoin('unit_bagian', 'pengecekan_unit_bagian.id_unit_bagian', '=', 'unit_bagian.id_unit_bagian')
            ->select('pengecekan_unit_bagian.*', 'kantor.nama_kantor', 'unit_bagian.nama_unit_bagian')
            ->orderBy('pengecekan_unit_bagian.id_pengecekan_unit_bagian', 'desc')
            ->get();

        return datatables()
            ->of($pengecekan_unit_bagian)
            ->addIndexColumn()
            ->addColumn('status', function ($pengecekan_unit_bagian) {
                $class = ($pengecekan_unit_bagian->status === 'Tidak Disetujui' || $pengecekan_unit_bagian->status === 'Belum Disetujui') 
                         ? 'badge badge-danger' 
                         : 'badge badge-success';
                return '<span class="'. $class .' text-xs font-weight-normal">'. $pengecekan_unit_bagian->status .'</span>';
            })
            ->addColumn('tanggal_pengecekan_unit_bagian', function ($pengecekan_unit_bagian) {
                return '<span class="badge badge-success text-sm font-weight-normal">'. $pengecekan_unit_bagian->tanggal_pengecekan_unit_bagian .'</span>';
            })
            ->addColumn('nama_unit_bagian', function ($pengecekan_unit_bagian) {
                return $pengecekan_unit_bagian->nama_unit_bagian;
            })
            ->addColumn('nama_kantor', function ($pengecekan_unit_bagian) {
                return $pengecekan_unit_bagian->nama_kantor;
            })
            ->addColumn('aksi', function ($pengecekan_unit_bagian) {
                
                $viewButton = auth()->user()->can('read_pengecekan_unit_bagian') 
                    ? '<button type="button" onclick="viewForm(`'. route('pengecekan_unit_bagian.show', $pengecekan_unit_bagian->id_pengecekan_unit_bagian) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
                
                    
                $editButton = auth()->user()->can('update_pengecekan_unit_bagian') 
                    ? '<button type="button" onclick="editForm(`'. route('pengecekan_unit_bagian.update', $pengecekan_unit_bagian->id_pengecekan_unit_bagian) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';

                $deleteButton = auth()->user()->can('delete_pengecekan_unit_bagian') 
                    ? '<button type="button" onclick="deleteData(`'. route('pengecekan_unit_bagian.destroy', $pengecekan_unit_bagian->id_pengecekan_unit_bagian) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
                    : '';


                return '
                <div class="btn-group">
                    '. $viewButton .'
                    '. $editButton .'
                    '. $deleteButton .'
                </div>
                ';
            })
            ->rawColumns(['aksi', 'status', 'tanggal_pengecekan_unit_bagian'])
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
            'id_kantor' => 'required|string',
            'id_unit_bagian' => 'required|string',
            'tanggal_pengecekan_unit_bagian' => 'required|string',
            'komputer_laptop' => 'nullable|string',
            'printer' => 'nullable|string',
            'scan' => 'nullable|string',
            'jaringan' => 'nullable|string',
            'mesin_hitung' => 'nullable|string',
            'windows' => 'nullable|string',
            'microsoft_office' => 'nullable|string',
            'antivirus' => 'nullable|string',
            'browser' => 'nullable|string',
            'cbs' => 'nullable|string',
            'cek_ktp' => 'nullable|string',
            'dvr_mikrotik' => 'nullable|string',
            'keterangan_tambahan' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240',
        ]);
    
        $pengecekan_unit_bagian = PengecekanUnitBagian::create($validatedData);
    
        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            $fileNames = [];
    
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName(); // Ambil nama asli file
                $extension = $file->getClientOriginalExtension(); // Ambil ekstensi file
    
                // Menambahkan prefix time() sebelum nama file
                $newFileName = time() . '_' . $originalName;
    
                // Simpan file di storage dengan nama baru
                $file->storeAs('public/it/maintenance/pengecekan_unit_bagian', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Simpan nama file ke dalam kolom 'dokumentasi_db'
            $pengecekan_unit_bagian->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $pengecekan_unit_bagian = PengecekanUnitBagian::findOrFail($id);

        return response()->json($pengecekan_unit_bagian);
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
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'id_kantor' => 'required|string',
            'id_unit_bagian' => 'required|string',
            'tanggal_pengecekan_unit_bagian' => 'required|string',
            'komputer_laptop' => 'nullable|string',
            'printer' => 'nullable|string',
            'scan' => 'nullable|string',
            'jaringan' => 'nullable|string',
            'mesin_hitung' => 'nullable|string',
            'windows' => 'nullable|string',
            'microsoft_office' => 'nullable|string',
            'antivirus' => 'nullable|string',
            'browser' => 'nullable|string',
            'cbs' => 'nullable|string',
            'cek_ktp' => 'nullable|string',
            'dvr_mikrotik' => 'nullable|string',
            'keterangan_tambahan' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240',
        ]);
    
        // Cari data berdasarkan ID
        $pengecekan_unit_bagian = PengecekanUnitBagian::findOrFail($id);
    
        // Update data selain file
        $pengecekan_unit_bagian->update($validatedData);
    
        // Proses jika ada file baru yang diunggah
        if ($request->hasFile('dokumentasi')) {
            // Hapus file lama yang sudah ada
            if ($pengecekan_unit_bagian->dokumentasi_db) {
                // Split nama file menjadi array berdasarkan koma
                $oldFiles = explode(',', $pengecekan_unit_bagian->dokumentasi_db);
    
                // Hapus setiap file lama dari storage
                foreach ($oldFiles as $oldFile) {
                    $oldFilePath = storage_path('app/public/it/maintenance/pengecekan_unit_bagian/' . $oldFile);
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
                $file->storeAs('public/it/maintenance/pengecekan_unit_bagian', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Update kolom 'dokumentasi_db' dengan nama file yang baru
            $pengecekan_unit_bagian->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $pengecekan_unit_bagian = PengecekanUnitBagian::findOrFail($id);
    
        // Hapus file-file yang terasosiasi jika ada
        if ($pengecekan_unit_bagian->dokumentasi_db) {
            // Split nama file menjadi array berdasarkan koma
            $fileNames = explode(',', $pengecekan_unit_bagian->dokumentasi_db);
    
            // Hapus setiap file dari storage
            foreach ($fileNames as $fileName) {
                $filePath = storage_path('app/public/it/maintenance/pengecekan_unit_bagian/' . $fileName);
    
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file dari server
                }
            }
        }
    
        // Hapus record dari database
        $pengecekan_unit_bagian->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
    
    

}
