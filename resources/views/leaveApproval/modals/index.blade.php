<div class="modal fade modal-danger text-start" id="modal-type" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
	<div class="modal-lg modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-dark">Update Leave Data</h5>
				<button id="cancel" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group needs-validation">
					<div class="row">
						<div class="col-md-12 mb-1">
							<label for="staff_name">Staff Name</label>
							<input type="text" class="form-control" placeholder="Staff Name" name="staff_name" id="staff_name" readonly>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 mb-1">
							<label for="leavetype_id">Leave Type</label>
							<input type="text" class="form-control" placeholder="Leave Type" name="leavetype_id" id="leavetype_id" required readonly>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-1">
							<label for="start_date">Leave Start</label>
							<input type="text" class="form-control" placeholder="d/m/Y" name="start_date" id="start_date" required readonly>
						</div>
						<div class="col-md-6 mb-1">
							<label for="end_date">Leave End</label>
							<input type="text" class="form-control" placeholder="d/m/Y" name="end_date" id="end_date" required readonly>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 mb-1">
							<label for="staff_remarks">Staff Remark(s)</label>
							<textarea data-length="150" maxlength="150" class="form-control char-textarea text-uppercase" rows="2" name="staff_remarks" id="staff_remarks" placeholder="Staff Remarks" required readonly></textarea>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12 mb-1">
							<h4><b>Attachment(s)</b></h4>
							<table class="table table-attachment">
								<thead>
									<tr>
										<th>No.</th>
										<th>File Name</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12 mb-1">
							<label for="approver_remarks">Approver Remark(s)</label>
							<textarea data-length="150" maxlength="150" class="form-control char-textarea" rows="2" name="approver_remarks" id="approver_remarks" placeholder="Approver Remarks" required></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 mb-1">
							<label for="status_id">Status</label>
							<select class="form-control form-select select2" name="status_id" id="status_id" required>
								<option value="" disabled="disabled" selected="selected">Select leave status...</option>
								@foreach ($status as $s)
									@role('admin|director')
                                        @if(str_contains($s->name, 'HR'))
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @elseif(str_contains($s->name, 'PENDING'))
                                            <option value="{{ $s->id }}" disabled>{{ $s->name }}</option>
                                        @endif
                                    @endrole
                                    @role('hod')
                                        @if(str_contains($s->name, 'HOD'))
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @elseif(str_contains($s->name, 'PENDING'))
                                            <option value="{{ $s->id }}" disabled>{{ $s->name }}</option>
                                        @endif
                                    @endrole
								@endforeach
								
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="cancel" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
				<button type="button" id="post_update" class="btn btn-warning">Update</button>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="leave_id" value="">