<div class="row">
    <div class="col-7 p-3">
        <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Access Token</label>
                <div class="input-group mb-3">
                    <span class="input-group-text toggleAccesstoken" type="button"><i class="bi bi-eye-fill"></i></span>
                    <input type="password" class="form-control generatetestkey" placeholder="Authorization Bearer" id="accesstoken-oauth"
                        aria-label="authorizationbearer" aria-describedby="authorizationbearer">
                </div>
                <div id="authorizationbearer" class="form-text">Enter access Token.</div>
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary btn-generate-test-key" type="submit" form="form-oauth-generate-test-key">
                Generate Test Key
            </button>
        </div>
    </div>
    <div class="col-5">
        <form action="{{ route ('generatetestkeyoauth') }}" method="POST" id="form-oauth-generate-test-key">
            <input type="hidden" name="security" id="oauth" value="oauth">
            <input type="hidden" name="applicationid" id="application-id" value="{{ $app->applicationId }}">
            <input type="hidden" name="sandboxmappingid" id="mapping-id-sandbox" value="{{ $sandbox->keyMappingId ?? ''}}">
            <input type="hidden" name="sandboxconsumersecret" id="consumer-secret-sandbox" value="{{ $sandbox->consumerSecret ?? ''}}">
            <input type="hidden" name="productionmappingid" id="mapping-id-production" value="{{ $production->keyMappingId ?? ''}}">
            <input type="hidden" name="productionconsumersecret" id="consumer-secret-production" value="{{ $production->consumerSecret ?? ''}}">
            @csrf
            <div class="keytype p-2">
                <div>
                    <p class="fs-6 fw-bold">Key type</p>
                    <hr>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input check-oauth" type="radio" name="keytype" id="inlineRadio1"
                        value="SANDBOX" checked>
                    <label class="form-check-label" for="inlineRadio1">Sandbox</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input check-oauth" type="radio" name="keytype" id="inlineRadio2"
                        value="PRODUCTION">
                    <label class="form-check-label" for="inlineRadio2">Production</label>
                </div>
            </div>
            <div class="gateway p-2">
                <div>
                    <p class="fs-6 fw-bold">
                        Gateway
                    </p>
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
            </div>
            <div class="api p-2">
                <p class="fs-6 fw-bold">
                    API
                </p>
                <hr>
                <div>
                    <select class="form-select" aria-label="api" name="api">
                        <option>-- Select API --</option>
                        @foreach ($subs->list as $items)
                        <option value="{{ $items->apiInfo->name }}" data-toggle="tooltip" data-placement="top"
                          title="{{ $items->apiInfo->description}} ">
                          {{ $items->apiInfo->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>

@push('script')
    <script>
        function resetoauth(){
            $('#accesstoken-oauth').val('');
        }

        $('.check-oauth').on('click',function(){
            resetoauth();
        });

        $(document).on('submit','#form-oauth-generate-test-key', function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $('.btn-generate-test-key').html(`<i class='bx bx-loader-circle bx-flip-horizontal bx-spin' style='color:#05fa18' ></i>`).attr('disabled', true);
                },
                success: function(data) {
                    if (data.data != null) {
                        $('#accesstoken-oauth').val(data.data.accessToken);
                        $('.btn-generate-test-key').html(`Generate Test Key`).attr('disabled', false);
                    } else {
                        setTimeout(location.reload.bind(location), 1000);
                    }
                },
                error: function(){

                }
            });
        });
    </script>
@endpush
