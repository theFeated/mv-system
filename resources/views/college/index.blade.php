@extends('layouts.app')

@section('title', '')

@section('contents')
<form method="POST" action="{{ route('college.destroyMultiple') }}" onsubmit="return confirm('Archive Multiple Colleges?')">
        @csrf
        @method('DELETE')
        <div class="row offset-sm-9 offset-3">
            <div class="dropdown mr-2">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Add
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="{{ route('college.create') }}" class="dropdown-item">Add College</a>
                </div>
            </div>
            <div class="">
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" id="archiveDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Archive
                    </button>
                    <div class="dropdown-menu" aria-labelledby="archiveDropdownButton">
                        <a href="{{ route('college.restore') }}" class="dropdown-item">Archived</a>
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
        <thead class="table-primary">
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
    <div class='d-flex justify-content-center'>
            <nav aria-label='Page navigation'>
                <ul class='pagination'>
                    <!-- Previous page link -->
                    @if ($college->currentPage() > 1)
                        <li class='page-item'>
                            <a class='page-link' href='{{ $college->previousPageUrl() }}'>Previous</a>
                        </li>
                    @endif

                    <!-- Page links -->
                    @for ($i = 1; $i <= $college->lastPage(); $i++)
                        <li class='page-item {{ ($college->currentPage() == $i) ? 'active' : '' }}'>
                            <a class='page-link' href='{{ $college->url($i) }}'>{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- Next page link -->
                    @if ($college->hasMorePages())
                        <li class='page-item'>
                            <a class='page-link' href='{{ $college->nextPageUrl() }}'>Next</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
    </div>
    <script>
        document.getElementById("select-all-checkbox").addEventListener("click", function() {
            let checkboxes = document.querySelectorAll("input[name='selectedColleges[]']");
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = !checkbox.checked;
            });
        });
    </script>
@endsection
