@extends('staff.views.layouts.app')

@section('title', '')

@section('contents')

    <form action="{{ route('research.unarchiveMultiple') }}" method="POST">
        @csrf
        @method('POST') 
        <hr />
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="mb-0">Researchers</h3>
            <div>
            @if(Auth::user()->name == "Admin")
                <button type="submit" class="btn btn-success mt-sm-3 mt-3">Restore Selected</button>
            @endif                
                <a href="{{ route('research') }}" class="btn btn-primary mt-sm-3 mt-3">Back</a>
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

        <div class="table-responsive-sm">
            <table id='recordTable' class='table table-hover table-bordered w-100'>
                <thead class='table-primary'>
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
                    @forelse($archived as $research)
                    <tr>
                        <td class="align-middle">
                            <input type="checkbox" name="selected[]" value="{{ $research->id }}">
                        </td>
                        </form>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $research->id }}</td>
                        <td class="align-middle">{{ $research->collegeID }}</td>
                        <td class="align-middle">{{ $research->researcherID }}</td>
                        <td class="align-middle">{{ $research->researchTitle }}</td>
                        <td class="align-middle">{{ $research->researchType }}</td>
                        <td class="align-middle">{{ $research->status }}</td>
                        <td>
                            <form action="{{ route('research.unarchive', $research->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No archived research found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </form>

@endsection
