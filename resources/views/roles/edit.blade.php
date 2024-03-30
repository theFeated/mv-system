@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
    <h1 class="mb-0">Edit Role</h1>
    <hr />
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    @if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('error') }}
    </div>
    @endif
    <form action="{{ route('roles.update', $roles->roleID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">ID</label>
                <input type="text" name="roleID" class="form-control" placeholder="ID"  value="{{ $roles->roleID }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Roles Name</label>
                <input type="text" name="roleName" class="form-control" placeholder="Roles Name" value="{{ $roles->roleName }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Roles Description</label>
                <input type="text" name="roleDescription" class="form-control" placeholder="Roles Description" value="{{ $roles->roleDescription }}" >
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="d-grid">
                    <button class="btn btn-warning">Update</button>
                </div>
            </div>
        </div>
    </form>
@endsection