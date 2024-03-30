@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Add College</h1>
    <div>
        <a href="{{ route('college') }}" class="btn btn-primary">Back</a>
    </div>
</div>
<hr />
<form action="{{ route('college.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <label for="codePrefix" class="form-label">Code Prefix<span class="text-danger">*</span></label>
            <input type="text" name="codePrefix" class="form-control" placeholder="Code Prefix (e.g., CIC)" required>
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