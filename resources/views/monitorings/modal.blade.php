@php
    use App\Models\Monitorings;

    // Retrieve the latest record (including archived data) from the Monitorings model
    $latest = Monitorings::withTrashed()->orderBy('monitoringID', 'desc')->first();

    if ($latest) {
        // Extract the numeric part of the identifier
        $numericPart = intval(substr($latest->monitoringID, 2)) + 1;
    } else {
        $numericPart = 1;
    }

    $monitoringID = "M-" . str_pad($numericPart, 3, '0', STR_PAD_LEFT);

@endphp

<div class="modal fade my-modal" id="addMonitorings" tabindex="-1" aria-labelledby="addResearcherModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewModalLabel">Add Monitorings</h5>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">&times;</button>
            </div> 
            <div class="modal-body">
                <form action="{{ route('monitorings.save') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                    <div class="col">
                        <label for="monitoringID" class="form-label">Monitorings<span class="text-danger">*</span></label>
                        <input type="text" id="monitoringID" name="monitoringID" class="form-control" value="{{ $monitoringID }}" required readonly>
                    </div>
                        <div class="col">
                            <label for="date" class="form-label">Date<span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" placeholder="Enter Date" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col">
                                <label for="researchID" class="form-label">Research ID<span class="text-danger">*</span></label>
                                <input type="text" id="researchID" name="researchID" class="form-control" value="{{ $researchId }}" readonly>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col">
                            <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                            <input type="text" name="status" class="form-control" placeholder="Status" required>
                        </div>
                        <div class="col">
                            <label for="progress" class="form-label">Progress<span class="text-danger">*</span></label>
                            <input type="text" name="progress" class="form-control" placeholder="Enter Progress" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="monitoringPersonnel" class="form-label">Monitoring Personnel<span class="text-danger">*</span></label>
                            <input type="text" name="monitoringPersonnel" class="form-control" placeholder="Enter Name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="remarks" class="form-label">Remarks<span class="text-danger">*</span></label>
                            <textarea name="remarks" class="form-control" placeholder="Remarks" rows="5"></textarea>
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

