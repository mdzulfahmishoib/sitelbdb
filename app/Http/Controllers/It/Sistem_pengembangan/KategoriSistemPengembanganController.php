<?php

namespace App\Http\Controllers\It\Sistem_pengembangan;

use App\Http\Controllers\Controller;
use App\Models\It\Sistem_pengembangan\KategoriSistemPengembangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class KategoriSistemPengembanganController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_sistem_pengembangan', only: ['index']),
            new Middleware('permission:view_sistem_pengembangan', only: ['data']),
            new Middleware('permission:create_sistem_pengembangan', only: ['clone']),
            new Middleware('permission:create_sistem_pengembangan', only: ['store']),
            new Middleware('permission:update_sistem_pengembangan', only: ['update']),
            new Middleware('permission:update_sistem_pengembangan', only: ['edit']),
            new Middleware('permission:delete_sistem_pengembangan', only: ['destroy']),
        ];
    }

    public function index()
    {
        return view('it.sistem_pengembangan.kategori_sistem_pengembangan.index');
    }

    public function data()
    {
        $kategori_sistem_pengembangan = KategoriSistemPengembangan::orderBy('id_kategori_sistem_pengembangan', 'asc')->get();

        return datatables()
            ->of($kategori_sistem_pengembangan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori_sistem_pengembangan) {
                
                $viewButton = auth()->user()->can('read_sistem_pengembangan') 
                    ? '<button type="button" onclick="viewForm(`'. route('kategori_sistem_pengembangan.show', $kategori_sistem_pengembangan->id_kategori_sistem_pengembangan) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
                
                    
                $editButton = auth()->user()->can('update_sistem_pengembangan') 
                    ? '<button type="button" onclick="editForm(`'. route('kategori_sistem_pengembangan.update', $kategori_sistem_pengembangan->id_kategori_sistem_pengembangan) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';
                    
                $cloneButton = auth()->user()->can('update_sistem_pengembangan')
                    ? '<button type="button" onclick="cloneForm(`'. route('kategori_sistem_pengembangan.clone', $kategori_sistem_pengembangan->id_kategori_sistem_pengembangan) .'`)" class="btn btn-success"><i class="fa fa-copy"></i></button>' 
                    : '';

                $deleteButton = auth()->user()->can('delete_sistem_pengembangan') 
                    ? '<button type="button" onclick="deleteData(`'. route('kategori_sistem_pengembangan.destroy', $kategori_sistem_pengembangan->id_kategori_sistem_pengembangan) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
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
            ->rawColumns(['aksi', 'status'])
            ->make(true);
    }

    public function clone($id)
    {
        $kategori_sistem_pengembangan = KategoriSistemPengembangan::find($id);

        if (!$kategori_sistem_pengembangan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Return the kategori_sistem_pengembangan data for cloning purpose
        return response()->json($kategori_sistem_pengembangan);
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
            'judul' => 'required|string',
            'deskripsi' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240',
        ]);

        $kategori_sistem_pengembangan = KategoriSistemPengembangan::create($validatedData);
    
        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            $fileNames = [];
    
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName(); // Ambil nama asli file
                $extension = $file->getClientOriginalExtension(); // Ambil ekstensi file
    
                // Menambahkan prefix time() sebelum nama file
                $newFileName = time() . '_' . $originalName;
    
                // Simpan file di storage dengan nama baru
                $file->storeAs('public/it/sistem_pengembangan/kategori_sistem_pengembangan', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Simpan nama file ke dalam kolom 'dokumentasi_db'
            $kategori_sistem_pengembangan->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $kategori_sistem_pengembangan = KategoriSistemPengembangan::findOrFail($id);

        return response()->json($kategori_sistem_pengembangan);
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
            'judul' => 'required|string',
            'deskripsi' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240', // Validation for each file
        ]);

         // Cari data berdasarkan ID
         $kategori_sistem_pengembangan = KategoriSistemPengembangan::findOrFail($id);
    
         // Update data selain file
         $kategori_sistem_pengembangan->update($validatedData);
     
         // Proses jika ada file baru yang diunggah
         if ($request->hasFile('dokumentasi')) {
             // Hapus file lama yang sudah ada
             if ($kategori_sistem_pengembangan->dokumentasi_db) {
                 // Split nama file menjadi array berdasarkan koma
                 $oldFiles = explode(',', $kategori_sistem_pengembangan->dokumentasi_db);
     
                 // Hapus setiap file lama dari storage
                 foreach ($oldFiles as $oldFile) {
                     $oldFilePath = storage_path('app/public/it/sistem_pengembangan/kategori_sistem_pengembangan/' . $oldFile);
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
                 $file->storeAs('public/it/sistem_pengembangan/kategori_sistem_pengembangan', $newFileName);
     
                 // Simpan nama file baru ke array
                 $fileNames[] = $newFileName;
             }
     
             // Update kolom 'dokumentasi_db' dengan nama file yang baru
             $kategori_sistem_pengembangan->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $kategori_sistem_pengembangan = KategoriSistemPengembangan::findOrFail($id);
    
        // Hapus file-file yang terasosiasi jika ada
        if ($kategori_sistem_pengembangan->dokumentasi_db) {
            // Split nama file menjadi array berdasarkan koma
            $fileNames = explode(',', $kategori_sistem_pengembangan->dokumentasi_db);
    
            // Hapus setiap file dari storage
            foreach ($fileNames as $fileName) {
                $filePath = storage_path('app/public/it/sistem_pengembangan/kategori_sistem_pengembangan/' . $fileName);
    
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file dari server
                }
            }
        }
    
        // Hapus record dari database
        $kategori_sistem_pengembangan->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}


