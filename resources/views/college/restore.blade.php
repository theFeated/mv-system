@extends('layouts.app')

@section('title', '')

@section('contents')
<form action="{{ route('college.unarchiveMultiple') }}" method="POST">
        @csrf
        @method('POST') 
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-2">
            <h3 class="mb-0 mt-sm-3 mt-5">Archived Colleges</h3>
            <div>
                <button type="submit" class="btn btn-success mt-sm-3 mt-3">Restore Selected</button>
                <a href="{{ route('college') }}" class="btn btn-primary mt-sm-3 mt-3">Back</a>
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
                <th>College ID</th>
                <th>College Name</th>
                <th>College Dean</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
                @forelse($archivedColleges as $college)
                    <tr>
                        <td class="align-middle">
                            <input type="checkbox" name="selected[]" value="{{ $college->collegeID }}">
                        </td>
                        </form>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $college->collegeID }}</td>
                        <td class="align-middle">{{ $college->collegeName }}</td>
                        <td class="align-middle">{{ $college->collegeDean }}</td>
                        <td>
                            <form action="{{ route('college.unarchive', $college->collegeID) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No archived colleges found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
@endsection
