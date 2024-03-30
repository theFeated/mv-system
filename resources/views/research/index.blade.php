@extends('layouts.app')

@section('title', '')

@section('contents')

@include('roleresearchassigned.modal')

<form method="POST" action="{{ route('research.destroyMultiple') }}" onsubmit="return confirm('Archive Multiple Research?')">
        @csrf
        @method('DELETE')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Research</h1>
    <div>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Add
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a href="{{ route('research.create') }}" class="dropdown-item">Add Research</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addnew">Add Researchers</a>
            </div>
        <a href="{{ route('research.restore') }}" class="btn btn-info">Archived</a>
        <button type="submit" class="btn btn-info">Archive Selected</button>
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
    <script>
        document.getElementById("select-all-checkbox").addEventListener("click", function() {
            let checkboxes = document.querySelectorAll("input[name='selected[]']");
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = !checkbox.checked;
            });
        });
    </script>
@endsection
