@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mt-sm-3 mt-5">Add Roles</h3>
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
    <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label for="roleID" class="form-label">ID<span class="text-danger">*</span></label>
                <input type="text" name="roleID" class="form-control" value="{{ $roleID }}" placeholder="Role ID" required readonly>
            </div>
            <div class="col">
                <label for="roleName" class="form-label">Roles Name<span class="text-danger">*</span></label>
                <input type="text" name="roleName" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="roleDescription" class="form-label">Roles Description<span class="text-danger">*</span></label>
                <textarea name="roleDescription" class="form-control" placeholder="Role Description" rows="5"></textarea>
            </div>
        </div>
        <div class="col">        
            <div class="row mb-3">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </form>
@endsection