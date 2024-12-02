<?php

namespace App\Http\Controllers\It\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\It\Maintenance\PengecekanSuhu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PengecekanSuhuController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_pengecekan_suhu', only: ['index']),
            new Middleware('permission:view_pengecekan_suhu', only: ['data']),
            new Middleware('permission:create_pengecekan_suhu', only: ['clone']),
            new Middleware('permission:create_pengecekan_suhu', only: ['store']),
            new Middleware('permission:update_pengecekan_suhu', only: ['update']),
            new Middleware('permission:update_pengecekan_suhu', only: ['edit']),
            new Middleware('permission:delete_pengecekan_suhu', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('it.maintenance.pengecekan_suhu.index');
    }

    public function data()
    {
        $pengecekan_suhu = PengecekanSuhu::orderBy('id_pengecekan_suhu', 'desc')->get();

        return datatables()
            ->of($pengecekan_suhu)
            ->addIndexColumn()
            ->addColumn('tanggal_pengecekan_suhu', function ($pengecekan_suhu) {
                return '<span class="badge badge-success text-sm font-weight-normal">'. $pengecekan_suhu->tanggal_pengecekan_suhu .'</span>';
            })
            ->addColumn('aksi', function ($pengecekan_suhu) {
                $viewButton = auth()->user()->can('read_pengecekan_suhu') 
                    ? '<button type="button" onclick="viewForm(`'. route('pengecekan_suhu.show', $pengecekan_suhu->id_pengecekan_suhu) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
    
                $editButton = auth()->user()->can('update_pengecekan_suhu') 
                    ? '<button type="button" onclick="editForm(`'. route('pengecekan_suhu.update', $pengecekan_suhu->id_pengecekan_suhu) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';
    
                $deleteButton = auth()->user()->can('delete_pengecekan_suhu') 
                    ? '<button type="button" onclick="deleteData(`'. route('pengecekan_suhu.destroy', $pengecekan_suhu->id_pengecekan_suhu) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
                    : '';

                $cloneButton = auth()->user()->can('update_pengecekan_suhu')
                    ? '<button type="button" onclick="cloneForm(`'. route('pengecekan_suhu.clone', $pengecekan_suhu->id_pengecekan_suhu) .'`)" class="btn btn-success"><i class="fa fa-copy"></i></button>' 
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
            ->rawColumns(['aksi', 'status', 'tanggal_pengecekan_suhu'])
            ->make(true);
    }

    public function clone($id)
    {
        $pengecekan_suhu = PengecekanSuhu::find($id);

        if (!$pengecekan_suhu) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Return the pengecekan_suhu data for cloning purpose
        return response()->json($pengecekan_suhu);
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
            'tanggal_pengecekan_suhu' => 'required|date',
            'suhu_pagi' => 'required|string',
            'kondisi_pagi' => 'nullable|string',
            'keterangan_tambahan_pagi' => 'nullable|string',
            'dicek_oleh' => 'required|string',
            'suhu_sore' => 'nullable|string',
            'kondisi_sore' => 'nullable|string',
            'kesimpulan' => 'nullable|string',
            'keterangan_tambahan_sore' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240', // Validation for each file
        ]);

        $pengecekan_suhu = PengecekanSuhu::create($validatedData);
    
        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            $fileNames = [];
    
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName(); // Ambil nama asli file
                $extension = $file->getClientOriginalExtension(); // Ambil ekstensi file
    
                // Menambahkan prefix time() sebelum nama file
                $newFileName = time() . '_' . $originalName;
    
                // Simpan file di storage dengan nama baru
                $file->storeAs('public/it/maintenance/pengecekan_suhu', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Simpan nama file ke dalam kolom 'dokumentasi_db'
            $pengecekan_suhu->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $pengecekan_suhu = PengecekanSuhu::findOrFail($id);

        return response()->json($pengecekan_suhu);
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
            'tanggal_pengecekan_suhu' => 'required|date',
            'suhu_pagi' => 'required|string',
            'kondisi_pagi' => 'required|string',
            'keterangan_tambahan_pagi' => 'nullable|string',
            'dicek_oleh' => 'required|string',
            'suhu_sore' => 'nullable|string',
            'kondisi_sore' => 'nullable|string',
            'kesimpulan' => 'required|string',
            'keterangan_tambahan_sore' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240', // Validation for each file
        ]);

        // Cari data berdasarkan ID
        $pengecekan_suhu = PengecekanSuhu::findOrFail($id);
    
        // Update data selain file
        $pengecekan_suhu->update($validatedData);
    
        // Proses jika ada file baru yang diunggah
        if ($request->hasFile('dokumentasi')) {
            // Hapus file lama yang sudah ada
            if ($pengecekan_suhu->dokumentasi_db) {
                // Split nama file menjadi array berdasarkan koma
                $oldFiles = explode(',', $pengecekan_suhu->dokumentasi_db);
    
                // Hapus setiap file lama dari storage
                foreach ($oldFiles as $oldFile) {
                    $oldFilePath = storage_path('app/public/it/maintenance/pengecekan_suhu/' . $oldFile);
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
                $file->storeAs('public/it/maintenance/pengecekan_suhu', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Update kolom 'dokumentasi_db' dengan nama file yang baru
            $pengecekan_suhu->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $pengecekan_suhu = PengecekanSuhu::findOrFail($id);
    
        // Hapus file-file yang terasosiasi jika ada
        if ($pengecekan_suhu->dokumentasi_db) {
            // Split nama file menjadi array berdasarkan koma
            $fileNames = explode(',', $pengecekan_suhu->dokumentasi_db);
    
            // Hapus setiap file dari storage
            foreach ($fileNames as $fileName) {
                $filePath = storage_path('app/public/it/maintenance/pengecekan_suhu/' . $fileName);
    
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file dari server
                }
            }
        }
    
        // Hapus record dari database
        $pengecekan_suhu->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
