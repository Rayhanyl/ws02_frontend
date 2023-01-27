<!-- Modal -->
<div class="modal fade" id="changemodal" tabindex="-1" aria-labelledby="changemodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="changemodalLabel">Change Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route ('changepass') }}" method="POST" id="form-change-password">
                    @csrf
                    <div class="mb-3">
                        <label for="basic-password" class="form-label">Current Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text toggleChangepassword" type="button"><i
                                    class="bi bi-eye-fill"></i></span>
                            <input type="password" class="form-control" name="currentpassword" id="currentpassword"
                                aria-describedby="Current Password">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="basic-password" class="form-label">New Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text toggleNewpassword" type="button"><i
                                    class="bi bi-eye-fill"></i></span>
                            <input type="password" class="form-control" name="newpassword" id="newpassword"
                                aria-describedby="New Password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="form-change-password">Save changes</button>
            </div>
        </div>
    </div>
</div>