<?php

namespace App\Http\Controllers\Layouts;

use App\Http\Controllers\Controller;
use App\Models\Informasi\Kantor;
use App\Models\It\Kendala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $selesaiCount = DB::table('kendala')
                      ->where('status', 'Selesai')
                      ->count();
                      
        $belumselesaiCount = DB::table('kendala')
                      ->where('status', 'Belum Selesai')
                      ->count();

        $suhuterakhir = DB::table('pengecekan_suhu')
                      ->orderBy('created_at', 'desc')->value('suhu_sore');

        $kesimpulansuhu = DB::table('pengecekan_suhu')
                      ->orderBy('created_at', 'desc')->value('kesimpulan');

        $jumlahKantor = Kantor::count();
        
        return view('layouts.beranda', compact('selesaiCount', 'belumselesaiCount', 'suhuterakhir', 'kesimpulansuhu', 'jumlahKantor'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kendala = Kendala::findOrFail($id);

        return response()->json($kendala);
    }

}
