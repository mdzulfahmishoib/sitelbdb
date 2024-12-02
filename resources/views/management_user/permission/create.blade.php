@extends('layouts.master')

@section('title')
    Buat Permission
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Management User / Permission Management / Buat Permission</li>
@endsection

@section('content')

<section class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ url('management_user/permission') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="">Nama Permission</label>
                    <input for="text" name="name" id="name" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('management_user/permission') }}" class="btn btn-danger mx-1">Kembali</a>
                </div>
            </form>
        </div>
    </div>
<section>

@endsection