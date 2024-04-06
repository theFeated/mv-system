@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
<div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0">Agency Details</h3>
            <div>
                <a href="{{ route('agency') }}" class="btn btn-primary">Back</a>
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
            <input type="text" name="agencyID" class="form-control" placeholder="ID" value="{{ $agency->agencyID }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Agency Name</label>
            <input type="text" name="agencyName" class="form-control" placeholder="Agency Name" value="{{ $agency->agencyName }}" readonly>
        </div>
    </div>
    <div class="row">
    <div class="col mb-3">
            <label class="form-label">Contact Person</label>
            <input type="text" name="product_code" class="form-control" placeholder="Product Code" value="{{ $agency->collegeDean }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Telephone Number</label>
            <input type="text" name="telNum" class="form-control" placeholder="Telephone Number" value="{{ $agency->telNum }}" readonly>
        </div>
    </div>
    <div class="row">
    <div class="col mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $agency->address }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $agency->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $agency->updated_at }}" readonly>
        </div>
    </div>
@endsection