@extends('layouts.app')

@section('title', '')

@section('contents')

@include('roleresearchassigned.modal')

    <form method="POST" action="{{ route('research.destroyMultiple') }}" onsubmit="return confirm('Archive Multiple Research?')">
        @csrf
        @method('DELETE')
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-2">
            <h2 class="mt-3 mb-3 mt-sm-3 mt-5">Research List</h2>
            <div class="mb-3 mt-sm-3 mt-3 row mr-0">
                <div class="mr-1">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Add
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href="{{ route('research.create') }}" class="dropdown-item">Add Research</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addnew">Add Researchers</a>
                    </div>
                </div>
                <div>
                    <button class="btn btn-info dropdown-toggle" type="button" id="archiveDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Archive
                    </button>
                    <div class="dropdown-menu" aria-labelledby="archiveDropdownButton">
                        <a href="{{ route('research.restore') }}" class="dropdown-item">Archived</a>
                        <button type="submit" class="dropdown-item">Archive Selected</button>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
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
                @if($research->count() > 0)
                    @foreach($research as $rs)
                        <tr>
                            <td class="align-middle">
                                <input type="checkbox" name="selected[]" value="{{ $rs->researchID }}">
                            </td>
                            </form>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $rs->id }}</td>
                            <td class="align-middle">{{ $rs->collegeID }}</td>
                            <td class="align-middle">{{ $rs->researcherID }}</td>
                            <td class="align-middle">{{ $rs->researchTitle }}</td>
                            <td class="align-middle">{{ $rs->researchType }}</td>
                            <td class="align-middle">{{ $rs->status }}</td>
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('research.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                    <a href="{{ route('research.edit', $rs->id) }}" type="button" class="btn btn-warning">Edit</a>
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
                        <td class="text-center" colspan="9">Research not found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </form>
@endsection
