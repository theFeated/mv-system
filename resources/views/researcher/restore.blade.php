@extends('layouts.app')

@section('title', '')

@section('contents')
<form action="{{ route('researcher.unarchiveMultiple') }}" method="POST">
        @csrf
        @method('POST') 
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-2">
            <h3 class="mb-0 mt-sm-3 mt-5">Archived Researcher</h3>
            <div>
            @if(Auth::user()->name == "Admin")
                <button type="submit" class="btn btn-success mt-sm-3 mt-3">Restore Selected</button>
            @endif                
                <a href="{{ route('researcher') }}" class="btn btn-primary mt-sm-3 mt-3">Back</a>
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
                <th>College ID</th>
                <th>Researcher Name</th>
                <th>Email</th>
                <th>ContactNumber</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
                @forelse($archived as $researcher)
                    <tr>
                        <td class="align-middle">
                            <input type="checkbox" name="selected[]" value="{{ $researcher->id }}">
                        </td>
                        </form>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $researcher->id }}</td>
                        <td class="align-middle">{{ $researcher->collegeID }}</td>
                        <td class="align-middle">{{ $researcher->researcherName }}</td>
                        <td class="align-middle">{{ $researcher->email }}</td>
                        <td class="align-middle">{{ $researcher->contactNum }}</td>
                        <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <form action="{{ route('researcher.unarchive', $researcher->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>
                            <form action="{{ route('researcher.destroyForever', $researcher->id) }}" method="POST" class="archive-form">
                                @csrf
                                @method('DELETE') 
                                <button type="button" class="btn btn-danger m-0 archive-button" data-message="This will be permanently deleted.">Delete</button>
                            </form>
                        </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No archived researcher found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>   
@endsection
