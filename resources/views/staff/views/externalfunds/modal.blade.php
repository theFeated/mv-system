@php
    use App\Models\Agency;
    $agencies = Agency::all();
@endphp

<div class="modal fade my-modal" id="addExFunds" tabindex="-1" aria-labelledby="addMonitoringsModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewModalLabel">Add External Funds</h5>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">&times;</button>
            </div> 
            <div class="modal-body">
                <form action="{{ route('externalfunds.save') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="researchID" class="form-label">Research ID<span class="text-danger">*</span></label>
                            <input type="text" id="researchID" name="researchID" class="form-control" value="{{ $researchId }}" readonly>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col">
                            <label for="agencyID" class="form-label">Agency<span class="text-danger"></span></label>
                            <select name="agencyID" class="form-control">
                                <option value="">Select Agency</option>
                                @foreach($agencies as $agency)
                                    <option value="{{ $agency->id }}">{{ $agency->agencyName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="total_budget" class="form-label">Total Budget<span class="text-danger">*</span></label>
                            <input type="number" name="total_budget" class="form-control" placeholder="Enter Amount" required>
                        </div>
                        <div class="col">
                            <label for="budget_utilized" class="form-label">Budget Utilized<span class="text-danger">*</span></label>
                            <input type="number" name="budget_utilized" class="form-control" placeholder="Enter Amount" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="purpose" class="form-label">Purpose<span class="text-danger">*</span></label>
                            <textarea name="purpose" class="form-control" placeholder="Enter Purpose" rows="5"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
