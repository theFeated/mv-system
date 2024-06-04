<!-- Modal HTML -->
<div id="archiveModal my-modal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>                      
                <h4 class="modal-title w-100">Archive Confirmation</h4>   
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to archive?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <!-- Button to close the modal -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <!-- Button to submit the form -->
                <button type="submit" onclick="submitForm()" class="btn btn-danger">Yes, Archive</button>
            </div>
        </div>
    </div>
</div>

