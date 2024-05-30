@extends('layouts.app')
  
@section('title', '')
  
@section('contents')

    <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0  mt-sm-3 mt-5">Add Research</h3>
            <div>
                <a href="{{ route('research') }}" class="btn btn-primary  mt-sm-3 mt-5">Back</a>
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
    
    <form action="{{ route('research.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
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
                <label for="researcherID" class="form-label">Research Leader<span class="text-danger">*</span></label>
                <select name="researcherID" class="form-control" required>
                    <option value="">Select Researcher</option>
                    @foreach($researchers as $researcher)
                        <option value="{{ $researcher->id }}">{{ $researcher->researcherName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="agencyID" class="form-label">Agency<span class="text-danger"></span></label>
                <select name="agencyID" class="form-control">
                    <option value="">Select Agency</option>
                    @foreach($agencies as $agency)
                        <option value="{{ $agency->id }}">{{ $agency->agencyName }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                <input type="text" name="status" class="form-control" placeholder="Status" required>
            </div>
            <div class="col">
                <label for="researchType" class="form-label">Research Type<span class="text-danger">*</span></label>
                <input type="text" name="researchType" class="form-control" placeholder="Type" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="researchTitle" class="form-label">Research Title<span class="text-danger">*</span></label>
                <input type="text" name="researchTitle" class="form-control" placeholder="Title" required>
            </div>
        </div>  
        <div class="row mb-3">
            <div class="col">
                <label for="startDate" class="form-label">Start Date<span class="text-danger">*</span></label>
                <input type="date" name="startDate" class="form-control" placeholder="Start Date" required>
            </div>
            <div class="col">
                <label for="endDate" class="form-label">End Date<span class="text-danger"></span></label>
                <input type="date" name="endDate" class="form-control" placeholder="End Date">
            </div>
        </div>        
        <div class="row mb-3">
            <div class="col">
                <label for="link_1" class="form-label">Link<span class="text-danger"></span></label>
                <input type="text" name="link_1" class="form-control" placeholder="Link 1">
            </div>
            <div class="col">
                <label for="link_1" class="form-label">Link<span class="text-danger"></span></label>
                <input type="text" name="link_2" class="form-control" placeholder="Link 2">
            </div>
            <div class="col">
                <label for="link_1" class="form-label">Link<span class="text-danger"></span></label>
                <input type="text" name="link_3" class="form-control" placeholder="Link 3">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="extension" class="form-label">Extension<span class="text-danger"></span></label>
                <input type="text" name="extension" class="form-control" placeholder="Extension">
            </div>
            <div class="col">
                <label for="internalFund" class="form-label">Internal Fund<span class="text-danger"></span></label>
                <select class="custom-select" id="internalFund" name="internalFund">
                    <option value="">Internal Fund</option>
                    <option value="true">True</option>
                    <option value="false">False</option>
                </select>
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