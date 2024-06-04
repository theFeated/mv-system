@extends('admin.views.layouts.app')

@section('title', '')

@section('contents')
    <form method="POST" action="{{ route('users.destroyMultiple') }}" class="archive-form">
        @csrf
        @method('DELETE')
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-2">
            <h2 class="mt-3 mb-3 mt-sm-3 mt-5">User List</h2>
            <div class="mb-3 mt-sm-3 mt-3 row mr-0">
                <div class="mr-1">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Add
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href="{{ route('users.create') }}" class="dropdown-item">Add User</a>
                    </div>
                </div>
                <div>
                    <button class="btn btn-info dropdown-toggle" type="button" id="archiveDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Archive
                    </button>
                    <div class="dropdown-menu" aria-labelledby="archiveDropdownButton">
                        <a href="{{ route('users.restore') }}" class="dropdown-item">Archived</a>
                        <button type="button" class="dropdown-item archive-button" data-message="You can undo this later on the restore page.">Archive Selected</button>
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
                        <th>ID</th>
                        <th>ResearchID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    @if($users->count() > 0)
                    @foreach($users as $user)
                    <tr>
                        <td class="align-middle">
                            <input type="checkbox" name="selected[]" value="{{ $user->id }}">
                        </td>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $user->id }}</td>
                        <td class="align-middle">{{ $user->researchID }}</td>
                        <td class="align-middle">{{ $user->name }}</td>
                        <td class="align-middle">{{ $user->email }}</td>
                        <td class="align-middle">{{ $user->phone }}</td>
                        <td class="align-middle">{{ $user->role }}</td>
                        <!-- <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('users.show', $user->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('users.edit', $user->id) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline archive-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger m-0 archive-button" data-message="You can undo this later on the restore page.">Archive</button>
                                </form>
                            </div>
                        </td> -->
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="8">No users found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
    </form>
@endsection
