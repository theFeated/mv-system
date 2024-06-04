@extends('staff.views.layouts.app')
  
@section('title', '')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mt-sm-3 mt-5">Role Details</h3>
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
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">ID</label>
            <input type="text" name="roleID" class="form-control" placeholder="ID" value="{{ $roles->roleID }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Role Name</label>
            <input type="text" name="roleName" class="form-control" placeholder="Role Name" value="{{ $roles->roleName }}" readonly>
        </div>
    </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Role Description</label>
                <textarea name="roleDescription" class="form-control" placeholder="Role Description" rows="5" readonly>{{ $roles->roleDescription }}</textarea>
            </div>
        </div>
        <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $roles->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $roles->updated_at }}" readonly>
        </div>
    </div>
@endsection