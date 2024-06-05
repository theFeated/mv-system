@php
    use App\Models\Monitorings;

    $monitorings = Monitorings::all();
@endphp

@foreach ($monitorings as $item)
<div class="modal fade my-modal" id="editMonitoring{{ $item->id }}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('monitorings.update', $item->id) }}" method="POST">                
                @csrf
                @method('PUT')
                <div class="modal-header">						
                    <h4 class="modal-title">Edit Monitoring</h4>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">					
                    <div class="form-group">
                        <label>Monitoring ID</label>
                        <input type="text" class="form-control" name="id" value="{{ $item->id }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Research ID</label>
                        <input type="text" class="form-control" name="researchID" value="{{ $item->researchID }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" name="status" value="{{ $item->status }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Progress</label>
                        <input type="number" class="form-control" name="progress" value="{{ $item->progress }}" required>
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea class="form-control" name="remarks" required>{{ $item->remarks }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Monitoring Personnel</label>
                        <input type="text" class="form-control" name="monitoringPersonnel" value="{{ $item->monitoringPersonnel }}" required>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" value="{{ $item->date }}" required>
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
