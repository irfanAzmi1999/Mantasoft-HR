<div class="modal fade modal-danger text-start" id="modal-type" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" style="display: inline;">Staff <p style="display: inline;" id="staff_username" class="text-uppercase"></p> Leave Details</h5>
                <button id="cancel" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group needs-validation">
                    <div class="row">
                        <div class="col-md-9 mb-1">
                            <label for="staff_name">Staff Name</label>
                            <input type="text" class="form-control" placeholder="Staff Name" name="staff_name" id="staff_name" readonly>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="department">Department</label>
                            <input type="text" class="form-control" placeholder="Department" name="department" id="department" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <h4><b>Leave History</b></h4>
                            <div class="table-responsive">
                                <table class="table table-leavedetails">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Type</th>
                                            <th>Half/Full Day</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Day(s) Taken</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancel" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="staff_id" value="">