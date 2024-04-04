@extends('layouts.app')

@section('title', '')

@section('contents')
<form method="POST" action="{{ route('researcher.destroyMultiple') }}" onsubmit="return confirm('Archive Multiple Researchers?')">
    @csrf
    @method('DELETE')
    <div class="row offset-sm-9 offset-3">
            <div class="dropdown mr-2">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Add
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="{{ route('researcher.create') }}" class="dropdown-item">Add Researcher</a>
                </div>  
            </div>
            <div class="">
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" id="archiveDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Archive
                    </button>
                    <div class="dropdown-menu" aria-labelledby="archiveDropdownButton">
                        <a href="{{ route('researcher.restore') }}" class="dropdown-item">Archived</a>
                        <button type="submit" class="dropdown-item">Archive Selected</button>
                    </div>
                </div>
            </div>
        </div>

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

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>               
                            <input type="checkbox" id="select-all-checkbox">
                        </th>
                        <th>#</th>
                        <th>ID</th>
                        <th>College ID</th>
                        <th>Researcher Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($researcher->count() > 0)
                    @foreach($researcher as $rs)
                    <tr>
                        <td class="align-middle">
                            <input type="checkbox" name="selected[]" value="{{ $rs->researcherID }}">
                        </td>
                        </form>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->researcherID }}</td>
                        <td class="align-middle">{{ $rs->collegeID }}</td>
                        <td class="align-middle">{{ $rs->researcherName }}</td>
                        <td class="align-middle">{{ $rs->email }}</td>
                        <td class="align-middle">{{ $rs->contactNum }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('researcher.show', $rs->researcherID) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('researcher.edit', $rs->researcherID) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('researcher.destroy', $rs->researcherID) }}" method="POST" onsubmit="return confirm('Archive?')" class="d-inline">
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
                        <td class="text-center" colspan="5">Researcher not found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</form>
<script>
    document.getElementById("select-all-checkbox").addEventListener("click", function() {
        let checkboxes = document.querySelectorAll("input[name='selected[]']");
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = !checkbox.checked;
        });
    });
</script>
@endsection
