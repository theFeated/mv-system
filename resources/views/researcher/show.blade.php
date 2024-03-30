@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
<div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Researcher Details</h1>
            <div>
                <a href="{{ route('researcher') }}" class="btn btn-primary">Back</a>
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
            <input type="text" name="researcherID" class="form-control" placeholder="ID" value="{{ $researcher->researcherID }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">College</label>
            <input type="text" class="form-control" placeholder="College" value="{{ $college ? $college->collegeName : '' }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Researcher Name</label>
            <input type="text" name="researcherName" class="form-control" placeholder="Researcher Name" value="{{ $researcher->collegeDean }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Contact Number</label>
            <input type="text" name="contactNum" class="form-control" placeholder="Contact Number" value="{{ $researcher->contactNum }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $researcher->email }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $researcher->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $researcher->updated_at }}" readonly>
        </div>
    </div>
@endsection