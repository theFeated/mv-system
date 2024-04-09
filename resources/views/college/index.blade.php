@extends('layouts.app')

@section('title', '')

@section('contents')
<form method="POST" action="{{ route('college.destroyMultiple') }}" onsubmit="return confirm('Archive Multiple Colleges?')">
        @csrf
        @method('DELETE')
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-2">
            <h2 class="mt-3 mb-3">College List</h2>
            <div class="dropdown ml-md-auto mt-3 mt-md-0">
                <button class="btn btn-primary dropdown-toggle" type="button" id="collegeDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Add
                </button>
                <div class="dropdown-menu" aria-labelledby="collegeDropdownButton">
                    <a href="{{ route('college.create') }}" class="dropdown-item">Add College</a>
                </div>
            </div>
            <div class="dropdown ml-2 mt-3 mt-md-0">
                <button class="btn btn-info dropdown-toggle" type="button" id="archiveCollegeDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Archive
                </button>
                <div class="dropdown-menu" aria-labelledby="archiveCollegeDropdownButton">
                    <a href="{{ route('college.restore') }}" class="dropdown-item">Archived</a>
                    <button type="submit" class="dropdown-item">Archive Selected</button>
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
        <table id='recordTable' class='table table-hover table-bordered'>
            <thead class='table-primary'>
                <tr>
                <th>               
                     <input type="checkbox" id="select-all-checkbox">
                </th>
                <th>#</th>
                <th>ID</th>
                <th>College Name</th>
                <th>College Dean</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($college->count() > 0)
            @foreach($college as $rs)
            <tr>
                <td class="align-middle">
                    <input type="checkbox" name="selectedColleges[]" value="{{ $rs->collegeID }}">
                </td>
                </form>
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $rs->collegeID }}</td>
                <td class="align-middle">{{ $rs->collegeName }}</td>
                <td class="align-middle">{{ $rs->collegeDean }}</td>
                <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('college.show', $rs->collegeID) }}" type="button" class="btn btn-secondary">Detail</a>
                        <a href="{{ route('college.edit', $rs->collegeID) }}" type="button" class="btn btn-warning">Edit</a>
                        <form action="{{ route('college.destroy', $rs->collegeID) }}" method="POST" onsubmit="return confirm('Archive?')" class="d-inline">
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
                <td class="text-center" colspan="5">College not found</td>
            </tr>
            @endif
        </tbody>
    </table>
</form>
@endsection
