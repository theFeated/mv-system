@php
    $roles = App\Models\Roles::all();
    $researchers = App\Models\Researcher::all();
@endphp

<div class="modal fade my-modal" id="addnew" tabindex="-1" aria-labelledby="addResearcherModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewModalLabel">Add Researcher</h5>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">&times;</button>
            </div> 
            <div class="modal-body">
                <form action="{{ route('researchteam.save') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="researchID" class="col-sm-2 col-form-label">Research<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $researchId }}" readonly>
                            <input type="hidden" name="researchID" value="{{ $researchId }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="roleID" class="col-sm-2 col-form-label">Role<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select id="roleSelect" name="roleID" class="form-control" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->roleName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="researcherID" class="col-sm-2 col-form-label">Researcher<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select id="researcherSelect" name="researcherID" class="form-control" required>
                                <option value="">Select Researcher</option>
                                @foreach ($researchers as $researcher)
                                    <option value="{{ $researcher->id }}">{{ $researcher->researcherName }}</option>
                                @endforeach
                            </select>
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
</div>