@php

    use App\Models\Agency;

    $agencies = Agency::all();

@endphp

@foreach ($externalfunds as $item)
<div class="modal fade my-modal" id="editFund{{ $item->id }}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('externalfunds.update', $item->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">						
                    <h4 class="modal-title">Edit External Fund</h4>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">					
                    <div class="form-group">
                        <label>External Fund ID</label>
                        <input type="text" class="form-control" name="id" value="{{ $item->id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Research ID</label>
                        <input type="text" class="form-control" name="researchID" value="{{ $item->researchID }}">
                    </div>
                    <div class="form-group">
                        <label>Agency</label>
                        <select name="agencyID" class="form-control" required>
                            @foreach ($agencies as $agency)
                                <option value="{{ $agency->id }}" {{ $agency->id == $item->agencyID? 'elected' : '' }}>{{ $agency->agencyName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Total Budget</label>
                        <input type="text" class="form-control" name="total_budget" value="{{ $item->total_budget }}">
                    </div>
                    <div class="form-group">
                        <label>Budget Utlized</label>
                        <input type="text" class="form-control" name="budget_utilized" value="{{ $item->budget_utilized }}">
                    </div>
                    <div class="form-group">
                        <label>Purpose</label>
                        <textarea class="form-control" name="purpose">{{ $item->purpose }}</textarea>
                    </div>					
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary my-modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach