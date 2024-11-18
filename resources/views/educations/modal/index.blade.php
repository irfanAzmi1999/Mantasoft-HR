<div class="modal fade modal-danger text-start" id="modal-type" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div id="modal-education">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="myModalLabel120" style="display: none;"><strong>Register Education</strong></h5>
				<h5 class="modal-title text-dark" id="edit_title" style="display: none;"><strong>Edit Education</strong></h5>
                <h5 class="modal-title" id="delete_title" style="display: none;"><strong>Delete Education?</strong></h5>
                <button type="reset" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group manage">
                    <input type="hidden" id="profile_id" name="profile_id" class="form-control" value="{{ $profile_id }}" required autofocus>
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="school_name" style="margin-bottom: 0.25em"><strong>College/University Name</strong></label>
                            <input type="text" id="school_name" name="school_name" class="form-control" placeholder="College/University Name" required autofocus oninput="this.value = this.value.toUpperCase()">
                            <strong id="nameError" class="col-form-label text-danger">Fill in the college/university name.</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                            <label for="year_from" style="margin-bottom: 0.25em"><strong>Intake Year</strong></label>
                            <select class="form-control form-select select2 year_from" id="year_from" name="year_from" required autofocus>
                                <option value="" disabled="disabled" selected="selected">Select intake year...</option>
                                @for($i = 0; $i < 50; $i++)
                                    <option value="{{ $currentYear - $i }}">{{ $currentYear - $i }}</option>
                                @endfor
                            </select>
                            <strong id="yearFromError" class="col-form-label text-danger">Select the intake year.</strong>
                        </div>
                        <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                            <label for="year_to" style="margin-bottom: 0.25em"><strong>Graduation Year</strong></label>
                            <select class="form-control form-select select2 year_to" id="year_to" name="year_to" required autofocus>
                                <option value="" disabled="disabled" selected="selected">Select graduation year...</option>
                                @for($i = 0; $i < 50; $i++)
                                    <option value="{{ $currentYear - $i }}">{{ $currentYear - $i }}</option>
                                @endfor
                            </select>
                            <strong id="yearToError" class="col-form-label text-danger">Select the graduation year.</strong>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                            <label for="achievement" style="margin-bottom: 0.25em"><strong>Certificate</strong></label>
                            <input type="text" id="achievement" name="achievement" class="form-control" placeholder="Certificate" required autofocus oninput="this.value = this.value.toUpperCase()">
                            <strong id="achievementError" class="col-form-label text-danger">Fill in the certificate.</strong>
                        </div>
                        <div class="col-sm-6 col-12 mb-1 mb-sm-0">
                            <label for="result" style="margin-bottom: 0.25em"><strong>Result</strong></label>
                            <input type="text" id="result" name="result" class="form-control" placeholder="Result" required autofocus oninput="this.value = this.value.toUpperCase()">
                            <strong id="resultError" class="col-form-label text-danger">Fill in the result.</strong>
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
<input type="hidden" name="education_id" id="education_id" value="">
<input type="hidden" id="currentYear" value="{{ $currentYear }}">