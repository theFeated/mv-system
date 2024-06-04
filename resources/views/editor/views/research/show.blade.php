@extends('editor.views.layouts.app')
  
@section('title', '')
  
@section('contents')

@include('editor.views.monitorings.modal', ['researchId' => $research->id])
@include('editor.views.externalfunds.modal', ['researchId' => $research->id])
@include('editor.views.researchteam.modal', ['researchId' => $research->id])

@include('editor.views.researchteam.edit', ['researchID' => $research->id])
@include('editor.views.monitorings.edit', ['researchID' => $research->id])
@include('editor.views.externalfunds.edit', ['researchId' => $research->id])

        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-2">
            <h3 class="mt-sm-3 mt-5">Details</h3>
            <div class="menu btn-group flex-md-row flex-column mt-sm-3 mt-3" role="group" aria-label="Menu">
                <button type="button" class="btn btn-outline-primary mb-2 mb-md-0 mr-md-0" onclick="$('#researchForm').show(); $('#monitoringsForm, #externalFundsForm, #researchTeamForm').hide();">Research Details</button>
                <button type="button" class="btn btn-outline-primary mb-2 mb-md-0 mr-md-0" onclick="$('#researchTeamForm').show(); $('#monitoringsForm, #externalFundsForm, #researchForm').hide();">Research Team</button>
                <button type="button" class="btn btn-outline-primary mb-2 mb-md-0 mr-md-0" onclick="$('#monitoringsForm').show(); $('#researchTeamForm, #externalFundsForm, #researchForm').hide();">Monitorings</button>
                <button type="button" class="btn btn-outline-primary mb-2 mb-md-0" onclick="$('#externalFundsForm').show(); $('#researchTeamForm, #monitoringsForm, #researchForm').hide();">External Funds</button>
                <button type="button" class="btn btn-outline-primary mb-2 mb-md-0" onclick="showAllArchivedItems();">Show All</button>
            </div>
            <div class="mt-3 mt-sm-3 d-flex justify-content-between">
            <div class="dropdown ml-2">
                 <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Generate
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="{{ route('generate-pdf', ['id' => $research->id]) }}" target="_blank" rel="noopener noreferrer" class="dropdown-item">Generate PDF</a>
                    <form action="{{ route('generate-single-research-monitoring', ['id' => $research->id]) }}" method="POST" target="_blank" class="post">
                        @csrf
                        <button type="submit" class="dropdown-item">Single Research Monitorings</button>
                    </form>
                </div>
            </div>
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
                <input type="text" name="id" class="form-control" placeholder="ID"  value="{{ $research->id }}" readonly>
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
            <input type="text" class="form-control" value="{{ $research->isInternalFund ? 'True' : 'False' }}" readonly>
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

    <div id="researchTeamForm" style="display: none;" class="mt-3">
        <form action="{{ route('researchteam.removeMultiple') }}" method="POST" class="archive-form">
            @csrf
            @method('DELETE')
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h3 class="mb-0">Researcher</h3>
                <button type="button" class="btn btn-danger mt-3 mt-md-0 archive-button" data-message="You can undo this later on the restore page.">Remove Selected</button>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($researchteam->count() > 0)
                            @foreach($researchteam as $rs)
                                <tr>
                                    <td class="align-middle">
                                        <input type="checkbox" name="selected[]" value="{{ $rs->id }}">
                                    </td>
                                    </form>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $rs->id }}</td>
                                    <td class="align-middle">{{ $rs->researcher->researcherName }}</td>
                                    <td class="align-middle">{{ optional($rs->role)->roleName }}</td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#edit{{ $rs->id }}">Edit</a>
                                            <form action="{{ route('researchteam.remove', $rs->id) }}" method="POST" class="d-inline archive-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger m-0 archive-button">Remove</button>
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
            </div>
        </form>
        <hr>
    </div>

    <div id="monitoringsForm" style="display: none;">
        <form action="{{ route('monitorings.removeMultiple') }}" method="POST" class="archive-form">
            @csrf
            @method('DELETE')
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h3 class="mb-0">Monitorings</h3>
                <button type="button" class="btn btn-danger mt-3 mt-md-0 archive-button" data-message="You will remove this monitoring.">Remove Selected</button>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($monitorings->count() > 0)
                            @foreach($monitorings as $monitoring)
                                <tr>
                                    <td class="align-middle">
                                        <input type="checkbox" name="selectedTwo[]" value="{{ $monitoring->id }}">
                                    </td>
                                    </form>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $monitoring->id }}</td>
                                    <td class="align-middle">{{ $monitoring->date }}</td>
                                    <td class="align-middle">{{ $monitoring->status }}</td>
                                    <td class="align-middle">{{ $monitoring->progress }}</td>
                                    <td class="align-middle">{{ $monitoring->monitoringPersonnel }}</td>
                                    <td class="align-middle">{{ $monitoring->remarks }}</td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#edit{{ $monitoring->id }}">Edit</a>
                                            <form action="{{ route('monitorings.remove', $monitoring->id) }}" method="POST" class="d-inline archive-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger m-0 archive-button">Remove</button>
                                            </form>
                                        </div>
                                    </td>
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
        <form action="{{ route('externalfunds.removeMultiple') }}" method="POST" class="archive-form">
            @csrf
            @method('DELETE')
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="mb-0">External Funds</h3>
                <button type="button" class="btn btn-danger mt-3 mt-md-0 archive-button" data-message="The selected will be removed.">Remove Selected</button>
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
                            <th>Total Budget</th>
                            <th>Budget Utilized</th>
                            <th>Purpose</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($externalfunds->count() > 0)
                            @foreach($externalfunds as $externalFund)
                                <tr>
                                    <td class="align-middle">
                                        <input type="checkbox" name="selectedThree[]" value="{{ $externalFund->id }}">
                                    </td>
                                    </form>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $externalFund->id }}</td>
                                    <td class="align-middle">{{ $externalFund->researchID }}</td>
                                    <td class="align-middle">{{ $externalFund->agency->agencyName }}</td>
                                    <td class="align-middle">{{ $externalFund->total_budget }}</td>
                                    <td class="align-middle">{{ $externalFund->budget_utilized }}</td>
                                    <td class="align-middle">{{ $externalFund->purpose }}</td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#editFund{{ $externalFund->id }}">Edit</a>
                                            <form action="{{ route('externalfunds.remove', $externalFund->id) }}" method="POST" class="d-inline archive-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger m-0 archive-button">Remove</button>
                                            </form>
                                        </div>
                                    </td>
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