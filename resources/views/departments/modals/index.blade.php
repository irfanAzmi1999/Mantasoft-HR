<div class="modal fade modal-danger text-start" id="modal-type" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="myModalLabel120" style="display: none;"><strong>Register Department</strong></h5>
				<h5 class="modal-title text-dark" id="edit_title" style="display: none;"><strong>Edit Department</strong></h5>
                <h5 class="modal-title" id="delete_title" style="display: none;"><strong>Delete Department?</strong></h5>
                <button type="reset" id="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group manage">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="fullname" style="margin-bottom: 0.25em"><strong>Department Full Name</strong></label>
                            <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Department Full Name" required autofocus oninput="this.value = this.value.toUpperCase()">
                            <strong id="fullNameError" class="col-form-label text-danger">Fill in the department full name.</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label for="department_name" style="margin-bottom: 0.25em"><strong>Department Name</strong></label>
                            <input type="text" id="department_name" name="department_name" class="form-control" placeholder="Department Name" required autofocus oninput="this.value = this.value.toUpperCase()">
                            <strong id="nameError" class="col-form-label text-danger">Fill in the department name.</strong>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="order_number" style="margin-bottom: 0.25em"><strong>Order Number</strong></label>
                            <input type="number" id="order_number" name="order_number" class="form-control" placeholder="Order Number" required autofocus>
                            <strong id="orderError" class="col-form-label text-danger" style="display: inline;">Fill in the order number.</strong>
                            <strong id="orderZero" class="col-form-label text-danger" style="display: inline;">Order number cannot be below or equal to 0.</strong>
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
<input type="hidden" name="department_id" id="department_id" value="">