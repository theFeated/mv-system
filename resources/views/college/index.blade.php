@extends('layouts.app')

@section('title', '')

@section('contents')
<form method="POST" action="{{ route('college.destroyMultiple') }}" onsubmit="return confirm('Archive Multiple Colleges?')">
        @csrf
        @method('DELETE')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">College</h1>
    <div>
        <a href="{{ route('college.create') }}" class="btn btn-primary">Add College</a>
        <a href="{{ route('college.restore') }}" class="btn btn-info">Archived</a>
        <button type="submit" class="btn btn-info">Archive Selected</button>
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
    <script>
        document.getElementById("select-all-checkbox").addEventListener("click", function() {
            let checkboxes = document.querySelectorAll("input[name='selectedColleges[]']");
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = !checkbox.checked;
            });
        });
    </script>
@endsection
