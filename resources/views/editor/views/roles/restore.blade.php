@extends('editor.views.layouts.app')

@section('title', '')

@section('contents')
<form action="{{ route('roles.unarchiveMultiple') }}" method="POST">
        @csrf
        @method('POST') 
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-2">
            <h3 class="mb-0 mt-sm-3 mt-5">Archived Roles</h3>
            <div>
                <button type="submit" class="btn btn-success mt-sm-3 mt-3">Restore Selected</button>
                <a href="{{ route('roles') }}" class="btn btn-primary mt-sm-3 mt-5">Back</a>
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
                <th>Roles ID</th>
                <th>Roles Name</th>
                <th>Roles Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @forelse($archived as $roles)
                    <tr>
                        <td class="align-middle">
                            <input type="checkbox" name="selected[]" value="{{ $roles->id }}">
                        </td>
                        </form>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $roles->id }}</td>
                        <td class="align-middle">{{ $roles->roleName }}</td>
                        <td class="align-middle">{{ $roles->roleDescription }}</td>
                        <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <form action="{{ route('roles.unarchive', $roles->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>
                            <form action="{{ route('roles.destroyForever', $roles->id) }}" method="POST" class="archive-form">
                                @csrf
                                @method('DELETE') 
                                <button type="button" class="btn btn-danger m-0 archive-button" data-message="This will be permanently deleted.">Delete</button>
                            </form>
                        </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No archived Researches found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>  
</form>

@endsection
