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
            <form action="{{ route('roleresearchassigned.update', ['assignedID' => $item->assignedID, 'researchID' => $item->researchID]) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">						
                    <h4 class="modal-title">Edit Researcher</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">					
                    <div class="form-group">
                        <label>Assigned ID</label>
                        <input type="text" class="form-control" name="assignedID" value="{{ $item->assignedID }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Research ID</label>
                        <input type="text" class="form-control" name="researchID" value="{{ $item->researchID }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="roleID" class="form-control" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == $item->roleID ? 'selected' : '' }}>{{ $role->roleName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Researcher</label>
                        <select name="researcherID" class="form-control" required>
                            @foreach ($researchers as $researcher)
                                <option value="{{ $researcher->id }}" {{ $researcher->id == $item->researcherID ? 'selected' : '' }}>{{ $researcher->researcherName }}</option>
                            @endforeach
                        </select>
                    </div>					
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
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
