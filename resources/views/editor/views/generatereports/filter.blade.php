@extends('editor.views.layouts.app')

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
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Select Report Types:</label>
                <div>
                    @foreach($uniqueStatuses as $status)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="reportTypes[]" id="reportType-{{ $status }}" value="{{ $status }}">
                            <label class="form-check-label" for="reportType-{{ $status }}">{{ ucfirst($status) }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="limit">Number of Research Items:</label>
                <input type="number" name="limit" id="limit" class="form-control" min="1" max="100" value="10">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="minPercentage">Minimum Percentage of Completion:</label>
                <input type="number" name="minPercentage" id="minPercentage" class="form-control" min="0" max="100">
            </div>
            <div class="form-group col-md-6">
                <label for="maxPercentage">Maximum Percentage of Completion:</label>
                <input type="number" name="maxPercentage" id="maxPercentage" class="form-control" min="0" max="100">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="startDate">Start Date:</label>
                <input type="date" name="startDate" id="startDate" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="endDate">End Date:</label>
                <input type="date" name="endDate" id="endDate" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label>Select Columns to Include in Report:</label>
            <ul id="column-list">
                @foreach(['researchTitle' => 'Program/Project/Study Title', 
                'projectDuration' => 'Project Duration based on Special Order', 
                'reference' => 'Reference', 'projectTeam' => 'Project Team', 
                'designation' => 'Designation', 'funding' => 'Source of Funding', 
                'totalBudget' => 'Total Budget', 'budgetUtilized' => 'Budget Utilized',
                'percentageOfCompletion' => 'Percentage of Completion', 
                'specialOrder' => 'Special Order', 
                'collaboratingAgency' => 'Collaborating College/Agency', 
                'fieldOfStudy' => 'Field of Study', 'status' => 'Status', 
                'yearCompleted' => 'Year Completed', 
                'remarks' => 'Remarks'] as $column => $title)
                    <li>
                        <input type="checkbox" name="columns[]" value="{{ $column }}" checked>
                        <label>{{ $title }}</label>
                        <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                    </li>
                @endforeach
            </ul>
            <input type="hidden" name="column-order" id="column-order" value="">
        </div>

        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sortablejs@1.10.2/Sortable.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.10.2/Sortable.min.js"></script>

    <script>
        const columnList = document.getElementById('column-list');
        const columnOrderInput = document.getElementById('column-order');

        Sortable.create(columnList, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            onUpdate: function(event) {
                const newColumnOrder = Array.prototype.slice.call(columnList.children).map(function(column) {
                    return column.querySelector('input').value;
                }).join(',');

                columnOrderInput.value = newColumnOrder;
            }
        });
    </script>
@endsection
