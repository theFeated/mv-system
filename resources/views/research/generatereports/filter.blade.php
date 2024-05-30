@extends('layouts.app')

@section('title', '')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0  mt-sm-3 mt-5">Edit Research</h3>
            <div>
                <a href="{{ route('research') }}" class="btn btn-primary  mt-sm-3 mt-5">Back</a>
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

    <form action="{{ route('generate-all-monitorings', ['id' => $research->id]) }}" method="POST" target="_blank" class="post">
        @csrf
        <div class="form-group">
            <label for="year">Select Year:</label>
            <select name="year" id="year" class="form-control">
                @for ($year = date('Y'); $year >= 2010; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="dropdown-item">Generate  Research Monitorings</button>
    </form>

@endsection