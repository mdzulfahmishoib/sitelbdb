<?php

namespace App\Http\Controllers\Pelaporan\Pelaporan_regulasi;

use App\Http\Controllers\Controller;
use App\Models\Pelaporan\Pelaporan_regulasi\PelaporanDukcapilPerbarindo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PelaporanDukcapilPerbarindoController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_pelaporan_dukcapil_perbarindo', only: ['index']),
            new Middleware('permission:view_pelaporan_dukcapil_perbarindo', only: ['data']),
            new Middleware('permission:create_pelaporan_dukcapil_perbarindo', only: ['create']),
            new Middleware('permission:create_pelaporan_dukcapil_perbarindo', only: ['store']),
            new Middleware('permission:update_pelaporan_dukcapil_perbarindo', only: ['update']),
            new Middleware('permission:update_pelaporan_dukcapil_perbarindo', only: ['edit']),
            new Middleware('permission:delete_pelaporan_dukcapil_perbarindo', only: ['destroy']),
        ];
    }

    public function index()
    {        
        return view('pelaporan.pelaporan_regulasi.dukcapil_perbarindo.index');
    }

    public function data()
    {
        $pelaporan_dukcapil_perbarindo = PelaporanDukcapilPerbarindo::orderBy('id_pelaporan_dukcapil_perbarindo', 'desc')->get();

        return datatables()
            ->of($pelaporan_dukcapil_perbarindo)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pelaporan_dukcapil_perbarindo) {
                
                $viewButton = auth()->user()->can('read_pelaporan_dukcapil_perbarindo') 
                    ? '<button type="button" onclick="viewForm(`'. route('pelaporan_dukcapil_perbarindo.show', $pelaporan_dukcapil_perbarindo->id_pelaporan_dukcapil_perbarindo) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
                
                    
                $editButton = auth()->user()->can('update_pelaporan_dukcapil_perbarindo') 
                    ? '<button type="button" onclick="editForm(`'. route('pelaporan_dukcapil_perbarindo.update', $pelaporan_dukcapil_perbarindo->id_pelaporan_dukcapil_perbarindo) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';

                $deleteButton = auth()->user()->can('delete_pelaporan_dukcapil_perbarindo') 
                    ? '<button type="button" onclick="deleteData(`'. route('pelaporan_dukcapil_perbarindo.destroy', $pelaporan_dukcapil_perbarindo->id_pelaporan_dukcapil_perbarindo) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
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
            'jenis_periode' => 'nullable|string',
            'nama_laporan' => 'nullable|string',
            'nama_laporan_isidentil' => 'nullable|string',
            'dokumen_pendukung_up' => 'nullable|file|max:10240',
        ]);

        if ($request->hasFile('dokumen_pendukung_up')) {
            $file = $request->file('dokumen_pendukung_up');
    
            // Buat nama file yang unik dengan timestamp
            $fileName = time() . '_' . $file->getClientOriginalName();
    
            // Simpan file secara lokal di folder 'public/pelaporan/pelaporan_regulasi/pelaporan_dukcapil_perbarindo'
            $filePath = $file->storeAs('public/pelaporan/pelaporan_regulasi/pelaporan_dukcapil_perbarindo', $fileName);
    
            // Tambahkan path file ke data yang akan disimpan di database
            $validatedData['dokumen_pendukung'] = $fileName;
        }
    
        // Simpan data pelaporan ke database
        $pelaporan_dukcapil_perbarindo = PelaporanDukcapilPerbarindo::create($validatedData);

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
        $pelaporan_dukcapil_perbarindo = PelaporanDukcapilPerbarindo::findOrFail($id);

        return response()->json($pelaporan_dukcapil_perbarindo);
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
            'jenis_periode' => 'nullable|string',
            'nama_laporan' => 'nullable|string',
            'nama_laporan_isidentil' => 'nullable|string',
            'dokumen_pendukung_up' => 'nullable|file|max:10240',
        ]);

        // Cari data pelaporan yang akan diupdate berdasarkan ID
        $pelaporan_dukcapil_perbarindo = PelaporanDukcapilPerbarindo::findOrFail($id);

        // Proses upload file baru jika ada
        if ($request->hasFile('dokumen_pendukung_up')) {
            $file = $request->file('dokumen_pendukung_up');

            // Buat nama file yang unik dengan timestamp
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Hapus file lama jika ada
            if ($pelaporan_dukcapil_perbarindo->dokumen_pendukung) {
                $oldFilePath = public_path('storage/pelaporan/pelaporan_regulasi/pelaporan_dukcapil_perbarindo/' . $pelaporan_dukcapil_perbarindo->dokumen_pendukung);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);  // Hapus file lama
                }
            }

            // Simpan file baru
            $file->storeAs('public/pelaporan/pelaporan_regulasi/pelaporan_dukcapil_perbarindo', $fileName);

            // Update data 'dokumen_pendukung' dengan nama file baru
            $validatedData['dokumen_pendukung'] = $fileName;
        }

        // Update data pelaporan dengan data yang telah divalidasi
        $pelaporan_dukcapil_perbarindo->update($validatedData);

        // Return response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate!',
            'data' => $pelaporan_dukcapil_perbarindo,
        ]);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelaporan_dukcapil_perbarindo = PelaporanDukcapilPerbarindo::findOrFail($id);

        // Hapus file posisi_dirjen_pajak jika ada
        if ($pelaporan_dukcapil_perbarindo->dokumen_pendukung) {
            Storage::delete('public/pelaporan/pelaporan_regulasi/pelaporan_dukcapil_perbarindo/' . $pelaporan_dukcapil_perbarindo->dokumen_pendukung);
        }

        // Hapus data pelaporan_dukcapil_perbarindo
        $pelaporan_dukcapil_perbarindo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }

    

}
