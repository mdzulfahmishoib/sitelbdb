@extends('layouts.master')

@section('title')
    User Management
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Management User / User Management</li>
@endsection

@section('content')

<section>

    <div class="card">
        <div class="card-header">
            <a href="{{ url('management_user/users/create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i>  Tambah User</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th width="350px">Nama</th>
                        <th>Email</th>
                        <th>Foto</th>
                        <th>Roles</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><img src="{{ asset('storage/management_user/foto_profil/' . $user->foto) }}" alt="{{ $user->name }}" width="50" class="img-circle elevation-2"></td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRolenames() as $rolename)
                                    <label for="" class="badge bg-success text-xs font-weight-normal mx-1">{{ $rolename }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                            <a href="{{ url('management_user/users/'. $user->id .'/edit') }}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteUser('{{ url('users/' . $user->id . '/delete') }}')">
                                <i class="fa fa-trash"></i>
                            </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<section>

    <script>
        function deleteUser(url) {
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus data ini?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete URL if confirmed
                    window.location.href = url;
                }
            });
        }
    </script>

@endsection