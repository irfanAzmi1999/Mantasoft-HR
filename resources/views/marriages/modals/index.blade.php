<div class="modal fade modal-danger text-start" id="modal-type" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="myModalLabel120" style="display: none;"><strong>Register Marriage</strong></h5>
				<h5 class="modal-title text-dark" id="edit_title" style="display: none;"><strong>Edit Marriage</strong></h5>
                <h5 class="modal-title" id="delete_title" style="display: none;"><strong>Delete Marriage?</strong></h5>
                <button type="reset" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group manage">
                    <input type="hidden" id="profile_id" name="profile_id" class="form-control" value="{{ $profile_id }}" required autofocus>
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="marital_id" style="margin-bottom: 0.25em"><strong>Marital Status</strong></label>
                            <select class="form-control form-select select2" id="marital_id" name="marital_id" required autofocus onchange="check()">
                                <option value="" disabled="disabled" selected="selected">Select marital status...</option>
                                @foreach ($marital as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                @endforeach
                            </select>
                            <strong id="statusError" class="col-form-label text-danger">Select a marital status.</strong>
                        </div>
                        <div id="berkahwin" style="display: none;">
                            <div class="col-md-12 mb-1">
                                <label for="marriage_date" style="margin-bottom: 0.25em"><strong>Marriage Date</strong></label>
                                <input type="text" id="marriage_date" name="marriage_date" class="bg-white form-control flatpickr-basic" placeholder="Marriage Date (D-M-Y)" required autofocus>
                                <strong id="dateError" class="col-form-label text-danger">Fill in the marriage date.</strong>
                            </div>
                            <div class="col-md-12 mb-1">
                                <label for="spouse_name" style="margin-bottom: 0.25em"><strong>Spouse Full Name</strong></label>
                                <input type="text" id="spouse_name" name="spouse_name" class="form-control" placeholder="Spouse Full Name" required autofocus oninput="this.value = this.value.toUpperCase()">
                                <strong id="nameError" class="col-form-label text-danger">Fill in the spouse full name.</strong>
                            </div>
                            <div class="col-md-12 mb-1">
                                <label for="spouse_job" style="margin-bottom: 0.25em"><strong>Occupation</strong></label>
                                <input type="text" id="spouse_job" name="spouse_job" class="form-control" placeholder="Occupation" required autofocus oninput="this.value = this.value.toUpperCase()">
                                <strong id="jobError" class="col-form-label text-danger">Fill in the occupation.</strong>
                            </div>
                            <div class="col-md-12 mb-1">
                                <label for="spouse_company" style="margin-bottom: 0.25em"><strong>Work company</strong></label>
                                <input type="text" id="spouse_company" name="spouse_company" class="form-control" placeholder="Work company" required autofocus oninput="this.value = this.value.toUpperCase()">
                                <strong id="companyError" class="col-form-label text-danger">Fill in the work company.</strong>
                            </div>
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
<input type="hidden" name="marriage_id" id="marriage_id" value="">