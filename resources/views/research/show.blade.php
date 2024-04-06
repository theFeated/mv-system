@extends('layouts.app')
  
@section('title', '')
  
@section('contents')

@include('monitorings.modal', ['researchId' => $research->id])
@include('externalfunds.modal', ['researchId' => $research->id])
@include('roleresearchassigned.modal')

@include('roleresearchassigned.edit', ['researchID' => $research->id])
@include('monitorings.edit', ['researchID' => $research->id])
@include('externalfunds.edit', ['researchId' => $research->id])

    <div class="d-flex align-items-center justify-content-between ">
        <h1 class="mb-0">Research Details</h1>
        <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Add
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addnew">Add Researchers</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addMonitorings">Add Monitorings</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addExFunds">Add External Funds</a>
            </div>
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
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">ID</label>
                <input type="text" name="researchID" class="form-control" placeholder="ID"  value="{{ $research->researchID }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">College</label>
                <input type="text" class="form-control" placeholder="College" value="{{ $college ? $college->collegeName : '' }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Researcher</label>
                <input type="text" class="form-control" placeholder="Researcher" value="{{ $researcher ? $researcher->researcherName : '' }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Agency</label>
                <input type="text" class="form-control" placeholder="Agency" value="{{ $agency ? $agency->agencyName : '' }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Status</label>
                <input type="text" name="status" class="form-control" placeholder="Status" value="{{ $research->status }}" readonly >
            </div>
            <div class="col mb-3">
                <label class="form-label">Research Type</label>
                <input type="text" name="researchType" class="form-control" placeholder="Research Type" value="{{ $research->researchType }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Research Title</label>
                <input type="text" name="researchTitle" class="form-control" placeholder="Research Title" value="{{ $research->researchTitle }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Year</label>
                <input type="year" name="year" class="form-control" placeholder="Year" value="{{ $research->year }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Start Date</label>
                <input type="date" name="startDate" class="form-control" placeholder="Start Date" value="{{ $research->startDate }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">End Date</label>
                <input type="date" name="endDate" class="form-control" placeholder="End Date" value="{{ $research->endDate }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Extension</label>
                <input type="text" name="extension" class="form-control" placeholder="Extension" value="{{ $research->extension }}" readonly>
            </div>
            <div class="col mb-3">
            <label class="form-label">Internal Fund</label>
            <input type="text" class="form-control" value="{{ $research->internalFund ? 'True' : 'False' }}" readonly>
        </div>
        </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $research->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $research->updated_at }}" readonly>
        </div>
    </div>
    <hr />

@section('title', '')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Researcher</h1>
</div>
<hr />

<table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>               
                     <input type="checkbox" id="select-all-checkbox">
                </th>
                <th>#</th>
                <th>ID</th>
                <th>Researcher</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($roleresearchassigned->count() > 0)
                @foreach($roleresearchassigned as $rs)
                    <tr>
                        <td class="align-middle">
                            <input type="checkbox" name="selected[]" value="{{ optional($rs->role)->roleName }}">
                        </td>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->assignedID }}</td>
                        <td class="align-middle">{{ $rs->researcher->researcherName }}</td>
                        <td class="align-middle">{{ optional($rs->role)->roleName }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#edit{{ $rs->assignedID }}">Edit</a>
                                <form action="{{ route('roleresearchassigned.destroy', $rs->assignedID) }}" method="POST" onsubmit="return confirm('Archive?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger m-0">Archive</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="9">Research not found</td>
                </tr>
            @endif
        </tbody>
    </table>

<hr />
@section('title', '')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Monitorings</h1>
</div>
<hr />

<table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>               
                     <input type="checkbox" id="select-all-checkbox">
                </th>
                <th>#</th>
                <th>Monitoring ID</th>
                <th>Date</th>
                <th>Research Status</th>
                <th>Research Progress</th>
                <th>Monitoring Personnel</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($monitorings->count() > 0)
            @foreach($monitorings as $rs)
            <tr>
                <td class="align-middle">
                    <input type="checkbox" name="selected[]" value="{{ $rs->researchID }}">
                </td>
                </form>
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $rs->id }}</td>
                <td class="align-middle">{{ $rs->date }}</td>
                <td class="align-middle">{{ $rs->status }}</td>
                <td class="align-middle">{{ $rs->progress }}</td>
                <td class="align-middle">{{ $rs->monitoringPersonnel }}</td>
                <td class="align-middle">{{ $rs->remarks }}</td>
                <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                    <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#edit{{ $rs->monitoringID }}">Edit</a>        
                    <form action="{{ route('research.destroy', $rs->id) }}" method="POST" onsubmit="return confirm('Archive?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger m-0">Archive</button>
                        </form>
                    </div>
                </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="9" class="text-center">Nothing is found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <hr />
@section('title', '')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">External Funds</h1>
</div>
<hr />

<table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>               
                     <input type="checkbox" id="select-all-checkbox">
                </th>
                <th>#</th>
                <th>External Fund ID</th>
                <th>Funding Agency</th>
                <th>Contribution</th>
                <th>Purpose</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($externalfunds->count() > 0)
            @foreach($externalfunds as $rs)
            <tr>
                <td class="align-middle">
                    <input type="checkbox" name="selected[]" value="{{ $rs->researchID }}">
                </td>
                </form>
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $rs->id }}</td>
                <td class="align-middle">{{ $rs->agency->agencyName }}</td>
                <td class="align-middle">{{ $rs->contribution }}</td>
                <td class="align-middle">{{ $rs->purpose }}</td>
                <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                    <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#edit{{ $rs->exFundID }}">Edit</a>
                        <form action="{{ route('research.destroy', $rs->id) }}" method="POST" onsubmit="return confirm('Archive?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger m-0">Archive</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td class="text-center" colspan="9">Nothing is found</td>
            </tr>
            @endif
        </tbody>
    </table>
    <script>
        document.getElementById("select-all-checkbox").addEventListener("click", function() {
            let checkboxes = document.querySelectorAll("input[name='selected[]']");
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = !checkbox.checked;
            });
        });
    </script>

@endsection