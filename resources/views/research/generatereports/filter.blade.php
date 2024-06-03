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
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="reportType">Select Report Type:</label>
                <select name="reportType" id="reportType" class="form-control">
                    <option value="all">All</option>
                    @foreach($uniqueStatuses as $status)
                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="limit">Number of Research Items:</label>
                <input type="number" name="limit" id="limit" class="form-control" min="1" max="100" value="10">
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
                <li>
                    <input type="checkbox" name="columns[]" value="researchTitle" checked>
                    <span>Program/Project/Study Title</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="projectDuration" checked>
                    <span>Project Duration based on Special Order</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="reference" checked>
                    <span>Reference</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="projectTeam" checked>
                    <span>Project Team</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="designation" checked>
                    <span>Designation</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="funding" checked>
                    <span>Source of Funding</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="totalBudget" checked>
                    <span>Total Budget</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="budgetUtilized" checked>
                    <span>Budget Utilized</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="percentageOfCompletion" checked>
                    <span>Percentage of Completion</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="specialOrder" checked>
                    <span>Special Order</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="collaboratingAgency" checked>
                    <span>Collaborating College/Agency</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="fieldOfStudy" checked>
                    <span>Field of Study</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="status" checked>
                    <span>Status</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="yearCompleted" checked>
                    <span>Year Completed</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
                <li>
                    <input type="checkbox" name="columns[]" value="remarks" checked>
                    <span>Remarks</span>
                    <i class="fas fa-arrows-alt" aria-hidden="true"></i>
                </li>
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
        ghostClass: 'ortable-ghost',
        onUpdate: function(event) {
            const newColumnOrder = Array.prototype.slice.call(columnList.children).map(function(column) {
                return column.querySelector('input').value;
            }).join(',');

            columnOrderInput.value = newColumnOrder;
        }
    });
</script>
@endsection