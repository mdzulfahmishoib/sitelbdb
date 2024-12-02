@extends('layouts.master')

@section('title')
    Edit Users
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Management User / User Management / Edit Users</li>
@endsection

@section('content')

<section class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ url('management_user/users/'.$user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="">Name</label>
                    <input for="text" name="name" value="{{ $user->name }}" id="name" class="form-control">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input for="text" name="email" value="{{ $user->email }}" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input for="text" name="password" id="password" class="form-control">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="roles">Roles</label>
                    <select name="roles[]" id="roles" class="form-control" multiple>
                        @foreach ($roles as $role)
                            <option 
                                value="{{ $role }}"
                                {{ in_array($role, $userRoles) ? 'selected':'' }}
                            >
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                    @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="file">Foto</label>
                    <input type="file" class="form-control" id="file">
                </div>
                <div class="mb-3">
                    @if($user->foto)
                        <img src="{{ asset('storage/management_user/foto_profil/' . $user->foto) }}" alt="Foto Profil" width="100" class="mt-3 img-circle elevation-2">
                    @endif
                </div>
                            
                <div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ url('management_user/users') }}" class="btn btn-danger mx-1">Kembali</a>
                </div>
            </form>
        </div>
    </div>
<section>

@endsection