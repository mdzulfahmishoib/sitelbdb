<?php

namespace App\Http\Controllers\Informasi;

use App\Http\Controllers\Controller;
use App\Models\Informasi\Kantor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class KantorController extends Controller implements HasMiddleware
{

    public static function middleware(): array 
    {
        return [
            new Middleware('permission:view_kantor', only: ['index']),
            new Middleware('permission:view_kantor', only: ['data']),
            new Middleware('permission:create_kantor', only: ['create']),
            new Middleware('permission:create_kantor', only: ['store']),
            new Middleware('permission:update_kantor', only: ['update']),
            new Middleware('permission:update_kantor', only: ['edit']),
            new Middleware('permission:delete_kantor', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('informasi.kantor.index');
    }

    public function data()
    {
        $kantor = Kantor::orderBy('id_kantor', 'desc')->get();

        return datatables()
            ->of($kantor)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kantor) {
                $viewButton = auth()->user()->can('read_kantor') 
                    ? '<button type="button" onclick="viewForm(`'. route('kantor.show', $kantor->id_kantor) .'`)" class="btn btn-warning"><i class="fa fa-eye"></i></button>' 
                    : '';
    
                $editButton = auth()->user()->can('update_kantor') 
                    ? '<button type="button" onclick="editForm(`'. route('kantor.update', $kantor->id_kantor) .'`)" class="btn btn-primary"><i class="fa fa-pen"></i></button>' 
                    : '';
    
                $deleteButton = auth()->user()->can('delete_kantor') 
                    ? '<button type="button" onclick="deleteData(`'. route('kantor.destroy', $kantor->id_kantor) .'`)" class="btn btn-danger"><i class="fa fa-trash"></i></button>' 
                    : '';
    
                return '
                <div class="btn-group">
                    '. $viewButton .'
                    '. $editButton .'
                    '. $deleteButton .'
                </div>
                ';
            })
            ->rawColumns(['aksi'])
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
            'nama_kantor' => 'required|string',
            'jenis_kantor' => 'required|string',
            'telepon_kantor' => 'required|string',
            'email_kantor' => 'required|string',
            'alamat_kantor' => 'required|string'
        ]);

        Kantor::create($validatedData);

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
        $kantor = Kantor::findOrFail($id);

        return response()->json($kantor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kantor $kantor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kantor' => 'required|string',
            'jenis_kantor' => 'required|string',
            'telepon_kantor' => 'required|string',
            'email_kantor' => 'required|string',
            'alamat_kantor' => 'required|string'
        ]);

        $kantor = Kantor::findOrFail($id);
        $kantor->update($validatedData);

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
        $kantor = Kantor::findOrFail($id);

        $kantor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
