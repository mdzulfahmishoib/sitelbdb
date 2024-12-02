@extends('layouts.master')

@section('title')
    Sistem dan Pengembangan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">IT</li>
    <li class="breadcrumb-item active">Sistem dan Pengembangan</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
          @can('create_sistem_pengembangan')
              <a href="{{ route('kategori_sistem_pengembangan.index') }}" class="btn btn-primary mb-3"><i class="fa fa-list"></i> Tambah Kategori</a>  
          @endcan

          <table class="table table-responsive">
            @foreach ($sistem_pengembangan as $index => $data_sistem_pengembangan)
                <tbody class="border-bottom">
                  <tr>
                    <td><h4>{{ $index + 1 }}. {{ $data_sistem_pengembangan->judul }}</h4><p class="text-justify">{{ $data_sistem_pengembangan->deskripsi }}</p></td>
                    <td><img src="{{ asset('storage/it/sistem_pengembangan/kategori_sistem_pengembangan/' . $data_sistem_pengembangan->dokumentasi_db) }}" width="200" class="ml-3 rounded-lg" title="Dokumentasi" style="cursor:pointer;" onclick="showImageModal('{{ $data_sistem_pengembangan->dokumentasi }}')"/></td>
                  </tr>
                </tbody>
            @endforeach
          </table>
          
        </div>      
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>
@endsection
