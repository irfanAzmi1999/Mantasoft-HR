<div class="modal fade modal-danger text-start" id="modal-type" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" style="display: inline;">Staff <p style="display: inline;" id="staff_username" class="text-uppercase"></p> Unpaid Leave</h5>
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
                            <label for="year">Year</label>
                            <input type="text" class="form-control" value="{{ $currentYear }}" readonly>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <h4 class="mb-1"><b>Unpaid Leave Details</b></h4>
                            <div class="table-responsive">
                                <table class="table table-unpaid">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Month</th>
                                            <th>Total Unpaid</th>
                                        </tr>
                                    </thead>
                                    <tbody class="unpaid-row">
                                    </tbody>
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