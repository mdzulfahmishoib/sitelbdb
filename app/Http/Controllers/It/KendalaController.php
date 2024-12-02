<?php

namespace App\Http\Controllers\It;

use App\Http\Controllers\Controller;
use App\Models\Informasi\Kantor;
use App\Models\It\Kendala;
use App\Models\Informasi\UnitBagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class KendalaController extends Controller implements HasMiddleware
{
    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_kendala', only: ['index']),
            new Middleware('permission:view_kendala', only: ['data']),
            new Middleware('permission:create_kendala', only: ['clone']),
            new Middleware('permission:create_kendala', only: ['store']),
            new Middleware('permission:update_kendala', only: ['update']),
            new Middleware('permission:update_kendala', only: ['edit']),
            new Middleware('permission:delete_kendala', only: ['destroy']),
        ];
    }

    public function index()
    {
        $unit_bagian = UnitBagian::all()->pluck('nama_unit_bagian', 'id_unit_bagian');
        $kantor = Kantor::all()->pluck('nama_kantor', 'id_kantor');
        
        return view('it.kendala.index', compact('unit_bagian', 'kantor'));
    }

    public function data()
    {
        
        $kendala = Kendala::leftJoin('kantor', 'kendala.id_kantor', '=', 'kantor.id_kantor')
            ->leftJoin('unit_bagian', 'kendala.id_unit_bagian', '=', 'unit_bagian.id_unit_bagian')
            ->select('kendala.*', 'kantor.nama_kantor', 'unit_bagian.nama_unit_bagian')
            ->orderBy('kendala.tanggal_kendala', 'desc')
            ->get();

        return datatables()
            ->of($kendala)
            ->addIndexColumn()
            ->addColumn('status', function ($kendala) {
                $class = $kendala->status === 'Belum Selesai' ? 'badge badge-danger' : 'badge badge-success';
                return '<span class="'. $class .' text-xs font-weight-normal">'. $kendala->status .'</span>';
            })
            ->addColumn('nama_unit_bagian', function ($kendala) {
                return $kendala->nama_unit_bagian;
            })
            ->addColumn('nama_kantor', function ($kendala) {
                return $kendala->nama_kantor;
            })
            ->addColumn('aksi', function ($kendala) {
                
                $viewButton = auth()->user()->can('read_kendala') 
                    ? '<button type="button" onclick="viewForm(`'. route('kendala.show', $kendala->id_kendala) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
                
                    
                $editButton = auth()->user()->can('update_kendala') 
                    ? '<button type="button" onclick="editForm(`'. route('kendala.update', $kendala->id_kendala) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';
                    
                $cloneButton = auth()->user()->can('update_kendala')
                    ? '<button type="button" onclick="cloneForm(`'. route('kendala.clone', $kendala->id_kendala) .'`)" class="btn btn-success"><i class="fa fa-copy"></i></button>' 
                    : '';

                $deleteButton = auth()->user()->can('delete_kendala') 
                    ? '<button type="button" onclick="deleteData(`'. route('kendala.destroy', $kendala->id_kendala) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
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
        $kendala = Kendala::find($id);

        if (!$kendala) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Return the kendala data for cloning purpose
        return response()->json($kendala);
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
            'tanggal_kendala' => 'required|date',
            'urgensi' => 'required|string',
            'klasifikasi' => 'required|string',
            'keterangan_kendala' => 'required|string',
            'pelapor' => 'required|string',
            'id_kantor' => 'required|string',
            'id_unit_bagian' => 'required|string',
            'diselesaikan_oleh' => 'nullable|string',
            'status' => 'required|string',
            'tanggal_selesai' => 'nullable|date',
            'keterangan_tambahan' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240',
        ]);

        $user = Auth::user();
        $validatedData['user_name'] = $user->name;

        // Simpan data kendala ke database
        $kendala = Kendala::create($validatedData);

        // Proses file jika ada
        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            $fileNames = [];

            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName(); // Nama asli file
                $extension = $file->getClientOriginalExtension(); // Ekstensi file

                // Menambahkan prefix time() sebelum nama file
                $newFileName = time() . '_' . $originalName;

                // Simpan file di storage dengan nama baru
                $file->storeAs('public/it/kendala', $newFileName);

                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }

            // Simpan nama file ke dalam kolom 'dokumentasi_db'
            $kendala->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $kendala = Kendala::findOrFail($id);

        return response()->json($kendala);
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
            'tanggal_kendala' => 'required|date',
            'urgensi' => 'required|string',
            'klasifikasi' => 'required|string',
            'keterangan_kendala' => 'required|string',
            'pelapor' => 'required|string',
            'id_kantor' => 'required|string',
            'id_unit_bagian' => 'required|string',
            'diselesaikan_oleh' => 'nullable|string',
            'status' => 'required|string',
            'tanggal_selesai' => 'nullable|date',
            'keterangan_tambahan' => 'nullable|string',
            'dokumentasi.*' => 'nullable|file|max:10240', // Validation for each file
        ]);

        // Cari data berdasarkan ID
        $kendala = Kendala::findOrFail($id);

        $user = Auth::user();
        $validatedData['user_name'] = $user->name; // Jika menyimpan ID pengguna
    
        // Update data selain file
        $kendala->update($validatedData);
    
        // Proses jika ada file baru yang diunggah
        if ($request->hasFile('dokumentasi')) {
            // Hapus file lama yang sudah ada
            if ($kendala->dokumentasi_db) {
                // Split nama file menjadi array berdasarkan koma
                $oldFiles = explode(',', $kendala->dokumentasi_db);
    
                // Hapus setiap file lama dari storage
                foreach ($oldFiles as $oldFile) {
                    $oldFilePath = storage_path('app/public/it/kendala/' . $oldFile);
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
                $file->storeAs('public/it/kendala', $newFileName);
    
                // Simpan nama file baru ke array
                $fileNames[] = $newFileName;
            }
    
            // Update kolom 'dokumentasi_db' dengan nama file yang baru
            $kendala->update(['dokumentasi_db' => implode(',', $fileNames)]);
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
        $kendala = Kendala::findOrFail($id);
    
        // Hapus file-file yang terasosiasi jika ada
        if ($kendala->dokumentasi_db) {
            // Split nama file menjadi array berdasarkan koma
            $fileNames = explode(',', $kendala->dokumentasi_db);
    
            // Hapus setiap file dari storage
            foreach ($fileNames as $fileName) {
                $filePath = storage_path('app/public/it/kendala/' . $fileName);
    
                if (file_exists($filePath)) {
                    unlink($filePath); // Menghapus file dari server
                }
            }
        }
    
        // Hapus record dari database
        $kendala->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
