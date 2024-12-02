<?php

namespace App\Http\Controllers\Pelaporan\Pelaporan_regulasi;

use App\Http\Controllers\Controller;
use App\Models\Pelaporan\Pelaporan_regulasi\PelaporanBpjs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PelaporanBpjsController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_pelaporan_bpjs', only: ['index']),
            new Middleware('permission:view_pelaporan_bpjs', only: ['data']),
            new Middleware('permission:create_pelaporan_bpjs', only: ['create']),
            new Middleware('permission:create_pelaporan_bpjs', only: ['store']),
            new Middleware('permission:update_pelaporan_bpjs', only: ['update']),
            new Middleware('permission:update_pelaporan_bpjs', only: ['edit']),
            new Middleware('permission:delete_pelaporan_bpjs', only: ['destroy']),
        ];
    }

    public function index()
    {        
        return view('pelaporan.pelaporan_regulasi.bpjs.index');
    }

    public function data()
    {
        $pelaporan_bpjs = PelaporanBpjs::orderBy('id_pelaporan_bpjs', 'desc')->get();

        return datatables()
            ->of($pelaporan_bpjs)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pelaporan_bpjs) {
                
                $viewButton = auth()->user()->can('read_pelaporan_bpjs') 
                    ? '<button type="button" onclick="viewForm(`'. route('pelaporan_bpjs.show', $pelaporan_bpjs->id_pelaporan_bpjs) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
                
                    
                $editButton = auth()->user()->can('update_pelaporan_bpjs') 
                    ? '<button type="button" onclick="editForm(`'. route('pelaporan_bpjs.update', $pelaporan_bpjs->id_pelaporan_bpjs) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';

                $deleteButton = auth()->user()->can('delete_pelaporan_bpjs') 
                    ? '<button type="button" onclick="deleteData(`'. route('pelaporan_bpjs.destroy', $pelaporan_bpjs->id_pelaporan_bpjs) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
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
            'tanggal_input_data' => 'required|date',
            'periode_tahun' => 'nullable|string',
            'jenis_bpjs' => 'nullable|string',
            'jenis_periode' => 'nullable|string',
            'nama_laporan' => 'nullable|string',
            'nama_laporan_isidentil' => 'nullable|string',
            'dokumen_pendukung_up' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('dokumen_pendukung_up')) {
            $file = $request->file('dokumen_pendukung_up');
    
            // Buat nama file yang unik dengan timestamp
            $fileName = time() . '_' . $file->getClientOriginalName();
    
            // Simpan file secara lokal di folder 'public/pelaporan/pelaporan_regulasi/pelaporan_bpjs'
            $filePath = $file->storeAs('public/pelaporan/pelaporan_regulasi/pelaporan_bpjs', $fileName);
    
            // Tambahkan path file ke data yang akan disimpan di database
            $validatedData['dokumen_pendukung'] = $fileName;
        }
    
        // Simpan data pelaporan ke database
        $pelaporan_bpjs = PelaporanBpjs::create($validatedData);

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
        $pelaporan_bpjs = PelaporanBpjs::findOrFail($id);

        return response()->json($pelaporan_bpjs);
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
        // Validasi data input
        $validatedData = $request->validate([
            'tanggal_input_data' => 'required|date',
            'periode_tahun' => 'nullable|string',
            'jenis_bpjs' => 'nullable|string',
            'jenis_periode' => 'nullable|string',
            'nama_laporan' => 'nullable|string',
            'nama_laporan_isidentil' => 'nullable|string',
            'dokumen_pendukung_up' => 'nullable|file|max:10240',
        ]);

        // Cari data pelaporan yang akan diupdate berdasarkan ID
        $pelaporan_bpjs = PelaporanBpjs::findOrFail($id);

        // Proses upload file baru jika ada
        if ($request->hasFile('dokumen_pendukung_up')) {
            $file = $request->file('dokumen_pendukung_up');

            // Buat nama file yang unik dengan timestamp
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Hapus file lama jika ada
            if ($pelaporan_bpjs->dokumen_pendukung) {
                $oldFilePath = public_path('storage/pelaporan/pelaporan_regulasi/pelaporan_bpjs/' . $pelaporan_bpjs->dokumen_pendukung);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);  // Hapus file lama
                }
            }

            // Simpan file baru
            $file->storeAs('public/pelaporan/pelaporan_regulasi/pelaporan_bpjs', $fileName);

            // Update data 'dokumen_pendukung' dengan nama file baru
            $validatedData['dokumen_pendukung'] = $fileName;
        }

        // Update data pelaporan dengan data yang telah divalidasi
        $pelaporan_bpjs->update($validatedData);

        // Return response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate!',
            'data' => $pelaporan_bpjs,
        ]);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelaporan_bpjs = PelaporanBpjs::findOrFail($id);

        // Hapus file posisi_dirjen_pajak jika ada
        if ($pelaporan_bpjs->dokumen_pendukung) {
            Storage::delete('public/pelaporan/pelaporan_regulasi/pelaporan_bpjs/' . $pelaporan_bpjs->dokumen_pendukung);
        }

        // Hapus data pelaporan_bpjs
        $pelaporan_bpjs->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }

    

}
