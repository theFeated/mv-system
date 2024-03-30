@php
    use App\Models\ExternalFunds;
    use App\Models\Agency;

    $agencies = Agency::all();

    // Retrieve the latest record (including archived data) from the ExternalFunds model
    $latest = ExternalFunds::withTrashed()->orderBy('exFundID', 'desc')->first();

    if ($latest) {
        // Extract the numeric part of the identifier
        $numericPart = intval(substr($latest->exFundID, 2)) + 1;
    } else {
        $numericPart = 1;
    }

    $exFundID = "ExF-" . str_pad($numericPart, 3, '0', STR_PAD_LEFT);

@endphp

<div class="modal fade" id="addExFunds" tabindex="-1" aria-labelledby="addMonitoringsModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewModalLabel">Add External Funds</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()">&times;</button>
            </div> 
            <div class="modal-body">
                <form action="{{ route('externalfunds.save') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="exFundID" class="form-label">External Funds ID<span class="text-danger">*</span></label>
                            <input type="text" id="exFundID" name="exFundID" class="form-control" value="{{ $exFundID }}" required readonly>
                        </div>
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
                        <div class="col">
                            <label for="contribution" class="form-label">Contribution<span class="text-danger">*</span></label>
                            <input type="number" name="contribution" class="form-control" placeholder="Enter Amount" required>
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
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function closeModal() {
        $('#addExFunds').modal('hide');
    }
</script>
