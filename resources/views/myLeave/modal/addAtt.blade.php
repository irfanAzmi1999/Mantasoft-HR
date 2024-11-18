<div class="modal fade modal-danger text-start" id="modal-addAttachment" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="myModalLabel120">New Attachment Data</h5>
                <button id="cancel" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="col-12 mt-0 mb-3">
                        <label for="attachments" class="mb-1">Attachment(s)</label>
                        <input type="file" id="attachments" class="form-control btn-primary mb-75 me-75" name="attachments[]" multiple>
                    </div>
                </div>
                <div class="form-group delete" style="display: none">
                    <p style="display: inline">Do you want to delete "<p style="display: inline" id="name"></p>" from the list?</p>
                </div>
            <div class=" col-12 col-sm-6 mb-1 mb-sm-0">
                <label class="form-label">Leave Type</label>
                <input type="text" class="form-control" placeholder="Leave Type" id="idLeave_Details" readonly>
            </div>
            </div>
            <div class="modal-footer">
                <button id="cancel" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button id="post_att" class="btn btn-primary">Add Attachment</button>
            </div>
        </div>
</div>
<input type="hidden" id="idLeave_Details" value="">
