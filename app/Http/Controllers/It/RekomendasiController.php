<?php

namespace App\Http\Controllers\It;

use App\Http\Controllers\Controller;
use App\Models\Informasi\Kantor;
use App\Models\It\Rekomendasi;
use App\Models\Informasi\UnitBagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RekomendasiController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_rekomendasi', only: ['index']),
            new Middleware('permission:view_rekomendasi', only: ['data']),
            new Middleware('permission:create_rekomendasi', only: ['create']),
            new Middleware('permission:create_rekomendasi', only: ['store']),
            new Middleware('permission:update_rekomendasi', only: ['update']),
            new Middleware('permission:update_rekomendasi', only: ['edit']),
            new Middleware('permission:delete_rekomendasi', only: ['destroy']),
        ];
    }

    public function index()
    {
        $unit_bagian = UnitBagian::all()->pluck('nama_unit_bagian', 'id_unit_bagian');
        $kantor = Kantor::all()->pluck('nama_kantor', 'id_kantor');
        
        return view('it.rekomendasi.index', compact('unit_bagian', 'kantor'));
    }

    public function data()
    {
        $rekomendasi = Rekomendasi::leftJoin('kantor', 'rekomendasi.id_kantor', '=', 'kantor.id_kantor')
            ->leftJoin('unit_bagian', 'rekomendasi.id_unit_bagian', '=', 'unit_bagian.id_unit_bagian')
            ->select('rekomendasi.*', 'kantor.nama_kantor', 'unit_bagian.nama_unit_bagian')
            ->orderBy('rekomendasi.id_rekomendasi', 'desc')
            ->get();

        return datatables()
            ->of($rekomendasi)
            ->addIndexColumn()
            ->addColumn('status', function ($rekomendasi) {
                $class = ($rekomendasi->status === 'Tidak Disetujui' || $rekomendasi->status === 'Belum Disetujui') 
                         ? 'badge badge-danger' 
                         : 'badge badge-success';
                return '<span class="'. $class .' text-xs font-weight-normal">'. $rekomendasi->status .'</span>';
            })
            
            ->addColumn('nama_unit_bagian', function ($rekomendasi) {
                return $rekomendasi->nama_unit_bagian;
            })
            ->addColumn('nama_kantor', function ($rekomendasi) {
                return $rekomendasi->nama_kantor;
            })
            ->addColumn('aksi', function ($rekomendasi) {
                
                $viewButton = auth()->user()->can('read_rekomendasi') 
                    ? '<button type="button" onclick="viewForm(`'. route('rekomendasi.show', $rekomendasi->id_rekomendasi) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
                
                    
                $editButton = auth()->user()->can('update_rekomendasi') 
                    ? '<button type="button" onclick="editForm(`'. route('rekomendasi.update', $rekomendasi->id_rekomendasi) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';

                $deleteButton = auth()->user()->can('delete_rekomendasi') 
                    ? '<button type="button" onclick="deleteData(`'. route('rekomendasi.destroy', $rekomendasi->id_rekomendasi) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
                    : '';


                return '
                <div class="btn-group">
                    '. $viewButton .'
                    '. $editButton .'
                    '. $deleteButton .'
                </div>
                ';
            })
            ->rawColumns(['aksi', 'status'])
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
            'tanggal_pengajuan_rekomendasi' => 'required|string',
            'nama_pemohon_rekomendasi' => 'required|string',
            'tentang_pengadaan' => 'required|string',
            'rekomendasi_pembelian' => 'required|string',
            'status' => 'required|string',
            'tanggal_persetujuan_rekomendasi' => 'nullable|string',
            'keterangan_tambahan' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240', // Mengganti 'file.*' menjadi 'dokumentasi.*'
        ]);

        $rekomendasi = Rekomendasi::create($validatedData);

        if ($request->hasFile('dokumentasi')) { // Mengganti 'file' menjadi 'dokumentasi'
            $files = $request->file('dokumentasi'); // Mengambil file dari 'dokumentasi'
            $fileNames = [];

            foreach ($files as $file) {
                $timestampedName = time() . '_' . $file->getClientOriginalName(); // Tambahkan prefix time() sebelum nama file asli

                // Simpan file di storage dengan nama yang sudah ditambahkan prefix time()
                $file->storeAs('public/it/rekomendasi', $timestampedName);

                // Simpan nama file yang sudah diberi prefix ke array
                $fileNames[] = $timestampedName;
            }

            // Simpan nama file yang sudah diberi prefix ke dalam kolom 'dokumentasi_db'
            $rekomendasi->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $rekomendasi = Rekomendasi::findOrFail($id);

        return response()->json($rekomendasi);
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
            'id_kantor' => 'required|string',
            'id_unit_bagian' => 'required|string',
            'tanggal_pengajuan_rekomendasi' => 'required|string',
            'nama_pemohon_rekomendasi' => 'required|string',
            'tentang_pengadaan' => 'required|string',
            'rekomendasi_pembelian' => 'required|string',
            'status' => 'required|string',
            'tanggal_persetujuan_rekomendasi' => 'nullable|string',
            'keterangan_tambahan' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240',
        ]);

        $rekomendasi = Rekomendasi::findOrFail($id);
        $rekomendasi->update($validatedData);

        if ($request->hasFile('dokumentasi')) {
            // Hapus file lama jika ada
            if ($rekomendasi->dokumentasi_db) {
                $oldFiles = explode(',', $rekomendasi->dokumentasi_db);
                foreach ($oldFiles as $oldFile) {
                    Storage::delete('public/it/rekomendasi/' . $oldFile);
                }
            }

            // Upload file baru
            $files = $request->file('dokumentasi');
            $fileNames = [];

            foreach ($files as $file) {
                $timestampedName = time() . '_' . $file->getClientOriginalName(); // Tambahkan prefix time() sebelum nama file asli
                $file->storeAs('public/it/rekomendasi', $timestampedName);
                $fileNames[] = $timestampedName;
            }

            // Update nama file baru di database
            $rekomendasi->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $rekomendasi = Rekomendasi::findOrFail($id);
    
        // Hapus file yang terkait, jika ada
        if ($rekomendasi->dokumentasi_db) {
            $files = explode(',', $rekomendasi->dokumentasi_db);
            foreach ($files as $file) {
                Storage::delete('public/it/rekomendasi/' . $file);
            }
        }
    
        // Hapus data dari database
        $rekomendasi->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
    
}
