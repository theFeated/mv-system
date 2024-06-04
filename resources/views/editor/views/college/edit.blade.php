@extends('editor.views.layouts.app')
  
@section('title', '')
  
@section('contents')
<div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mt-sm-3 mt-5">Edit College</h3>
            <div>
                <a href="{{ route('college') }}" class="btn btn-primary mt-sm-3 mt-5">Back</a>
            </div>
    </div>
    <hr />
    <form action="{{ route('college.update', $college->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">ID</label>
                <input type="text" name="id" class="form-control" placeholder="ID"  value="{{ $college->id }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">College Name</label>
                <input type="text" name="collegeName" class="form-control" placeholder="College Name" value="{{ $college->collegeName }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="acronym" class="form-label">Acronym</label>
                <input type="text" name="acronym" class="form-control" placeholder="Acronym(e.g., CIC)" value="{{ $college->acronym }}" >
            </div>
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