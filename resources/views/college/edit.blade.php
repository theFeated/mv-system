@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
<div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Edit College</h1>
            <div>
                <a href="{{ route('college') }}" class="btn btn-primary">Back</a>
            </div>
    </div>
    <hr />
    <form action="{{ route('college.update', $college->collegeID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">ID</label>
                <input type="text" name="collegeID" class="form-control" placeholder="ID"  value="{{ $college->collegeID }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">College Name</label>
                <input type="text" name="collegeName" class="form-control" placeholder="College Name" value="{{ $college->collegeName }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">College Dean</label>
                <input type="text" name="collegeDean" class="form-control" placeholder="College Dean" value="{{ $college->collegeDean }}" >
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