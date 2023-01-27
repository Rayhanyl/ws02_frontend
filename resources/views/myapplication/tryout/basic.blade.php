<div class="basic-input">
    <form>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="username" aria-describedby="username">
          <div id="username" class="form-text">Insert username.</div>
        </div>
        <div class="mb-3">
            <label for="basic-password" class="form-label">Password</label>
            <div class="input-group mb-3">
                <span class="input-group-text toggleAccesstoken" type="button"><i class="bi bi-eye-fill"></i></span>
                <input type="password" class="form-control generatetestkey" placeholder="Password" id="basic-password"
                    aria-label="basic-password" aria-describedby="basic-password">
            </div>
        </div>
    </form>
</div>
<div class="gateway">
    <p class="fw-bold fs-5">Gateway</p>
    <hr>
    <div>
        <select class="form-select" aria-label="gateway" name="gateway">
            <option>-- API Gateways --</option>
            <option value="default" selected>Default</option>
        </select>
        <div id="gateway" class="form-text">
            Please select an environment            
        </div>
    </div>
</div>