@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mt-sm-3 mt-5">Edit Role</h3>
            <div>
                <a href="{{ route('roles') }}" class="btn btn-primary mt-sm-3 mt-5">Back</a>
            </div>
    </div>  
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
                <textarea type="text" name="roleDescription" class="form-control" placeholder="Roles Description" >{{ $roles->roleDescription }}</textarea>
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