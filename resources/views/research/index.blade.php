@extends('layouts.app')

@section('title', '')

@section('contents')

@include('roleresearchassigned.modal')

<form method="POST" action="{{ route('research.destroyMultiple') }}" onsubmit="return confirm('Archive Multiple Research?')">
        @csrf
        @method('DELETE')
        <div class="row offset-sm-9 offset-3">
            <div class="dropdown mr-2">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Add
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="{{ route('research.create') }}" class="dropdown-item">Add Research</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addnew">Add Researchers</a>
                </div>
            </div>
            <div class="">
                <div class="dropdown">
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
                <td class="text-center" colspan="5">Research not found</td>
            </tr>
            @endif
        </tbody>
    </table>
        <div class='d-flex justify-content-center'>
        <nav aria-label='Page navigation'>
            <ul class='pagination'>
                <!-- Previous page link -->
                @if ($research->currentPage() > 1)
                    <li class='page-item'>
                        <a class='page-link' href='{{ $research->previousPageUrl() }}'>Previous</a>
                    </li>
                @endif

                <!-- Page links -->
                @for ($i = 1; $i <= $research->lastPage(); $i++)
                    <li class='page-item {{ ($research->currentPage() == $i) ? 'active' : '' }}'>
                        <a class='page-link' href='{{ $research->url($i) }}'>{{ $i }}</a>
                    </li>
                @endfor

                <!-- Next page link -->
                @if ($research->hasMorePages())
                    <li class='page-item'>
                        <a class='page-link' href='{{ $research->nextPageUrl() }}'>Next</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    </div>
    </div>
    <script>
        document.getElementById("select-all-checkbox").addEventListener("click", function() {
            let checkboxes = document.querySelectorAll("input[name='selected[]']");
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = !checkbox.checked;
            });
        });
    </script>
@endsection
