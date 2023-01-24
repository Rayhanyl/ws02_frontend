<div class="pl-5">
    <div class="card">
        <div class="row p-3">
            <div class="col-12">
                <h5>Key Restrictions</h5>
                <hr>
            </div>
            <div class="col-6">
                <form action="#">
                    <div class="row g-3"> 
                        <div class="col-10">
                        <input type="text" class="form-control texthttp" id="addhttp" placeholder="Enter Http Referer">
                        </div>
                        <div class="col-2">
                        <button type="submit" class="btn btn-success mb-3 addhttp"><i class="bi bi-plus"></i></button>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mb-3">
                        <button class="btn btn-primary generate" type="button"
                        data-bs-toggle="modal" data-bs-target="#generateapikey" form="generateapikey">
                        GENERATE KEY
                        </button>
                    </div>
                    <div id="none" class="form-text">Use the Generate Key button to generate a self-contained JWT token.</div>
                </form>
            </div>
            <div class="col-6 shadow p-4 rounded">
                <h4>Examples of URLs allowed to restrict websites</h4>
                <p class="fw-light">A specific URL with an exact path: <b> www.example.com/path</b></p>
                <p class="fw-light">Any URL in a single subdomain, using a wildcard asterisk (*):</p>
                <p class="fw-bold">sub.example.com/*</p>
                <p class="fw-light">Any subdomain or path URLs in a single domain, using wildcard asterisks (*):</p>
                <p class="fw-bold">*.example.com/*</p>
            </div>
            <div class="col-12 mt-3">
                <hr>
                <div class="row p-3 boxhttp">
                </div>
            </div>
        </div>
    </div>
</div>
