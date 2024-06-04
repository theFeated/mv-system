@extends('staff.views.layouts.app')
  
@section('title', '')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
            <h3 class="mb-0 mt-sm-3 mt-5">Edit Agency</h3>
            <div>
                <a href="{{ route('agency') }}" class="btn btn-primary mt-sm-3 mt-5">Back</a>
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
    <form action="{{ route('agency.update', $agency->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">ID</label>
                <input type="text" name="id" class="form-control" placeholder="ID"  value="{{ $agency->id }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Agency Name</label>
                <input type="text" name="agencyName" class="form-control" placeholder="Agency Name" value="{{ $agency->agencyName }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Contact Person</label>
                <input type="text" name="contactPerson" class="form-control" placeholder="Contact Person" value="{{ $agency->contactPerson }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Telephone Number</label>
                <input type="text" name="telNum" class="form-control" placeholder="Telephone Number" value="{{ $agency->telNum }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $agency->address }}" >
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