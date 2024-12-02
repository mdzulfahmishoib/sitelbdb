<?php

namespace App\Http\Controllers\Produk_perusahaan\Mobile_banking;

use App\Http\Controllers\Controller;
use App\Models\Produk_perusahaan\Mobile_banking\KategoriProdukMobileBanking;
use Illuminate\Http\Request;

class ProdukMobileBankingController extends Controller
{

    public function index()
    {
        $kategori_produk_mobile_banking = KategoriProdukMobileBanking::all();

        return view('produk_perusahaan.mobile_banking.index', compact('kategori_produk_mobile_banking'));
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
