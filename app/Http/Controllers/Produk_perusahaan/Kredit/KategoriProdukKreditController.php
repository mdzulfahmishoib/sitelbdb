<?php

namespace App\Http\Controllers\Produk_perusahaan\Kredit;

use App\Http\Controllers\Controller;
use App\Models\Produk_perusahaan\Kredit\KategoriProdukKredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class KategoriProdukKreditController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_kategori_produk_kredit', only: ['index']),
            new Middleware('permission:view_kategori_produk_kredit', only: ['data']),
            new Middleware('permission:create_kategori_produk_kredit', only: ['clone']),
            new Middleware('permission:create_kategori_produk_kredit', only: ['store']),
            new Middleware('permission:update_kategori_produk_kredit', only: ['update']),
            new Middleware('permission:update_kategori_produk_kredit', only: ['edit']),
            new Middleware('permission:delete_kategori_produk_kredit', only: ['destroy']),
        ];
    }

    public function index()
    {
        return view('produk_perusahaan.kredit.kategori_produk_kredit.index');
    }

    public function data()
    {
        $kategori_produk_kredit = KategoriProdukKredit::orderBy('id_kategori_produk_kredit', 'asc')->get();

        return datatables()
            ->of($kategori_produk_kredit)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori_produk_kredit) {
                
                $viewButton = auth()->user()->can('read_kategori_produk_kredit') 
                    ? '<button type="button" onclick="viewForm(`'. route('kategori_produk_kredit.show', $kategori_produk_kredit->id_kategori_produk_kredit) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
                
                    
                $editButton = auth()->user()->can('update_kategori_produk_kredit') 
                    ? '<button type="button" onclick="editForm(`'. route('kategori_produk_kredit.update', $kategori_produk_kredit->id_kategori_produk_kredit) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';
                    
                $cloneButton = auth()->user()->can('update_kategori_produk_kredit')
                    ? '<button type="button" onclick="cloneForm(`'. route('kategori_produk_kredit.clone', $kategori_produk_kredit->id_kategori_produk_kredit) .'`)" class="btn btn-success"><i class="fa fa-copy"></i></button>' 
                    : '';

                $deleteButton = auth()->user()->can('delete_kategori_produk_kredit') 
                    ? '<button type="button" onclick="deleteData(`'. route('kategori_produk_kredit.destroy', $kategori_produk_kredit->id_kategori_produk_kredit) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
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
        $kategori_produk_kredit = KategoriProdukKredit::find($id);

        if (!$kategori_produk_kredit) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Return the kategori_produk_kredit data for cloning purpose
        return response()->json($kategori_produk_kredit);
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

        $kategori_produk_kredit = KategoriProdukKredit::create($validatedData);
    
        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            $fileNames = [];
    
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName(); // Ambil nama asli file
                $extension = $file->getClientOriginalExtension(); // Ambil ekstensi file
    
                // Menambahkan prefix time() sebelum nama file
                $newFileName = time() . '_' . $originalName;
    
                // Simpan file di storage dengan nama baru
                $file->storeAs('public/produk_perusahaan/kredit/kategori_produk_kredit', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Simpan nama file ke dalam kolom 'dokumentasi_db'
            $kategori_produk_kredit->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $kategori_produk_kredit = KategoriProdukKredit::findOrFail($id);

        return response()->json($kategori_produk_kredit);
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
         $kategori_produk_kredit = KategoriProdukKredit::findOrFail($id);
    
         // Update data selain file
         $kategori_produk_kredit->update($validatedData);
     
         // Proses jika ada file baru yang diunggah
         if ($request->hasFile('dokumentasi')) {
             // Hapus file lama yang sudah ada
             if ($kategori_produk_kredit->dokumentasi_db) {
                 // Split nama file menjadi array berdasarkan koma
                 $oldFiles = explode(',', $kategori_produk_kredit->dokumentasi_db);
     
                 // Hapus setiap file lama dari storage
                 foreach ($oldFiles as $oldFile) {
                     $oldFilePath = storage_path('app/public/produk_perusahaan/kredit/kategori_produk_kredit/' . $oldFile);
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
                 $file->storeAs('public/produk_perusahaan/kredit/kategori_produk_kredit', $newFileName);
     
                 // Simpan nama file baru ke array
                 $fileNames[] = $newFileName;
             }
     
             // Update kolom 'dokumentasi_db' dengan nama file yang baru
             $kategori_produk_kredit->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $kategori_produk_kredit = KategoriProdukKredit::findOrFail($id);
    
        // Hapus file-file yang terasosiasi jika ada
        if ($kategori_produk_kredit->dokumentasi_db) {
            // Split nama file menjadi array berdasarkan koma
            $fileNames = explode(',', $kategori_produk_kredit->dokumentasi_db);
    
            // Hapus setiap file dari storage
            foreach ($fileNames as $fileName) {
                $filePath = storage_path('app/public/produk_perusahaan/kredit/kategori_produk_kredit/' . $fileName);
    
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file dari server
                }
            }
        }
    
        // Hapus record dari database
        $kategori_produk_kredit->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}


