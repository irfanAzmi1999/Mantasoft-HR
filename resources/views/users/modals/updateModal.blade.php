<div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="updateModal">Simple Update User</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                    <input type="text" class="user_names form-control dt-full-name" id="" placeholder="John Doe" name="user-fullname" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-uname">Username</label>
                    <input type="text" id="" class="user_usernames form-control dt-uname" placeholder="Web Developer" name="user-name" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-email">Email</label>
                    <input type="text" id="" class="user_emails form-control dt-email" placeholder="john.doe@example.com" name="user-email" />
                </div>
                <div class="mb-1">
                    <label class="form-label" for="basic-icon-default-contact">Phone</label>
                    <input type="text" id="user_phone" class="form-control dt-contact" placeholder="+1 (609) 933-44-22" name="user-contact" />
                </div>
                <button id="for_updateUser" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
<input type="hidden" id="modalprofile_id" value="">