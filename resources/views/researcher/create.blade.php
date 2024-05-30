@extends('layouts.app')

@section('title', '')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mt-sm-3 mt-5">Add Researcher</h3>
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
    <form action="{{ route('researcher.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label for="id" class="form-label">Usep ID Number<span class="text-danger">*</span></label>
                <input type="number" name="id" class="form-control" placeholder="ID" required>
            </div>
            <div class="col">
                <label for="collegeID" class="form-label">College<span class="text-danger">*</span></label>
                <select name="collegeID" class="form-control" required>
                    <option value="">Select College</option>
                    @foreach($colleges as $college)
                        <option value="{{ $college->id }}">{{ $college->collegeName }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="researcherName" class="form-label">Researcher Name<span class="text-danger">*</span></label>
                <input type="text" name="researcherName" class="form-control" placeholder="Researcher Name" required>
            </div>
            <div class="col">
                <label for="contactNum" class="form-label">Contact Number<span class="text-danger">*</span></label>
                <input type="text" name="contactNum" class="form-control" placeholder="Number" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                <input type="text" name="email" class="form-control" placeholder="Email" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </form>
@endsection
