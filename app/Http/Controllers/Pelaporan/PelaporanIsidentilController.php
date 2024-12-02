<?php

namespace App\Http\Controllers\Pelaporan;

use App\Http\Controllers\Controller;
use App\Models\Pelaporan\PelaporanIsidentil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PelaporanIsidentilController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_pelaporan_isidentil', only: ['index']),
            new Middleware('permission:view_pelaporan_isidentil', only: ['data']),
            new Middleware('permission:create_pelaporan_isidentil', only: ['create']),
            new Middleware('permission:create_pelaporan_isidentil', only: ['store']),
            new Middleware('permission:update_pelaporan_isidentil', only: ['update']),
            new Middleware('permission:update_pelaporan_isidentil', only: ['edit']),
            new Middleware('permission:delete_pelaporan_isidentil', only: ['destroy']),
        ];
    }

    public function index()
    {        
        return view('pelaporan.pelaporan_isidentil.index');
    }

    public function data()
    {
        $pelaporan_isidentil = PelaporanIsidentil::orderBy('id_pelaporan_isidentil', 'desc')->get();

        return datatables()
            ->of($pelaporan_isidentil)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pelaporan_isidentil) {
                
                $viewButton = auth()->user()->can('read_pelaporan_isidentil') 
                    ? '<button type="button" onclick="viewForm(`'. route('pelaporan_isidentil.show', $pelaporan_isidentil->id_pelaporan_isidentil) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
                
                    
                $editButton = auth()->user()->can('update_pelaporan_isidentil') 
                    ? '<button type="button" onclick="editForm(`'. route('pelaporan_isidentil.update', $pelaporan_isidentil->id_pelaporan_isidentil) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';

                $deleteButton = auth()->user()->can('delete_pelaporan_isidentil') 
                    ? '<button type="button" onclick="deleteData(`'. route('pelaporan_isidentil.destroy', $pelaporan_isidentil->id_pelaporan_isidentil) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
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
            'jenis_pelaporan' => 'nullable|string',
            'pihak_menerima' => 'nullable|string',
            'perihal_laporan' => 'nullable|string',
            'dokumen_pendukung_up' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('dokumen_pendukung_up')) {
            $file = $request->file('dokumen_pendukung_up');
    
            // Buat nama file yang unik dengan timestamp
            $fileName = time() . '_' . $file->getClientOriginalName();
    
            // Simpan file secara lokal di folder 'public/pelaporan/pelaporan_isidentil'
            $filePath = $file->storeAs('public/pelaporan/pelaporan_isidentil', $fileName);
    
            // Tambahkan path file ke data yang akan disimpan di database
            $validatedData['dokumen_pendukung'] = $fileName;
        }
    
        // Simpan data pelaporan ke database
        $pelaporan_isidentil = PelaporanIsidentil::create($validatedData);

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
        $pelaporan_isidentil = PelaporanIsidentil::findOrFail($id);

        return response()->json($pelaporan_isidentil);
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
            'jenis_pelaporan' => 'nullable|string',
            'pihak_menerima' => 'nullable|string',
            'perihal_laporan' => 'nullable|string',
            'dokumen_pendukung_up' => 'nullable|file|max:10240',  // Validasi file
        ]);

        // Cari data pelaporan yang akan diupdate berdasarkan ID
        $pelaporan_isidentil = PelaporanIsidentil::findOrFail($id);

        // Proses upload file baru jika ada
        if ($request->hasFile('dokumen_pendukung_up')) {
            $file = $request->file('dokumen_pendukung_up');

            // Buat nama file yang unik dengan timestamp
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Hapus file lama jika ada
            if ($pelaporan_isidentil->dokumen_pendukung) {
                $oldFilePath = public_path('storage/pelaporan/pelaporan_isidentil/' . $pelaporan_isidentil->dokumen_pendukung);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);  // Hapus file lama
                }
            }

            // Simpan file baru
            $file->storeAs('public/pelaporan/pelaporan_isidentil', $fileName);

            // Update data 'dokumen_pendukung' dengan nama file baru
            $validatedData['dokumen_pendukung'] = $fileName;
        }

        // Update data pelaporan dengan data yang telah divalidasi
        $pelaporan_isidentil->update($validatedData);

        // Return response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate!',
            'data' => $pelaporan_isidentil,
        ]);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelaporan_isidentil = PelaporanIsidentil::findOrFail($id);

        // Hapus file posisi_isidentil jika ada
        if ($pelaporan_isidentil->dokumen_pendukung) {
            Storage::delete('public/pelaporan/pelaporan_isidentil/' . $pelaporan_isidentil->dokumen_pendukung);
        }

        // Hapus data pelaporan_isidentil
        $pelaporan_isidentil->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }

    

}
