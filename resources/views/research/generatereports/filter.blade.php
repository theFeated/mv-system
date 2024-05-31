@extends('layouts.app')

@section('title', '')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mt-sm-3 mt-5">Generate Research Monitoring Report</h3>
        <div>
            <a href="{{ route('research') }}" class="btn btn-primary mt-sm-3 mt-5">Back</a>
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

    <form action="{{ route('generate-all-monitorings') }}" method="POST" target="_blank" class="post">
        @csrf
        <div class="form-group">
            <label for="reportType">Select Report Type:</label>
            <select name="reportType" id="reportType" class="form-control">
                <option value="all">All</option>
                <option value="completed">Completed</option>
                <option value="ongoing">Ongoing</option>
            </select>
        </div>
        <div class="form-group">
            <label for="startDate">Start Date:</label>
            <input type="date" name="startDate" id="startDate" class="form-control">
        </div>
        <div class="form-group">
            <label for="endDate">End Date:</label>
            <input type="date" name="endDate" id="endDate" class="form-control">
        </div>
        <div class="form-group">
            <label for="limit">Number of Research Items:</label>
            <input type="number" name="limit" id="limit" class="form-control" min="1" max="100" value="10">
        </div>
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>
@endsection
