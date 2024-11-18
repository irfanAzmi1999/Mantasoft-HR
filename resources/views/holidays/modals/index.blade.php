<div class="modal fade modal-danger text-start" id="modal-type" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="myModalLabel120" style="display: none;"><strong>Register Holiday</strong></h5>
				<h5 class="modal-title text-dark" id="edit_title" style="display: none;"><strong>Edit Holiday</strong></h5>
                <h5 class="modal-title" id="delete_title" style="display: none;"><strong>Delete Holiday?</strong></h5>
                <button type="reset" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group manage">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="holiday_name" style="margin-bottom: 0.25em"><strong>Holiday Name</strong></label>
                            <input type="text" id="holiday_name" name="holiday_name" class="form-control" placeholder="Holiday Name" required autofocus oninput="this.value = this.value.toUpperCase()">
                            <strong id="nameError" class="col-form-label text-danger">Fill in the holiday name.</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                            <label for="start_date" style="margin-bottom: 0.25em"><strong>Start Date</strong></label>
                            <input type="text" id="start_date" name="start_date" class="bg-white form-control flatpickr-basic" placeholder="Start Date (D-M-Y)" required autofocus {{-- onchange="parse()" --}}>
                            <strong id="startError" class="col-form-label text-danger">Fill in the start date.</strong>
                        </div>
                        <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                            <label for="end_date" style="margin-bottom: 0.25em"><strong>End Date</strong></label>
                            <input type="text" id="end_date" name="end_date" class="bg-white form-control flatpickr-basic" placeholder="End Date (D-M-Y)" required autofocus {{-- onchange="parse()" --}}>
                            <strong id="endError" class="col-form-label text-danger">Fill in the end date.</strong>
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
<input type="hidden" name="holiday_id" id="holiday_id" value="">