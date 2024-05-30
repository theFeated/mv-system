@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <h3 class="mb-0 mt-sm-3 mt-5">Add College</h3>
    <div>
        <a href="{{ route('college') }}" class="btn btn-primary mt-sm-3 mt-5">Back</a>
    </div>
</div>
<hr />
<form action="{{ route('college.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <label for="acronym" class="form-label">Acronym<span class="text-danger">*</span></label>
            <input type="text" name="acronym" class="form-control" placeholder="Acronym(e.g., CIC)" required>
        </div>
        <div class="col">
            <label for="collegeName" class="form-label">College Name<span class="text-danger">*</span></label>
            <input type="text" name="collegeName" class="form-control" placeholder="Name" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="collegeDean" class="form-label">College Dean<span class="text-danger">*</span></label>
            <input type="text" name="collegeDean" class="form-control" placeholder="Name" required>
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