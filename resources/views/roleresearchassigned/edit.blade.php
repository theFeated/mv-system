@php
    use App\Models\Roles;
    use App\Models\Researcher;
    use App\Models\Research;

    $roles = Roles::all();
    $researchers = Researcher::all();
    $research = Research::all();

    use App\Models\RoleResearchAssigned;

    $roleresearchassigned = RoleResearchAssigned::all();

@endphp

@foreach ($roleresearchassigned as $item)
<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Researcher</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="closeModal('update{{ $item->id }}')"></button>
            </div>
            <div class="modal-body">
            <form action="{{ route('roleresearchassigned.update', ['assignedID' => $item->assignedID, 'researchID' => $item->researchID]) }}" method="POST">
            @csrf
            @method('PATCH')
                    <div class="mb-3">
                        <label for="assignedID" class="form-label">Assigned ID</label>
                        <input type="text" name="assignedID" class="form-control" value="{{ $item->assignedID }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="researchID" class="form-label">Research ID</label>
                        <input type="text" name="researchID" class="form-control" value="{{ $item->researchID }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="roleID" class="form-label">Role</label>
                        <select name="roleID" class="form-control" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == $item->roleID ? 'selected' : '' }}>{{ $role->roleName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="researcherID" class="form-label">Researcher</label>
                        <select name="researcherID" class="form-control" required>
                            @foreach ($researchers as $researcher)
                                <option value="{{ $researcher->id }}" {{ $researcher->id == $item->researcherID ? 'selected' : '' }}>{{ $researcher->researcherName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('edit{{ $item->id }}')">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        var bsModal = bootstrap.Modal.getInstance(modal);
        bsModal.hide();
    }
</script>
