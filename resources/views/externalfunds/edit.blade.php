@php

    use App\Models\Agency;

    $agencies = Agency::all();

@endphp

@foreach ($externalfunds as $item)
<div class="modal fade my-modal" id="edit{{ $item->exFundID }}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('externalfunds.update', ['exFundID' => $item->exFundID]) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">						
                    <h4 class="modal-title">Edit External Fund</h4>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">					
                    <div class="form-group">
                        <label>External Fund ID</label>
                        <input type="text" class="form-control" name="exFundID" value="{{ $item->exFundID }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Research ID</label>
                        <input type="text" class="form-control" name="researchID" value="{{ $item->researchID }}">
                    </div>
                    <div class="form-group">
                        <label>Agency</label>
                        <select name="agencyID" class="form-control" required>
                            @foreach ($agencies as $agency)
                                <option value="{{ $agency->agencyID }}" {{ $agency->agencyID == $item->agencyID ? 'selected' : '' }}>{{ $agency->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contribution</label>
                        <input type="text" class="form-control" name="contribution" value="{{ $item->contribution }}">
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