@extends('layouts.master')

@section('title')
    Profil
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Profil</li>
@endsection

@section('content')

<section class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name">Nama</label>
                    <input type="text" name="name" value="{{ $user->name }}" id="name" class="form-control">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" id="email" class="form-control">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="current_password">Password Saat Ini</label>
                    <input type="password" name="current_password" id="current_password" class="form-control" required>
                    @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" name="new_password" id="new_password" class="form-control">
                    @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
                    @error('new_password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="foto">Foto Profil (Opsional)</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                    @if($user->foto)
                        <img src="{{ asset('storage/management_user/foto_profil/' . $user->foto) }}" alt="Foto Profil" width="100" class="mt-3 img-circle elevation-2">
                    @endif
                    @error('foto') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Update Profil</button>
                    <a href="{{ route('beranda') }}" class="btn btn-danger mx-1">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
