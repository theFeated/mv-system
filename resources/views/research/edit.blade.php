@extends('layouts.app')
  
@section('title', '')
  
@section('contents')
<div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Edit Research</h1>
            <div>
                <a href="{{ route('research') }}" class="btn btn-primary">Back</a>
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
    <form action="{{ route('research.update', $research->researchID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">ID</label>
                <input type="text" name="researchID" class="form-control" placeholder="ID"  value="{{ $research->researchID }}" readonly>
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
                <label class="form-label">Researcher</label>
                <select name="researcherID" class="form-control">
                    @foreach($researchers as $researcher)
                    <option value="{{ $researcher->id }}">{{ $researcher->researcherName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col mb-3">
                <label class="form-label">Agency</label>
                <select name="agencyID" class="form-control">
                    @foreach($agencies as $agency)
                    <option value="{{ $agency->id }}">{{ $agency->agencyName }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Status</label>
                <input type="text" name="status" class="form-control" placeholder="Status" value="{{ $research->status }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Research Type</label>
                <input type="text" name="researchType" class="form-control" placeholder="Research Type" value="{{ $research->researchType }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Research Title</label>
                <input type="text" name="researchTitle" class="form-control" placeholder="Research Title" value="{{ $research->researchTitle }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Year</label>
                <input type="year" name="year" class="form-control" placeholder="Year" value="{{ $research->year }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Start Date</label>
                <input type="date" name="startDate" class="form-control" placeholder="Start Date" value="{{ $research->startDate }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">End Date</label>
                <input type="date" name="endDate" class="form-control" placeholder="End Date" value="{{ $research->endDate }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Extension</label>
                <input type="text" name="extension" class="form-control" placeholder="Extension" value="{{ $research->extension }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Internal Fund</label>
                <select class="form-control" id="internalFund" name="internalFund">
                    <option value="">Internal Fund</option>
                    <option value="1" {{ $research->internalFund ? 'selected' : '' }}>True</option>
                    <option value="0" {{ !$research->internalFund ? 'selected' : '' }}>False</option>
                </select>
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