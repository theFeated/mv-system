@extends('layouts.app')

@section('title', '')

@section('contents')
<form action="{{ route('college.unarchiveMultiple') }}" method="POST">
        @csrf
        @method('POST') 
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Archived Colleges</h1>
        <div>
            <button type="submit" class="btn btn-success">Restore Selected</button>
            <a href="{{ route('college') }}" class="btn btn-primary">Back</a>
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
                            <input type="checkbox" name="selectedColleges[]" value="{{ $college->collegeID }}">
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
                        <td colspan="5" class="text-center">No archived colleges found</td>
                    </tr>
                @endforelse
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