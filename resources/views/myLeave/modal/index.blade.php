<div class="modal fade modal-danger text-start" id="modal-type" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="edit_titel">Edit Your Leave Data</h5>
                <h5 class="modal-title" id="delete_title" style="display: none;">Delete leave Data?</h5>
                <h5 class="modal-title" id="delete_att" style="display: none;">Do you want to delete your attachment?</h5>
                <h5 class="modal-title text-dark" id="att_title" style="display: none;">add your attachment</h5>
                <button id="cancel" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="manage">
                <div class="row">
                    <div class=" col-12 col-sm-6 mb-1 mb-sm-0">
                        <label class="form-label">Leave Type</label>
                        <input type="text" class="form-control" placeholder="Leave Type" id="leavetype_id" readonly>
                    </div>
                    <div class=" col-12 col-sm-6 mb-1 mb-sm-0">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" placeholder="Status name" id="status_id" readonly>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-5 col-12 mb-1 mb-sm-0">
                        <label class="form-label" for="start_date">Start Leave</label>
                        {{-- <div class="col-sm-5 col-12 mb-1 mb-sm-0">
                            <label class="form-label" for="fp-default">Leave Start Date</label>
                            <input type="text" name="start_date" id="fp-default" class="bg-white form-control flatpickr-basic" placeholder="Day-Month-Year"/>
                        </div> --}}
                        <input type="text" name="start_date" id="start_date" class="bg-white form-control flatpickr-basic"  placeholder="Day-Month-Year"/>
                    </div>
                    <div class="col-sm-5 col-12 mb-1 mb-sm-0">
                        <label class="form-label bg-white" for="end_date">End Leave </label>
                        <input type="text" name="end_date" id="end_date" class="bg-white form-control flatpickr-basic" placeholder="Day-Month-Year"/>
                    </div>
                    <div class="col-sm-2 col-12 mb-1 mb-sm-0">
                        <label for="">Total</label>
                        <input type="text" class="form-control" placeholder="Total Leave in Days" name="" id="validationTooltip02" readonly>
                    </div>
                </div>
                <div class="row custom-options-checkable g-1 mt-2">
                    <label for="">Did your leave full or half day</label>
                    <div class="col-12 mt-1">
                        <input class="custom-option-item-check half_day" type="radio" name="half_day" id="customOptionsCheckableRadios1" value="0"/>
                        <label class="custom-option-item p-1" for="customOptionsCheckableRadios1">
                            <span class="d-flex justify-content-between flex-wrap mb-50">
                                <span class="fw-bolder">Full Day</span>
                                <span class="fw-bolder"><i data-feather='sun'></i></span>
                                {{-- <span class="fw-bolder">Dipotong setengah gaji --}}
                            </span>
                            <small class="d-block">Staff will be taking a full working day leave.</small>
                        </label>
                    </div>
                    <div class="col-sm-6 col-12 mt-1">
                        <input class="custom-option-item-check half_day" type="radio" name="half_day" id="customOptionsCheckableRadios2" value="1" />
                        <label class="custom-option-item p-1" for="customOptionsCheckableRadios2">
                            <span class="d-flex justify-content-between flex-wrap mb-50">
                                <span class="fw-bolder">Half Day Morning</span>
                                <span class="fw-bolder"><i data-feather='sunrise'></i></span>
                            </span>
                            <small class="d-block">Staff will be out of work from 9:00 a.m. until 2:00 p.m.</small>
                        </label>
                    </div>
                    <div class="col-sm-6 col-12 mt-1">
                        <input class="custom-option-item-check half_day" type="radio" name="half_day" id="customOptionsCheckableRadios3" value="2" />
                        <label class="custom-option-item p-1" for="customOptionsCheckableRadios3">
                            <span class="d-flex justify-content-between flex-wrap mb-50">
                                <span class="fw-bolder">Half Day Evening</span>
                                <span class="fw-bolder"><i data-feather='sunset'></i></span>
                            </span>
                            <small class="d-block">Staff will be out of work from 12:00 p.m. until 6:00 p.m.</small>
                        </label>
                    </div>
                </div>
                <div class="col-12 mt-2 mb-3">
                    <div class="mb-0 ">
                        <label >Reason</label>
                        <textarea data-length="100" maxlength="100" 
                        class="form-control char-textarea mt-1" rows="3" id="staff_remarks" name="staff_remarks" placeholder="Reasons why you leave that day" required></textarea></textarea>
                    </div>
                    <small class="textarea-counter-value float-end">max reasons length<span class="char-count">0</span> / 100 </small>
                </div>
            </br>
                <hr>
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2><b>Your Attachment </b>Data</h2>
                        </div>
                        <div class="col-sm-4">
                            <button id="newAttachment" class="btn btn-info add-new float-end" style="text-decoration: none; color: white;">
                                <i class="fa-regular fa-plus"></i>&nbsp;&nbsp;&nbsp;New data
                            </button>
                        </div>
                    </div>
                </div><hr>
                <table class="table-attachment table">
                    <thead>
                        <tr>
                            <th id="idAttachment">No.</th>
                            <th>File Name</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
            {{-- for delete  --}}
                <div class="form-group delete" style="display: none">
                    <p style="display: inline">Do you want to delete your "<p style="display: inline" id="leavetype_ids"></p>" from "<p style="display: inline" id="start_dates"></p>" to "<p style="display: inline" id="end_dates"></p>" from the table ?</p>
                </div>
            
                <div class="form-group deleteAtt" style="display: none">
                    <p style="display: inline">Do you want to delete your attachment withe file name <p style="display: inline" id="nameAtt"></p>&nbsp; ? </p>
                </div>

                <div class="col-12 mt-0 mb-3 attachment" style="display: none">
                    <label for="attachments" class="mb-1">Attachment(s)</label>
                    <input type="file" id="attachments" class="form-control btn-primary mb-75 me-75" name="attachments[]" multiple>
                    {{-- <input type="text" class="form-control" placeholder="Status name" id="idLeave_Details" readonly> --}}
                </div>
            </div>


            <div class="modal-footer">
                <button id="cancel" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button id="post_update" class="btn btn-warning">Update</button>
                <button id="post_softdelete" class="btn btn-danger">Delete</button>
                <button id="post_softdeleteAtt" class="btn btn-danger">Delete attachment</button>
                <button id="post_att" class="btn btn-primary" style="display: none">Add Attachment</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="idLeave_Details" value="">
{{-- @include('myLeave.modal.addAtt') --}}
{{-- <input type="hidden" id="idAttachment" value=""> --}}
