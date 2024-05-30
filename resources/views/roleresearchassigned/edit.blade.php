@php
    use App\Models\Roles;
    use App\Models\Researcher;
    use App\Models\Research;
    use App\Models\RoleResearchAssigned;

    $roles = Roles::all();
    $researchers = Researcher::all();
    $research = Research::all();

    $roleresearchassigned = RoleResearchAssigned::all();
@endphp

@foreach ($roleresearchassigned as $item)
<div class="modal fade my-modal" id="edit{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('roleresearchassigned.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Researcher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">ID</label>
                        <input type="text" name="id" class="form-control" placeholder="ID"  value="{{ $item->id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="researchID">Research ID</label>
                        <input type="text" class="form-control" id="researchID" name="researchID" value="{{ $item->researchID }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="roleID">Role</label>
                        <select id="roleID" name="roleID" class="form-control" required>
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $role->id == $item->roleID ? 'selected' : '' }}>{{ $role->roleName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="researcherID">Researcher</label>
                        <select id="researcherID" name="researcherID" class="form-control" required>
                            <option value="">Select Researcher</option>
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