@php
    use App\Models\Roles;
    use App\Models\Researcher;
    use App\Models\Research;

    $roles = Roles::all();
    $researcher = Researcher::all();
    $research = Research::all();

    use App\Models\RoleResearchAssigned;

    // Retrieve the latest record (including archived data) from the model
    $latest = RoleResearchAssigned::withTrashed()->orderBy('assignedID', 'desc')->first();

    if ($latest) {
        // Extract the numeric part of the identifier
        $numericPart = intval(substr($latest->assignedID, 2)) + 1;
    } else {
        $numericPart = 1;
    }

    $assignedID = "A-" . str_pad($numericPart, 3, '0', STR_PAD_LEFT);
@endphp

<div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="addResearcherModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewModalLabel">Add Researcher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="closeModal()" aria-label="Close">&times;</button>
            </div> 
            <div class="modal-body">
                <form action="{{ route('roleresearchassigned.save') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="assignedID" class="form-label">Assigned ID<span class="text-danger">*</span></label>
                            <input type="text" id="assignedID" name="assignedID" class="form-control" value="{{ $assignedID }}" required readonly>
                        </div>
                        </div>
                    <div>
                        <label for="researchID" class="form-label">Research<span class="text-danger">*</span></label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <select id="researchSelect" name="researchID" class="form-control" required>
                                    <option value="">Select Research</option>
                                    @foreach ($research as $researchItem)
                                        <option value="{{ $researchItem->id }}">{{ $researchItem->researchTitle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="researchID" class="form-label">Role<span class="text-danger">*</span></label>
                        <select id="roleSelect" name="roleID" class="form-control" required>
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->roleName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="researchID" class="form-label">Researcher<span class="text-danger">*</span></label>
                        <select id="researcherSelect" name="researcherID" class="form-control" required>
                            <option value="">Select Researcher</option>
                            @foreach ($researcher as $researcherItem)
                                <option value="{{ $researcherItem->id }}">{{ $researcherItem->researcherName }}</option>
                            @endforeach
                        </select>
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
        $('#addnew').modal('hide');
    }
</script>
