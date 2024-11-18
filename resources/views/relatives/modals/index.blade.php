<div class="modal fade modal-danger text-start" id="modal-type" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div id="modal-relative">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="myModalLabel120" style="display: none;"><strong>Register Relative</strong></h5>
				<h5 class="modal-title text-dark" id="edit_title" style="display: none;"><strong>Edit Relative</strong></h5>
                <h5 class="modal-title" id="delete_title" style="display: none;"><strong>Delete Relative?</strong></h5>
                <button type="reset" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group manage">
                    <input type="hidden" id="profile_id" name="profile_id" class="form-control" value="{{ $profile_id }}" required autofocus>
                    <div class="row">
                        <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                            <label for="relatives_name" style="margin-bottom: 0.25em"><strong>Relative Full Name</strong></label>
                            <input type="text" id="relatives_name" name="relatives_name" class="form-control" placeholder="Relative Full Name" required autofocus oninput="this.value = this.value.toUpperCase()">
                            <strong id="nameError" class="col-form-label text-danger">Fill in the relative full name.</strong>
                        </div>
                        <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                            <label for="relatives_phone" style="margin-bottom: 0.25em"><strong>Phone Number</strong></label>
                            <input type="tel" id="relatives_phone" name="relatives_phone" class="form-control" placeholder="Phone Number" required autofocus>
                            <strong id="phoneError" class="col-form-label text-danger">Fill in the phone number.</strong>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                            <label for="relatives_email" style="margin-bottom: 0.25em"><strong>Email</strong></label>
                            <input type="email" id="relatives_email" name="relatives_email" class="form-control" placeholder="Email" required autofocus>
							<strong id="emailError" class="col-form-label text-danger">Fill in the email.</strong>
                        </div>
                        <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                            <label for="relatives_job" style="margin-bottom: 0.25em"><strong>Occupation</strong></label>
                            <input type="text" id="relatives_job" name="relatives_job" class="form-control" placeholder="Occupation" required autofocus oninput="this.value = this.value.toUpperCase()">
                            <strong id="jobError" class="col-form-label text-danger">Fill in the occupation.</strong>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                            <label for="relation_id" style="margin-bottom: 0.25em"><strong>Relation</strong></label>
                            <select class="form-control form-select select2" id="relation_id" name="relation_id" required autofocus>
                                <option value="" disabled="disabled" selected="selected">Select relation...</option>
                                @foreach($read as $r)
                                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                            <strong id="relationError" class="col-form-label text-danger">Select a relation.</strong>
                        </div>
                        <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                            <label for="is_emergency" style="margin-bottom: 0.25em"><strong>Emergency Contact</strong></label>
                            <select class="form-control form-select select2" id="is_emergency" name="is_emergency" required autofocus>
                                <option value="" disabled="disabled" selected="selected">Select preference...</option>
                                <option value="YES">YES</option>
                                <option value="NO">NO</option>
                            </select>
                            <strong id="emergencyError" class="col-form-label text-danger">Select a emergency contact preference.</strong>
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
<input type="hidden" name="relatives_id" id="relatives_id" value="">