<?php

namespace App\Http\Controllers\Produk_perusahaan\Dana;

use App\Http\Controllers\Controller;
use App\Models\Produk_perusahaan\Dana\KategoriProdukDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class KategoriProdukDanaController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_kategori_produk_dana', only: ['index']),
            new Middleware('permission:view_kategori_produk_dana', only: ['data']),
            new Middleware('permission:create_kategori_produk_dana', only: ['clone']),
            new Middleware('permission:create_kategori_produk_dana', only: ['store']),
            new Middleware('permission:update_kategori_produk_dana', only: ['update']),
            new Middleware('permission:update_kategori_produk_dana', only: ['edit']),
            new Middleware('permission:delete_kategori_produk_dana', only: ['destroy']),
        ];
    }

    public function index()
    {
        return view('produk_perusahaan.dana.kategori_produk_dana.index');
    }

    public function data()
    {
        $kategori_produk_dana = KategoriProdukDana::orderBy('id_kategori_produk_dana', 'asc')->get();

        return datatables()
            ->of($kategori_produk_dana)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori_produk_dana) {
                
                $viewButton = auth()->user()->can('read_kategori_produk_dana') 
                    ? '<button type="button" onclick="viewForm(`'. route('kategori_produk_dana.show', $kategori_produk_dana->id_kategori_produk_dana) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
                
                    
                $editButton = auth()->user()->can('update_kategori_produk_dana') 
                    ? '<button type="button" onclick="editForm(`'. route('kategori_produk_dana.update', $kategori_produk_dana->id_kategori_produk_dana) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';
                    
                $cloneButton = auth()->user()->can('update_kategori_produk_dana')
                    ? '<button type="button" onclick="cloneForm(`'. route('kategori_produk_dana.clone', $kategori_produk_dana->id_kategori_produk_dana) .'`)" class="btn btn-success"><i class="fa fa-copy"></i></button>' 
                    : '';

                $deleteButton = auth()->user()->can('delete_kategori_produk_dana') 
                    ? '<button type="button" onclick="deleteData(`'. route('kategori_produk_dana.destroy', $kategori_produk_dana->id_kategori_produk_dana) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
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
        $kategori_produk_dana = KategoriProdukDana::find($id);

        if (!$kategori_produk_dana) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Return the kategori_produk_dana data for cloning purpose
        return response()->json($kategori_produk_dana);
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

        $kategori_produk_dana = KategoriProdukDana::create($validatedData);
    
        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            $fileNames = [];
    
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName(); // Ambil nama asli file
                $extension = $file->getClientOriginalExtension(); // Ambil ekstensi file
    
                // Menambahkan prefix time() sebelum nama file
                $newFileName = time() . '_' . $originalName;
    
                // Simpan file di storage dengan nama baru
                $file->storeAs('public/produk_perusahaan/dana/kategori_produk_dana', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Simpan nama file ke dalam kolom 'dokumentasi_db'
            $kategori_produk_dana->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $kategori_produk_dana = KategoriProdukDana::findOrFail($id);

        return response()->json($kategori_produk_dana);
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
         $kategori_produk_dana = KategoriProdukDana::findOrFail($id);
    
         // Update data selain file
         $kategori_produk_dana->update($validatedData);
     
         // Proses jika ada file baru yang diunggah
         if ($request->hasFile('dokumentasi')) {
             // Hapus file lama yang sudah ada
             if ($kategori_produk_dana->dokumentasi_db) {
                 // Split nama file menjadi array berdasarkan koma
                 $oldFiles = explode(',', $kategori_produk_dana->dokumentasi_db);
     
                 // Hapus setiap file lama dari storage
                 foreach ($oldFiles as $oldFile) {
                     $oldFilePath = storage_path('app/public/produk_perusahaan/dana/kategori_produk_dana/' . $oldFile);
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
                 $file->storeAs('public/produk_perusahaan/dana/kategori_produk_dana', $newFileName);
     
                 // Simpan nama file baru ke array
                 $fileNames[] = $newFileName;
             }
     
             // Update kolom 'dokumentasi_db' dengan nama file yang baru
             $kategori_produk_dana->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $kategori_produk_dana = KategoriProdukDana::findOrFail($id);
    
        // Hapus file-file yang terasosiasi jika ada
        if ($kategori_produk_dana->dokumentasi_db) {
            // Split nama file menjadi array berdasarkan koma
            $fileNames = explode(',', $kategori_produk_dana->dokumentasi_db);
    
            // Hapus setiap file dari storage
            foreach ($fileNames as $fileName) {
                $filePath = storage_path('app/public/produk_perusahaan/dana/kategori_produk_dana/' . $fileName);
    
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file dari server
                }
            }
        }
    
        // Hapus record dari database
        $kategori_produk_dana->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}


