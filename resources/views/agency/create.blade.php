@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mt-sm-3 mt-5">Add Agency</h3>
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
    <form action="{{ route('agency.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label for="agencyID" class="form-label">Agency ID<span class="text-danger">*</span></label>
                <input type="text" name="agencyID" class="form-control" value="{{ $agencyID }}" placeholder="Agency ID" required readonly>
            </div>
            <div class="col">
                <label for="agencyName" class="form-label">Agency Name<span class="text-danger">*</span></label>
                <input type="text" name="agencyName" class="form-control" placeholder="Name" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="contactPerson" class="form-label">Contact Person<span class="text-danger">*</span></label>
                <input type="text" name="contactPerson" class="form-control" placeholder="Name" required>
            </div>
            <div class="col">
                <label for="telNum" class="form-label">Telephone Number<span class="text-danger">*</span></label>
                <input type="text" name="telNum" class="form-control" placeholder="Number" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                <input type="text" name="address" class="form-control" placeholder="Address" required>
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