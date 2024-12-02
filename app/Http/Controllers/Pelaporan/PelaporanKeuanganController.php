<?php

namespace App\Http\Controllers\Pelaporan;

use App\Http\Controllers\Controller;
use App\Models\Pelaporan\PelaporanKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PelaporanKeuanganController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_pelaporan_keuangan', only: ['index']),
            new Middleware('permission:view_pelaporan_keuangan', only: ['data']),
            new Middleware('permission:create_pelaporan_keuangan', only: ['create']),
            new Middleware('permission:create_pelaporan_keuangan', only: ['store']),
            new Middleware('permission:update_pelaporan_keuangan', only: ['update']),
            new Middleware('permission:update_pelaporan_keuangan', only: ['edit']),
            new Middleware('permission:delete_pelaporan_keuangan', only: ['destroy']),
        ];
    }

    public function index()
    {        
        return view('pelaporan.pelaporan_keuangan.index');
    }

    public function data()
    {
        $pelaporan_keuangan = PelaporanKeuangan::orderBy('id_pelaporan_keuangan', 'desc')->get();

        return datatables()
            ->of($pelaporan_keuangan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pelaporan_keuangan) {
                
                $viewButton = auth()->user()->can('read_pelaporan_keuangan') 
                    ? '<button type="button" onclick="viewForm(`'. route('pelaporan_keuangan.show', $pelaporan_keuangan->id_pelaporan_keuangan) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
                
                    
                $editButton = auth()->user()->can('update_pelaporan_keuangan') 
                    ? '<button type="button" onclick="editForm(`'. route('pelaporan_keuangan.update', $pelaporan_keuangan->id_pelaporan_keuangan) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';

                $deleteButton = auth()->user()->can('delete_pelaporan_keuangan') 
                    ? '<button type="button" onclick="deleteData(`'. route('pelaporan_keuangan.destroy', $pelaporan_keuangan->id_pelaporan_keuangan) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
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
        // Validasi data input
        $validatedData = $request->validate([
            'tanggal_input_data' => 'required|date',
            'periode_tahun' => 'required|string',
            'periode_bulan' => 'required|string',
            'asset' => 'nullable|string',
            'kredit' => 'nullable|string',
            'penempatan_bank_lain' => 'nullable|string',
            'tabungan' => 'nullable|string',
            'deposito' => 'nullable|string',
            'pendapatan_operasional' => 'nullable|string',
            'pendapatan_non_operasional' => 'nullable|string',
            'biaya_operasional' => 'nullable|string',
            'biaya_non_operasional' => 'nullable|string',
            'laba_sebelum_pajak' => 'nullable|string',
            'pajak' => 'nullable|string',
            'laba_setelah_pajak' => 'nullable|string',
            'kap' => 'nullable|string',
            'kpmm' => 'nullable|string',
            'npl' => 'nullable|string',
            'ppap' => 'nullable|string',
            'ldr' => 'nullable|string',
            'roa' => 'nullable|string',
            'roe' => 'nullable|string',
            'bopo' => 'nullable|string',
            'nim' => 'nullable|string',
            'cr' => 'nullable|string',
            'posisi_keuangan' => 'nullable|file|max:10240',
            'laba_rugi' => 'nullable|file|max:10240',
            'kualitas_aset_produktif' => 'nullable|file|max:10240',
        ]);

        // Proses upload file dan simpan nama file di dalam validated data
        $filePaths = [
            'posisi_keuangan' => 'public/pelaporan/pelaporan_keuangan/posisi_keuangan',
            'laba_rugi' => 'public/pelaporan/pelaporan_keuangan/laba_rugi',
            'kualitas_aset_produktif' => 'public/pelaporan/pelaporan_keuangan/kualitas_aset_produktif',
        ];

        foreach ($filePaths as $field => $path) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Simpan file di path yang ditentukan
                $file->storeAs($path, $fileName);

                // Tambahkan nama file ke data yang akan disimpan di database
                $validatedData[$field] = $fileName;
            }
        }

        // Simpan data pelaporan keuangan ke database
        $pelaporan_keuangan = PelaporanKeuangan::create($validatedData);

        // Return response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan!',
            'data' => $pelaporan_keuangan,
        ]);
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelaporan_keuangan = PelaporanKeuangan::findOrFail($id);

        return response()->json($pelaporan_keuangan);
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
        // Temukan data pelaporan keuangan berdasarkan ID
        $pelaporan_keuangan = PelaporanKeuangan::findOrFail($id);

        // Validasi data input
        $validatedData = $request->validate([
            'tanggal_input_data' => 'required|date',
            'periode_tahun' => 'required|string',
            'periode_bulan' => 'required|string',
            'asset' => 'nullable|string',
            'kredit' => 'nullable|string',
            'penempatan_bank_lain' => 'nullable|string',
            'tabungan' => 'nullable|string',
            'deposito' => 'nullable|string',
            'pendapatan_operasional' => 'nullable|string',
            'pendapatan_non_operasional' => 'nullable|string',
            'biaya_operasional' => 'nullable|string',
            'biaya_non_operasional' => 'nullable|string',
            'laba_sebelum_pajak' => 'nullable|string',
            'pajak' => 'nullable|string',
            'laba_setelah_pajak' => 'nullable|string',
            'kap' => 'nullable|string',
            'kpmm' => 'nullable|string',
            'npl' => 'nullable|string',
            'ppap' => 'nullable|string',
            'ldr' => 'nullable|string',
            'roa' => 'nullable|string',
            'roe' => 'nullable|string',
            'bopo' => 'nullable|string',
            'nim' => 'nullable|string',
            'cr' => 'nullable|string',
            'posisi_keuangan' => 'nullable|file|max:10240',
            'laba_rugi' => 'nullable|file|max:10240',
            'kualitas_aset_produktif' => 'nullable|file|max:10240',
        ]);

        // Tentukan path untuk setiap field file
        $filePaths = [
            'posisi_keuangan' => 'public/pelaporan/pelaporan_keuangan/posisi_keuangan',
            'laba_rugi' => 'public/pelaporan/pelaporan_keuangan/laba_rugi',
            'kualitas_aset_produktif' => 'public/pelaporan/pelaporan_keuangan/kualitas_aset_produktif',
        ];

        foreach ($filePaths as $field => $path) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Hapus file lama jika ada
                if ($pelaporan_keuangan->$field) {
                    Storage::delete($path . '/' . $pelaporan_keuangan->$field);
                }

                // Simpan file baru di path yang ditentukan
                $file->storeAs($path, $fileName);

                // Tambahkan nama file baru ke data yang akan disimpan di database
                $validatedData[$field] = $fileName;
            }
        }

        // Update data pelaporan keuangan di database
        $pelaporan_keuangan->update($validatedData);

        // Return response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui!',
            'data' => $pelaporan_keuangan,
        ]);
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan data pelaporan keuangan berdasarkan ID
        $pelaporan_keuangan = PelaporanKeuangan::findOrFail($id);

        // Tentukan path untuk setiap field file
        $filePaths = [
            'posisi_keuangan' => 'public/pelaporan/pelaporan_keuangan/posisi_keuangan',
            'laba_rugi' => 'public/pelaporan/pelaporan_keuangan/laba_rugi',
            'kualitas_aset_produktif' => 'public/pelaporan/pelaporan_keuangan/kualitas_aset_produktif',
        ];
        
        // Hapus setiap file terkait jika ada
        foreach ($filePaths as $field => $path) {
            if ($pelaporan_keuangan->$field) {
                Storage::delete($path . '/' . $pelaporan_keuangan->$field);
            }
        }

        // Hapus data pelaporan keuangan dari database
        $pelaporan_keuangan->delete();

        // Return response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }


    

}
