@extends('layouts.master')

@section('title')
    Buat User
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Management User / User Management / Buat User</li>
@endsection

@section('content')

<section class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ url('management_user/users') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="">Nama</label>
                    <input for="text" name="name" id="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input for="text" name="email" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input for="text" name="password" id="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="roles">Roles</label>
                    <select name="roles[]" id="roles" class="form-control" multiple>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="file">Foto</label>
                    <input type="file" class="form-control" id="file">
                </div>
                            
                <div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('management_user/users') }}" class="btn btn-danger mx-1">Kembali</a>
                </div>
            </form>
        </div>
    </div>
<section>

@endsection