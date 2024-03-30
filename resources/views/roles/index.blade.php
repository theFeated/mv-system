@extends('layouts.app')

@section('title', '')

@section('contents')
<form method="POST" action="{{ route('roles.destroyMultiple') }}" onsubmit="return confirm('Archive Multiple Roles?')">
        @csrf
        @method('DELETE')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Roles</h1>
    <div>
        <a href="{{ route('roles.create') }}" class="btn btn-primary">Add Roles</a>
        <a href="{{ route('roles.restore') }}" class="btn btn-info">Archived</a>
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
                <th>Roles ID</th>
                <th>Roles Name</th>
                <th>Roles Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($roles->count() > 0)
            @foreach($roles as $rs)
            <tr>
                <td class="align-middle">
                    <input type="checkbox" name="selected[]" value="{{ $rs->roleID }}">
                </td>
                </form>
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $rs->id }}</td>
                <td class="align-middle">{{ $rs->roleName }}</td>
                <td class="align-middle">{{ $rs->roleDescription }}</td>
                <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('roles.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                        <a href="{{ route('roles.edit', $rs->id) }}" type="button" class="btn btn-warning">Edit</a>
                        <form action="{{ route('roles.destroy', $rs->id) }}" method="POST" onsubmit="return confirm('Archive?')" class="d-inline">
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
                <td class="text-center" colspan="5">Roles not found</td>
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
