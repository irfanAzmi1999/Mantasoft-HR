<div class="modal fade modal-danger text-start" id="modal-type" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" style="display: inline;">Staff <p style="display: inline;" id="staff_username" class="text-uppercase"></p> Leave Summary</h5>
                <button id="cancel" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group needs-validation">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="staff_name">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="staff_name" id="staff_name" value="NUR SYUHADA BINTI AHMAD NASIR" readonly>
                        </div>
                    </div>
                    <hr>
                    <div style="display: flex;">
                        <div style="flex: 1; margin-right: 15px;">
                            <h4 class="text-center mb-2"><b>Leave</b></h4>
                            <div class="row">
                                <div class="col-md-12 mb-1">
                                    <label for="default">Entitled</label>
                                    <input type="text" class="form-control" placeholder="Entitled" name="default" id="default" readonly>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label for="taken">Taken</label>
                                    <input type="text" class="form-control" placeholder="Taken" name="taken" id="taken" readonly>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label for="balance">Balance</label>
                                    <input type="text" class="form-control" placeholder="Balance" name="balance" id="balance" readonly>
                                </div>
                            </div>
                        </div>
                        <div style="border-left:1px solid lightgray; height:250px;"></div>
                        <div style="flex: 1; margin-left: 15px;">
                            <h4 class="text-center mb-2"><b>MC Leave</b></h4>
                            <div class="row">
                                <div class="col-md-12 mb-1">
                                    <label for="mc_default">Entitled</label>
                                    <input type="text" class="form-control" placeholder="MC Entitled" name="mc_default" id="mc_default" readonly>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label for="mc_taken">Taken</label>
                                    <input type="text" class="form-control" placeholder="MC Taken" name="mc_taken" id="mc_taken" readonly>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label for="mc_balance">Balance</label>
                                    <input type="text" class="form-control" placeholder="MC Balance" name="mc_balance" id="mc_balance" readonly>
                                </div>
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
<input type="hidden" id="quota_id" value="">