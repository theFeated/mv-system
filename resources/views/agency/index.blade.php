@extends('layouts.app')

@section('title', '')

@section('contents')
<form method="POST" action="{{ route('agency.destroyMultiple') }}" class="archive-form">
        @csrf
        @method('DELETE')
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-2">
            <h2 class="mt-3 mb-3 mt-sm-3 mt-5">Agency List</h2>
            <div class="mb-3 mt-sm-3 mt-3 row mr-0">
                @if(Auth::user()->name == "Admin")
                <div class="mr-1">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Add
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href="{{ route('agency.create') }}" class="dropdown-item">Add Agency</a>
                    </div>
                </div>
                @endif
                <div>
                    <button class="btn btn-info dropdown-toggle" type="button" id="archiveDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Archive
                    </button>
                    <div class="dropdown-menu" aria-labelledby="archiveDropdownButton">
                        <a href="{{ route('agency.restore') }}" class="dropdown-item">Archived</a>
                        @if(Auth::user()->name == "Admin")
                        <button type="button" class="dropdown-item archive-button" data-message="You can undo this later on the restore page.">Archive Selected</button>
                        @endif
                    </div>
                </div>
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

        <table id='recordTable' class='table table-hover table-bordered'>
            <thead class='table-primary'>
                <tr>
                <th>               
                     <input type="checkbox" id="select-all-checkbox">
                </th>
                <th>#</th>
                <th>ID</th>
                <th>Agency Name</th>
                <th>Contact Person</th>
                <th>Address</th>
                <th>Telephone Number</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @if($agency->count() > 0)
                @foreach($agency as $rs)
                <tr>
                    <td class="align-middle">
                        <input type="checkbox" name="selected[]" value="{{ $rs->id }}">
                    </td>
                    </form>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $rs->id }}</td>
                    <td class="align-middle">{{ $rs->agencyName }}</td>
                    <td class="align-middle">{{ $rs->contactPerson }}</td>
                    <td class="align-middle">{{ $rs->address }}</td>
                    <td class="align-middle">{{ $rs->telNum }}</td>
                    <td class="align-middle">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('agency.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                            @if(Auth::user()->name == "Admin")
                            <a href="{{ route('agency.edit', $rs->id) }}" type="button" class="btn btn-warning">Edit</a>
                            <form action="{{ route('agency.destroy', $rs->id) }}" method="POST" class="d-inline archive-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger m-0 archive-button" data-message="You can undo this later on the restore page.">Archive</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td class="text-center" colspan="8">Agency not found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </form>
@endsection
