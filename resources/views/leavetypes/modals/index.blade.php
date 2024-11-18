<div class="modal fade modal-danger text-start" id="modal-type" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="myModalLabel120" style="display: none;"><strong>Register Leave Type</strong></h5>
				<h5 class="modal-title text-dark" id="edit_title" style="display: none;"><strong>Edit Leave Type</strong></h5>
                <h5 class="modal-title" id="delete_title" style="display: none;"><strong>Delete Leave Type?</strong></h5>
                <button type="reset" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group manage">
                    <div class="row">
                        <div class="col-md-9 mb-1">
                            <label for="leavetype_name" style="margin-bottom: 0.25em"><strong>Leave Type Name</strong></label>
                            <input type="text" id="leavetype_name" name="leavetype_name" class="form-control" placeholder="Leave Type Name" required autofocus oninput="this.value = this.value.toUpperCase()">
                            <strong id="nameError" class="col-form-label text-danger">Fill in the leave type name.</strong>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="limit" style="margin-bottom: 0.25em"><strong>Limit</strong></label>
                            <input type="number" id="limit" name="limit" class="form-control" placeholder="Limit" required autofocus>
                            <strong id="limitError" class="col-form-label text-danger" style="display: inline;">Fill in the limit.</strong>
                            <strong id="limitZero" class="col-form-label text-danger" style="display: inline;">Limit for the leave type cannot be below 0.</strong>
                        </div>
                    </div>
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
<input type="hidden" name="leavetype_id" id="leavetype_id" value="">