<?php

namespace App\Http\Controllers\It\Sistem_pengembangan;

use App\Http\Controllers\Controller;
use App\Models\It\Sistem_pengembangan\KategoriSistemPengembangan;
use Illuminate\Http\Request;

class SistemPengembanganController extends Controller
{

    public function index()
    {
        $sistem_pengembangan = KategoriSistemPengembangan::all();

        return view('it.sistem_pengembangan.index', compact('sistem_pengembangan'));
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
