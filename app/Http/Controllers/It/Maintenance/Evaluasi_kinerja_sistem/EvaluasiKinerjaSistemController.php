<?php

namespace App\Http\Controllers\It\Maintenance\Evaluasi_kinerja_sistem;

use App\Http\Controllers\Controller;
use App\Models\It\Maintenance\Evaluasi_kinerja_sistem\EvaluasiKinerjaSistem;
use App\Models\It\Maintenance\Evaluasi_kinerja_sistem\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class EvaluasiKinerjaSistemController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_evaluasi_kinerja_sistem', only: ['index']),
            new Middleware('permission:view_evaluasi_kinerja_sistem', only: ['data']),
            new Middleware('permission:create_evaluasi_kinerja_sistem', only: ['clone']),
            new Middleware('permission:create_evaluasi_kinerja_sistem', only: ['store']),
            new Middleware('permission:update_evaluasi_kinerja_sistem', only: ['update']),
            new Middleware('permission:update_evaluasi_kinerja_sistem', only: ['edit']),
            new Middleware('permission:delete_evaluasi_kinerja_sistem', only: ['destroy']),
        ];
    }

    public function index()
    {
        $vendor = Vendor::all()->pluck('nama_vendor', 'id_vendor');
        
        return view('it.maintenance.evaluasi_kinerja_sistem.index', compact('vendor'));
    }

    public function data()
    {
        $evaluasi_kinerja_sistem = EvaluasiKinerjaSistem::leftJoin('vendor', 'evaluasi_kinerja_sistem.id_vendor', '=', 'vendor.id_vendor')
            ->select('evaluasi_kinerja_sistem.*', 'vendor.nama_vendor')
            ->orderBy('evaluasi_kinerja_sistem.id_evaluasi_kinerja_sistem', 'desc')
            ->get();

        return datatables()
            ->of($evaluasi_kinerja_sistem)
            ->addIndexColumn()
            ->addColumn('status', function ($evaluasi_kinerja_sistem) {
                $class = $evaluasi_kinerja_sistem->status === 'Belum Selesai' ? 'badge badge-danger' : 'badge badge-success';
                return '<span class="'. $class .' text-xs font-weight-normal">'. $evaluasi_kinerja_sistem->status .'</span>';
            })
            ->addColumn('tanggal_evaluasi_kinerja_sistem', function ($evaluasi_kinerja_sistem) {
                return '<span class="badge badge-success text-sm font-weight-normal">'. $evaluasi_kinerja_sistem->tanggal_evaluasi_kinerja_sistem .'</span>';
            })
            ->addColumn('aksi', function ($evaluasi_kinerja_sistem) {
                
                $viewButton = auth()->user()->can('read_evaluasi_kinerja_sistem') 
                    ? '<button type="button" onclick="viewForm(`'. route('evaluasi_kinerja_sistem.show', $evaluasi_kinerja_sistem->id_evaluasi_kinerja_sistem) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
                
                    
                $editButton = auth()->user()->can('update_evaluasi_kinerja_sistem') 
                    ? '<button type="button" onclick="editForm(`'. route('evaluasi_kinerja_sistem.update', $evaluasi_kinerja_sistem->id_evaluasi_kinerja_sistem) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';
                    
                $cloneButton = auth()->user()->can('update_evaluasi_kinerja_sistem')
                    ? '<button type="button" onclick="cloneForm(`'. route('evaluasi_kinerja_sistem.clone', $evaluasi_kinerja_sistem->id_evaluasi_kinerja_sistem) .'`)" class="btn btn-success"><i class="fa fa-copy"></i></button>' 
                    : '';

                $deleteButton = auth()->user()->can('delete_evaluasi_kinerja_sistem') 
                    ? '<button type="button" onclick="deleteData(`'. route('evaluasi_kinerja_sistem.destroy', $evaluasi_kinerja_sistem->id_evaluasi_kinerja_sistem) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
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
            ->rawColumns(['aksi', 'status', 'tanggal_evaluasi_kinerja_sistem'])
            ->make(true);
    }

    public function clone($id)
    {
        $evaluasi_kinerja_sistem = EvaluasiKinerjaSistem::find($id);

        if (!$evaluasi_kinerja_sistem) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Return the evaluasi_kinerja_sistem data for cloning purpose
        return response()->json($evaluasi_kinerja_sistem);
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
            'tanggal_evaluasi_kinerja_sistem' => 'required|date',
            'id_vendor' => 'required|string',
            'kepatuhan_kontrak' => 'nullable|string',
            'keandalan_kualitas_layanan' => 'nullable|string',
            'ketepatan_waktu_pelayanan' => 'nullable|string',
            'responsif_keluhan' => 'nullable|string',
            'kepuasan_layanan' => 'nullable|string',
            'standar_kualitas' => 'nullable|string',
            'sumber_daya_kualitas' => 'nullable|string',
            'proses_pengujian_pengendalian_kualitas' => 'nullable|string',
            'kualitas_laporan' => 'nullable|string',
            'ketersediaan_layanan' => 'nullable|string',
            'tingkat_kegagalan' => 'nullable|string',
            'waktu_pemulihan' => 'nullable|string',
            'kepatuhan_standar_bpr' => 'nullable|string',
            'kepatuhan_persyaratan' => 'nullable|string',
            'kepatuhan_kode_etik' => 'nullable|string',
            'kepatuhan_bcp' => 'nullable|string',
            'kemudahan_berkomunikasi' => 'nullable|string',
            'tingkat_kerjasama' => 'nullable|string',
            'tingkat_keterbukaan' => 'nullable|string',
            'kemampuan_solusi' => 'nullable|string',
            'kontribusi_layanan' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240',
        ]);

        $evaluasi_kinerja_sistem = EvaluasiKinerjaSistem::create($validatedData);
    
        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            $fileNames = [];
    
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName(); // Ambil nama asli file
                $extension = $file->getClientOriginalExtension(); // Ambil ekstensi file
    
                // Menambahkan prefix time() sebelum nama file
                $newFileName = time() . '_' . $originalName;
    
                // Simpan file di storage dengan nama baru
                $file->storeAs('public/it/maintenance/evaluasi_kinerja_sistem', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Simpan nama file ke dalam kolom 'dokumentasi_db'
            $evaluasi_kinerja_sistem->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $evaluasi_kinerja_sistem = EvaluasiKinerjaSistem::findOrFail($id);

        return response()->json($evaluasi_kinerja_sistem);
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
            'tanggal_evaluasi_kinerja_sistem' => 'required|date',
            'id_vendor' => 'required|string',
            'kepatuhan_kontrak' => 'nullable|string',
            'keandalan_kualitas_layanan' => 'nullable|string',
            'ketepatan_waktu_pelayanan' => 'nullable|string',
            'responsif_keluhan' => 'nullable|string',
            'kepuasan_layanan' => 'nullable|string',
            'standar_kualitas' => 'nullable|string',
            'sumber_daya_kualitas' => 'nullable|string',
            'proses_pengujian_pengendalian_kualitas' => 'nullable|string',
            'kualitas_laporan' => 'nullable|string',
            'ketersediaan_layanan' => 'nullable|string',
            'tingkat_kegagalan' => 'nullable|string',
            'waktu_pemulihan' => 'nullable|string',
            'kepatuhan_standar_bpr' => 'nullable|string',
            'kepatuhan_persyaratan' => 'nullable|string',
            'kepatuhan_kode_etik' => 'nullable|string',
            'kepatuhan_bcp' => 'nullable|string',
            'kemudahan_berkomunikasi' => 'nullable|string',
            'tingkat_kerjasama' => 'nullable|string',
            'tingkat_keterbukaan' => 'nullable|string',
            'kemampuan_solusi' => 'nullable|string',
            'kontribusi_layanan' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240',
        ]);

        // Cari data berdasarkan ID
        $evaluasi_kinerja_sistem = EvaluasiKinerjaSistem::findOrFail($id);
    
        // Update data selain file
        $evaluasi_kinerja_sistem->update($validatedData);
    
        // Proses jika ada file baru yang diunggah
        if ($request->hasFile('dokumentasi')) {
            // Hapus file lama yang sudah ada
            if ($evaluasi_kinerja_sistem->dokumentasi_db) {
                // Split nama file menjadi array berdasarkan koma
                $oldFiles = explode(',', $evaluasi_kinerja_sistem->dokumentasi_db);
    
                // Hapus setiap file lama dari storage
                foreach ($oldFiles as $oldFile) {
                    $oldFilePath = storage_path('app/public/it/maintenance/evaluasi_kinerja_sistem/' . $oldFile);
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
                $file->storeAs('public/it/maintenance/evaluasi_kinerja_sistem', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Update kolom 'dokumentasi_db' dengan nama file yang baru
            $evaluasi_kinerja_sistem->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $evaluasi_kinerja_sistem = EvaluasiKinerjaSistem::findOrFail($id);
    
        // Hapus file-file yang terasosiasi jika ada
        if ($evaluasi_kinerja_sistem->dokumentasi_db) {
            // Split nama file menjadi array berdasarkan koma
            $fileNames = explode(',', $evaluasi_kinerja_sistem->dokumentasi_db);
    
            // Hapus setiap file dari storage
            foreach ($fileNames as $fileName) {
                $filePath = storage_path('app/public/it/maintenance/evaluasi_kinerja_sistem/' . $fileName);
    
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file dari server
                }
            }
        }
    
        // Hapus record dari database
        $evaluasi_kinerja_sistem->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
