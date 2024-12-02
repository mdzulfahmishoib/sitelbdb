@extends('layouts.master')

@section('title')
    Buat Role
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Management User / Role Management / Buat Role</li>
@endsection

@section('content')

<section class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ url('management_user/roles') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="">Nama Role</label>
                    <input for="text" name="name" id="name" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-danger mx-1">Kembali</a>
                </div>
            </form>
        </div>
    </div>
<section>

@endsection