@extends('editor.views.layouts.app')
  
@section('title', '')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mt-sm-3 mt-5">College Details</h3>
            <div>
                <a href="{{ route('college') }}" class="btn btn-primary mt-sm-3 mt-5">Back</a>
            </div>
    </div>    
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">ID</label>
            <input type="text" name="collegeID" class="form-control" placeholder="ID" value="{{ $college->collegeID }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">College Name</label>
            <input type="text" name="collegeName" class="form-control" placeholder="Name" value="{{ $college->collegeName }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">College Dean</label>
            <input type="text" name="collegeDean" class="form-control" placeholder="Dean" value="{{ $college->collegeDean }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $college->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $college->updated_at }}" readonly>
        </div>
    </div>
@endsection