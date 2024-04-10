@extends('layouts.app')

@section('title', '')

@section('contents')
<form action="{{ route('researcher.unarchiveMultiple') }}" method="POST">
        @csrf
        @method('POST') 
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-2">
            <h3 class="mb-0 mt-sm-3 mt-5">Archived Researcher</h3>
            <div>
                <button type="submit" class="btn btn-success mt-sm-3 mt-3">Restore Selected</button>
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
                            <input type="checkbox" name="selected[]" value="{{ $researcher->researcherID }}">
                        </td>
                        </form>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $researcher->researcherID }}</td>
                        <td class="align-middle">{{ $researcher->collegeID }}</td>
                        <td class="align-middle">{{ $researcher->researcherName }}</td>
                        <td class="align-middle">{{ $researcher->email }}</td>
                        <td class="align-middle">{{ $researcher->contactNum }}</td>
                        <td>
                            <form action="{{ route('researcher.unarchive', $researcher->researcherID) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No archived researcher found</td>
                    </tr>
                @endforelse
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
