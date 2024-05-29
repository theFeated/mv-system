@extends('layouts.app')
  
@section('title', '')
  
@section('contents')

@include('monitorings.modal', ['researchId' => $research->id])
@include('externalfunds.modal', ['researchId' => $research->id])
@include('roleresearchassigned.modal')

@include('roleresearchassigned.edit', ['researchID' => $research->id])
@include('monitorings.edit', ['researchID' => $research->id])
@include('externalfunds.edit', ['researchId' => $research->id])

        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-2">
            <h3 class="mt-sm-3 mt-5">Details</h3>
            <div class="menu btn-group flex-md-row flex-column mt-sm-3 mt-3" role="group" aria-label="Menu">
                <button type="button" class="btn btn-outline-primary mb-2 mb-md-0 mr-md-0" onclick="$('#researchForm').show(); $('#monitoringsForm, #externalFundsForm, #roleResearchAssignedForm').hide();">Research Details</button>
                <button type="button" class="btn btn-outline-primary mb-2 mb-md-0 mr-md-0" onclick="$('#roleResearchAssignedForm').show(); $('#monitoringsForm, #externalFundsForm, #researchForm').hide();">Researchers Assigned</button>
                <button type="button" class="btn btn-outline-primary mb-2 mb-md-0 mr-md-0" onclick="$('#monitoringsForm').show(); $('#roleResearchAssignedForm, #externalFundsForm, #researchForm').hide();">Monitorings</button>
                <button type="button" class="btn btn-outline-primary mb-2 mb-md-0" onclick="$('#externalFundsForm').show(); $('#roleResearchAssignedForm, #monitoringsForm, #researchForm').hide();">External Funds</button>
                <button type="button" class="btn btn-outline-primary mb-2 mb-md-0" onclick="showAllArchivedItems();">Show All</button>
            </div>
            <div class="mt-3 mt-sm-3 d-flex justify-content-between">
                <a href="{{ route('generate-pdf', ['id' => $research->id]) }}" target="_blank" rel="noopener noreferrer" class="btn btn-info">Generate PDF</a>

                @if(Auth::user()->name == "Admin")
                <div class="dropdown ml-2">
                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Add
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#addnew">Add Researchers</a>
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#addMonitorings">Add Monitorings</a>
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#addExFunds">Add External Funds</a>
                    </div>
                </div>
                @endif

                <a href="{{ route('research') }}" class="btn btn-primary ml-2">Back</a>
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
    <div id="researchForm" style="display: none;">
        <h3 class="mb-0">Research Details</h3>
        <hr />
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
                <label class="form-label">Link</label>
                <input type="text" name="link_1" class="form-control" placeholder="Link 1" value="{{ $research->link_1 }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Link</label>
                <input type="text" name="link_2" class="form-control" placeholder="Link 2" value="{{ $research->link_2 }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Link</label>
                <input type="text" name="link_3" class="form-control" placeholder="Link 3" value="{{ $research->link_3 }}" readonly>
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
        <hr>
    </div>

    <div id="roleResearchAssignedForm" style="display: none;" class="mt-3">
        <form action="{{ route('roleresearchassigned.destroyMultiple') }}" method="POST" class="archive-form">
            @csrf
            @method('DELETE')
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h3 class="mb-0">Researcher</h3>
                @if(Auth::user()->name == "Admin")
                <button type="button" class="btn btn-danger mt-3 mt-md-0 archive-button" data-message="You can undo this later on the restore page.">Archive Selected</button>
                @endif
            </div>
            <hr />
            <div class="table-responsive-sm">
                <table id='recordTable' class='table table-hover table-bordered w-100'>
                    <thead class='table-primary'>
                        <tr>
                            <th>               
                                <input type="checkbox" id="select-all-checkbox">
                            </th>
                            <th>#</th>
                            <th>ID</th>
                            <th>Researcher</th>
                            <th>Role</th>
                            @if(Auth::user()->name == "Admin")
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if($roleresearchassigned->count() > 0)
                            @foreach($roleresearchassigned as $rs)
                                <tr>
                                    <td class="align-middle">
                                        <input type="checkbox" name="selected[]" value="{{ $rs->assignedID }}">
                                    </td>
                                    </form>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $rs->assignedID }}</td>
                                    <td class="align-middle">{{ $rs->researcher->researcherName }}</td>
                                    <td class="align-middle">{{ optional($rs->role)->roleName }}</td>
                                    @if(Auth::user()->name == "Admin")
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#edit{{ $rs->assignedID }}">Edit</a>
                                            <form action="{{ route('roleresearchassigned.destroy', $rs->assignedID) }}" method="POST" class="d-inline archive-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger m-0 archive-button">Archive</button>
                                            </form>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="9">Research not found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </form>
        <hr>
    </div>

    <div id="monitoringsForm" style="display: none;">
        <form action="{{ route('monitorings.destroyMultiple') }}" method="POST" class="archive-form">
            @csrf
            @method('DELETE')
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h3 class="mb-0">Monitorings</h3>
                @if(Auth::user()->name == "Admin")
                <button type="button" class="btn btn-danger mt-3 mt-md-0 archive-button" data-message="You can undo this later on the restore page.">Archive Selected</button>
                @endif
            </div>
            <hr />
            <div class="table-responsive-sm">
                <table id='recordTableTwo' class='table table-hover table-bordered w-100'>
                    <thead class='table-primary'>
                        <tr>
                            <th>               
                                <input type="checkbox" id="select-all-checkbox-two">
                            </th>
                            <th>#</th>
                            <th>Monitoring ID</th>
                            <th>Date</th>
                            <th>Research Status</th>
                            <th>Research Progress</th>
                            <th>Monitoring Personnel</th>
                            <th>Remarks</th>
                            @if(Auth::user()->name == "Admin")
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if($monitorings->count() > 0)
                            @foreach($monitorings as $monitoring)
                                <tr>
                                    <td class="align-middle">
                                        <input type="checkbox" name="selectedTwo[]" value="{{ $monitoring->monitoringID }}">
                                    </td>
                                    </form>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $monitoring->monitoringID }}</td>
                                    <td class="align-middle">{{ $monitoring->date }}</td>
                                    <td class="align-middle">{{ $monitoring->status }}</td>
                                    <td class="align-middle">{{ $monitoring->progress }}</td>
                                    <td class="align-middle">{{ $monitoring->monitoringPersonnel }}</td>
                                    <td class="align-middle">{{ $monitoring->remarks }}</td>
                                    @if(Auth::user()->name == "Admin")
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#edit{{ $monitoring->monitoringID }}">Edit</a>
                                            <form action="{{ route('monitorings.destroy', $monitoring->monitoringID) }}" method="POST" class="d-inline archive-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger m-0 archive-button">Archive</button>
                                            </form>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="9">No monitorings found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </form>
        <hr>
    </div>

    <div id="externalFundsForm" style="display: none;">
        <form action="{{ route('externalfunds.destroyMultiple') }}" method="POST" class="archive-form">
            @csrf
            @method('DELETE')
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="mb-0">External Funds</h3>
                @if(Auth::user()->name == "Admin")
                <button type="button" class="btn btn-danger mt-3 mt-md-0 archive-button" data-message="You can undo this later on the restore page.">Archive Selected</button>
                @endif
            </div>
            <hr />
            <div class="table-responsive-sm">
                <table id='recordTableThree' class='table table-hover table-bordered w-100'>
                    <thead class='table-primary'>
                        <tr>
                            <th>               
                                <input type="checkbox" id="select-all-checkbox-three">
                            </th>
                            <th>#</th>
                            <th>External Fund ID</th>
                            <th>Research ID</th>
                            <th>Agency</th>
                            <th>Contribution</th>
                            <th>Purpose</th>
                            @if(Auth::user()->name == "Admin")
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if($externalfunds->count() > 0)
                            @foreach($externalfunds as $externalFund)
                                <tr>
                                    <td class="align-middle">
                                        <input type="checkbox" name="selectedThree[]" value="{{ $externalFund->exFundID }}">
                                    </td>
                                    </form>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $externalFund->exFundID }}</td>
                                    <td class="align-middle">{{ $externalFund->researchID }}</td>
                                    <td class="align-middle">{{ $externalFund->agency->name }}</td>
                                    <td class="align-middle">{{ $externalFund->contribution }}</td>
                                    <td class="align-middle">{{ $externalFund->purpose }}</td>
                                    @if(Auth::user()->name == "Admin")
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#edit{{ $externalFund->exFundID }}">Edit</a>
                                            <form action="{{ route('externalfunds.destroy', $externalFund->exFundID) }}" method="POST" class="d-inline archive-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger m-0 archive-button">Archive</button>
                                            </form>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="8">No external funds found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </form>
        <hr>
    </div>
@endsection