<div class="modal fade modal-danger text-start" id="modal-type" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
	<div class="modal-lg modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-dark" id="myModalLabel120" style="display: none;"><strong>Register Staff</strong></h5>
				<h5 class="modal-title" id="delete_title" style="display: none;"><strong>Delete Staff?</strong></h5>
				<button type="reset" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group manage">
					<div class="row">
						<div class="col-md-12 mb-1">
							<label for="name" style="margin-bottom: 0.25em"><strong>Full Name</strong></label>
							<input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required autofocus oninput="this.value = this.value.toUpperCase()">
							<strong id="nameError" class="col-form-label text-danger">Fill in the full name.</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-1">
							<label for="department_id" style="margin-bottom: 0.25em"><strong>Department</strong></label>
							<input type="text" class="form-control" value="{{ $hod->getDepartment->name }}" placeholder="Department" readonly>
							<input type="hidden" id="department_id" name="department_id" class="form-control" value="{{ $hod->getDepartment->id }}" required autofocus>
						</div>
						<div class="col-md-6 mb-1">
							<label for="role_id" style="margin-bottom: 0.25em"><strong>Role</strong></label>
							<select class="form-control form-select select2" id="role_id" name="role_id" required autofocus>
								<option value="" disabled="disabled" selected="selected">Select role...</option>
								@foreach ($role as $r)
									@if(str_contains($r, 'INTERN') || str_contains($r, 'STAFF'))
										<option value="{{ $r->id }}">{{ $r->display_name }}</option>
									@endif
								@endforeach   
							</select>
							<strong id="roleError" class="col-form-label text-danger">Select a role.</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-1">
							<label for="superior_id" style="margin-bottom: 0.25em"><strong>Superior</strong></label>
							<input type="text" class="form-control" value="{{ $hod->getUser->name }}" placeholder="Superior" readonly>
							<input type="hidden" id="superior_id" name="superior_id" class="form-control" value="{{ $hod->getUser->id }}" required autofocus>
						</div>
						<div class="col-md-6 mb-1">
							<label for="username" style="margin-bottom: 0.25em"><strong>Username</strong></label>
							<input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus maxlength="15">
							<small class="textarea-counter-value float-end">max. username length <span class="char-count">0</span>/15</small>
							<strong id="usernameError" class="col-form-label text-danger" style="display: inline;">Fill in the username.</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-1">
							<label for="password" style="margin-bottom: 0.25em"><strong>Password</strong></label>
							<input type="password" id="password" name="password" class="form-control" placeholder="Password" required autofocus>
							<strong id="passwordError" class="col-form-label text-danger">Fill in the password.</strong>
						</div>
						<div class="col-md-6 mb-1">
							<label for="password-confirm" style="margin-bottom: 0.25em"><strong>Retype Password</strong></label>
							<input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Retype Password" required autofocus>
							<strong id="confPassError" class="col-form-label text-danger" style="display: inline;">Retype the password confirmation.</strong>
							<strong id="confPassFail" class="col-form-label text-danger" style="display: inline;">Password confirmation does not match.</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-1">
							<label for="email" style="margin-bottom: 0.25em"><strong>Email</strong></label>
							<input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
							<strong id="emailError" class="col-form-label text-danger">Fill in the email.</strong>
						</div>
						<div class="col-md-6 mb-1">
							<label for="phone" style="margin-bottom: 0.25em"><strong>Phone Number</strong></label>
							<input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone number" required autofocus>
							<strong id="phoneError" class="col-form-label text-danger">Fill in the phone number.</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-1">
							<label for="employ_date" style="margin-bottom: 0.25em"><strong>Employment Date</strong></label>
							<input type="text" id="employ_date" name="employ_date" class="bg-white form-control flatpickr-basic" placeholder="Employment Date (D-M-Y)" required autofocus>
							<strong id="employDateError" class="col-form-label text-danger">Fill in the employment date.</strong>
						</div>
						<div class="col-md-6 mb-1">
							<label for="company_id" style="margin-bottom: 0.25em"><strong>Company</strong></label>
							<select class="form-control form-select select2" id="company_id" name="company_id" required autofocus>
								<option value="" disabled="disabled" selected="selected">Select company...</option>
								@foreach ($company as $c)
									<option value="{{ $c->id }}">{{ $c->name }}</option>
								@endforeach
							</select>
							<strong id="companyError" class="col-form-label text-danger">Select a company.</strong>
						</div>
					</div>
				</div>
				<div class="form-group delete" style="display: none;">
					<p style="display: inline;">Do you want to delete "<p style="display: inline;" id="name"></p>" from the list?</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="reset" id="cancel" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
				<button type="submit" id="post_add" class="btn btn-success">Register</button>
				<button type="submit" id="post_softdelete" class="btn btn-danger">Delete</button>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="user_id" id="user_id" value="">