@extends('editor.views.layouts.app')
  
@section('title', '')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mt-sm-3 mt-5">Edit Researcher</h3>
            <div>
                <a href="{{ route('researcher') }}" class="btn btn-primary mt-sm-3 mt-5">Back</a>
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
    <form action="{{ route('researcher.update', $researcher->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">ID</label>
                <input type="text" name="id" class="form-control" placeholder="ID"  value="{{ $researcher->id }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">College</label>
                <select name="collegeID" class="form-control">
                    @foreach($colleges as $college)
                    <option value="{{ $college->id }}">{{ $college->collegeName }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Researcher Name</label>
                <input type="text" name="researcherName" class="form-control" placeholder="Researcher Name" value="{{ $researcher->researcherName }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Contact Number</label>
                <input type="text" name="contactNum" class="form-control" placeholder="Contact Number" value="{{ $researcher->contactNum }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $researcher->email }}" >
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