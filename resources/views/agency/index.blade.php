@extends('layouts.app')

@section('title', '')

@section('contents')
<form method="POST" action="{{ route('agency.destroyMultiple') }}" onsubmit="return confirm('Archive Multiple Agencys?')">
        @csrf
        @method('DELETE')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Agency</h1>
    <div>
        <a href="{{ route('agency.create') }}" class="btn btn-primary">Add Agency</a>
        <a href="{{ route('agency.restore') }}" class="btn btn-info">Archived</a>
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
                    <input type="checkbox" name="selected[]" value="{{ $rs->agencyID }}">
                </td>
                </form>
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $rs->agencyID }}</td>
                <td class="align-middle">{{ $rs->agencyName }}</td>
                <td class="align-middle">{{ $rs->contactPerson }}</td>
                <td class="align-middle">{{ $rs->address }}</td>
                <td class="align-middle">{{ $rs->telNum }}</td>
                <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('agency.show', $rs->agencyID) }}" type="button" class="btn btn-secondary">Detail</a>
                        <a href="{{ route('agency.edit', $rs->agencyID) }}" type="button" class="btn btn-warning">Edit</a>
                        <form action="{{ route('agency.destroy', $rs->agencyID) }}" method="POST" onsubmit="return confirm('Archive?')" class="d-inline">
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
                <td class="text-center" colspan="5">Agency not found</td>
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
