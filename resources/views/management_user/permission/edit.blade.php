@extends('layouts.master')

@section('title')
    Edit Permission
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Management User / Permission Management / Edit Permission</li>
@endsection

@section('content')

<section class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ url('management_user/permission/'.$permission->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="">Nama Permission</label>
                    <input for="text" value="{{ $permission->name }}" name="name" id="name" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ url('management_user/permission') }}" class="btn btn-danger mx-1">Kembali</a>
                </div>
            </form>
        </div>
    </div>
<section>

@endsection