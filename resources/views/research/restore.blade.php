@extends('layouts.app')

@section('title', '')

@section('contents')
<form action="{{ route('research.unarchiveMultiple') }}" method="POST">
        @csrf
        @method('POST') 
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Research</h1>
        <div>
            <button type="submit" class="btn btn-success">Restore Selected</button>
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

        <table class="table table-hover">
            <thead class="table-primary">
            <tr>
                <th>               
                     <input type="checkbox" id="select-all-checkbox">
                </th>
                <th>#</th>
                <th>Research ID</th>
                <th>College ID</th>
                <th>Researcher ID</th>
                <th>Title</th>
                <th>Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @forelse($archived as $research)
                    <tr>
                        <td class="align-middle">
                            <input type="checkbox" name="selected[]" value="{{ $research->researchID }}">
                        </td>
                        </form>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $research->id }}</td>
                        <td class="align-middle">{{ $research->collegeID }}</td>
                        <td class="align-middle">{{ $research->researcherID }}</td>
                        <td class="align-middle">{{ $research->researchTitle }}</td>
                        <td class="align-middle">{{ $research->researchType }}</td>
                        <td class="align-middle">{{ $research->status }}</td>
                        <td>
                            <form action="{{ route('research.unarchive', $research->researchID) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No archived research found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    <hr />
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Researchers</h1>
    </div>
    <hr />
        <table class="table table-hover">
            <thead class="table-primary">
            <tr>
                <th>               
                     <input type="checkbox" id="select-all-checkbox-two">
                </th>
                <th>#</th>
                <th>Assigned ID</th>
                <th>Role</th>
                <th>Researcher</th>
                <th>Research</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @forelse($archivedAssigned as $roleresearchassigned)
                    <tr>
                        <td class="align-middle">
                            <input type="checkbox" name="selectedTwo[]" value="{{ $roleresearchassigned->assignedID }}">
                        </td>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $roleresearchassigned->id }}</td>
                        <td class="align-middle">{{ $roleresearchassigned->role->roleName }}</td>
                        <td class="align-middle">{{ $roleresearchassigned->researcher->researcherName }}</td>
                        <td class="align-middle">{{ $roleresearchassigned->research->researchTitle }}</td>
                        <td>
                            <form action="{{ route('roleresearchassigned.unarchive', $roleresearchassigned->id) }}" method="POST">                                @csrf
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Not found</td>
                    </tr>
                @endforelse
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
        <script>
        document.getElementById("select-all-checkbox-two").addEventListener("click", function() {
            let checkboxes = document.querySelectorAll("input[name='selectedTwo[]']");
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = !checkbox.checked;
            });
        });
    </script> 
@endsection
