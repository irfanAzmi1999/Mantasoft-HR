<div class="modal fade modal-danger text-start" id="modal-type" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="myModalLabel120" style="display: none;"><strong>Register Blood Type</strong></h5>
				<h5 class="modal-title text-dark" id="edit_title" style="display: none;"><strong>Edit Blood Type</strong></h5>
                <h5 class="modal-title" id="delete_title" style="display: none;"><strong>Delete Blood Type?</strong></h5>
                <button type="reset" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group manage">
                    <label for="bloodType" style="margin-bottom: 0.25em"><strong>Blood Type</strong></label>
                    <input type="text" id="bloodType" name="bloodType" class="form-control" placeholder="Blood Type" required autofocus oninput="this.value = this.value.toUpperCase()">
                    <strong id="nameError" class="col-form-label text-danger">Fill in the blood type.</strong>
                </div>
                <div class="form-group delete" style="display: none;">
                    <p style="display: inline;">Do you want to delete "<p style="display: inline;" id="name"></p>" from the list?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" id="cancel" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" id="post_add" class="btn btn-success">Submit</button>
                <button type="submit" id="post_update" class="btn btn-warning">Update</button>
                <button type="submit" id="post_softdelete" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="idUpdate_bloods" id="idUpdate_bloods" value="">