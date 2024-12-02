<?php

namespace App\Http\Controllers\Produk_perusahaan\Dana;

use App\Http\Controllers\Controller;
use App\Models\Produk_perusahaan\Dana\KategoriProdukDana;
use Illuminate\Http\Request;

class ProdukDanaController extends Controller
{

    public function index()
    {
        $kategori_produk_dana = KategoriProdukDana::all();

        return view('produk_perusahaan.dana.index', compact('kategori_produk_dana'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
