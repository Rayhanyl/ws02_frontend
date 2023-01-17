@extends('app')

@section('content')

<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="{{route('index')}}">Home</a></li>
            <li>My Application</li>
        </ol>
        <h2>Manage Keys</h2>

    </div>
</section>

<section class="inner-page">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-12 col-lg-3">
                <a class="btn btn-primary" href="{{route('managekeys',$app->applicationId)}}"><i class='bx bx-chevrons-left'></i>
                    Overview
                </a>
            </div>
            <div class="col-12 mt-5">
                <div class="mb-3">
                    <div class="mb-4">
                        <h2 class="mb-2">Manage an application key</h2>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4 bg-light rounded" data-aos="fade-up-right">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p class="fw-bold">
                                        Application Name:
                                    </p>
                                    {{ $app->name }}
                                </li>
                                <li class="list-group-item">
                                    <p class="fw-bold">
                                        Business Plan:
                                    </p>
                                    {{ $app->throttlingPolicy }}
                                </li>
                                <li class="list-group-item text-break text-capitalize">
                                    <p class="fw-bold">
                                        Description:
                                    </p>
                                    {{ $app->description }}
                                </li>
                            </ul>
                            <div class="d-grid gap-2 my-3">

                                @if (isset($data->keyMappingId))
                                <button class="btn btn-outline-primary fw-bold generate" type="submit" form="generatekey">
                                    <i class="bi bi-recycle"></i>
                                    UPDATE</button>
                                <button class="btn btn-outline-primary fw-bold generate" type="submit"
                                data-bs-toggle="modal" data-bs-target="#generateaccess" form="generateaccess">
                                    Generate Access Token</button>
                                <button class="btn btn-outline-primary fw-bold generate" type="submit" 
                                data-bs-toggle="modal" data-bs-target="#generatecurl" form="generatecurl">
                                    CURL to Generate Access Token</button>
                                @else
                                <button class="btn btn-outline-primary generate" type="submit" form="generatekey"><i
                                        class='bx bxs-key'></i>
                                    GENERATE KEY</button>
                                @endif

                            </div>
                        </div>
                        <div class="col-12 col-lg-8 mt-1" data-aos="fade-up-left">
                            <h4 class="p-2">Sandbox OAuth2 Keys</h4>
                            <div class="p-3">
                                <form class="row g-3 mb-3" action="{{ isset($data->keyMappingId) ?  route('updategenerate') : route('oauthgenerate') }}"
                                    id="generatekey" method="POST">
                                    @csrf
                                    <input type="hidden" name="type" value="SANDBOX">
                                    <input type="hidden" name="idmapping" value="{{ $data->keyMappingId ?? '' }}">
                                    <input type="hidden" name="keymanager" value="{{ $data->keyManager ?? '' }}">
                                    <input type="hidden" name="id" value="{{ $app->applicationId }}">

                                    @if (isset($data->consumerKey))
                                        <div class="row consumer">
                                            <div class="col-md-6">
                                                <label for="consumerkey" class="form-label">Consumer Key</label>
                                                <input type="text" class="form-control" name="consumerkey" value="{{ $data->consumerKey ?? '' }}"
                                                    placeholder="N/A" readonly/>
                                                <div id="emailHelp" class="form-text">Consumer Key of the application.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="secretkey" class="form-label">Secret Key</label>
                                                <input type="text" class="form-control" name="secretkey" value="{{ $data->consumerSecret ?? '' }}"
                                                    placeholder="N/A" readonly/>
                                                    <div id="emailHelp" class="form-text">Consumer Secret of the application.</div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12 infoconsumer">
                                            <p>Key and Secret <br>
                                                <mark class="text-danger"> Production Key and Secret is not
                                                    generated for this application</mark></p>
                                        </div>                                        
                                    @endif

                                    <div class="col-md-6">
                                        <label for="tokenendpoint" class="form-label">Token Endpoint</label>
                                        <input type="text" class="form-control" name="tokenendpoint"
                                            value="{{ $url }}/oauth2/token" placeholder="N/A"
                                            readonly />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="revokeendpoint" class="form-label">Revoke Endpoint</label>
                                        <input type="text" class="form-control" name="revokeendpoint"
                                            value="{{ $url }}/oauth2/revoke" placeholder="N/A"
                                            readonly />
                                    </div>
                                    <div class="col-md-12">
                                        <label for="GrantTypes" class="form-label">Grant Types :</label>
                                        <div class="row">

                                            @foreach ($grant->grantTypes as $item)
                                                @if ($item == 'implicit')
                                                    @continue
                                                @endif
                                            <div class="col-md-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="granttype[{{ $item }}]" role="switch" 
                                                        {{ isset($data->supportedGrantTypes) ? (in_array($item,$data->supportedGrantTypes) ? 'checked':'') : '' }}
                                                        {{ isset($data->supportedGrantTypes) ? '' : (($item == 'password' || $item == 'client_credentials') ? 'checked':'') }}>
                                                    <label class="form-check-label">
                                                        @foreach ($granttype as $key=>$label)
                                                            @if ($key == $item)
                                                                {{ $label }}
                                                            @endif
                                                        @endforeach
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach

                                            <div class="col-md-12">
                                                <small>
                                                    <mark class="fw-light text-danger">
                                                        (The application can use the following grant types to
                                                        generate Access Tokens. Based on the application
                                                        requirement,you can enable or disable grant types for
                                                        this application.)
                                                    </mark>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="GrantTypes" class="form-label">Scope :</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="scopetype[am_application_scope]" role="switch"
                                                    checked>
                                                    <label class="form-check-label"
                                                        for="amapplication">am_application_scope</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="scopetype[default]" role="switch"
                                                        checked>
                                                    <label class="form-check-label"
                                                        for="default">Default</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="consumerkey" class="form-label">CallBack URL</label>
                                        <input type="url" class="form-control" name="callback" pattern="https?://.+"
                                        value="{{ $data->callbackUrl ?? 'http://sample.com/callback/url' }} " readonly/>
                                        <div id="emailHelp" class="form-text">Callback URL is a redirection URI
                                            in the client application which is used by the authorization server
                                            to send the client's user-agent (usually web browser) back after
                                            granting access.</div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="consumerkey" class="form-label">User Access Token Expiry
                                            Time</label>
                                        <input type="text" class="form-control" placeholder="N/A" name="additional[user_access_token_expiry_time]"
                                        value="{{ $data->additionalProperties->user_access_token_expiry_time ?? '' }}"/>
                                        <div id="emailHelp" class="form-text">Type User Access Token Expiry
                                            Time.</div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="consumerkey" class="form-label">Refresh Token Expiry
                                            Time</label>
                                        <input type="text" class="form-control" placeholder="N/A" name="additional[refresh_token_expiry_time]"
                                        value="{{ $data->additionalProperties->refresh_token_expiry_time ?? '' }}"/>
                                        <div id="refrestoken" class="form-text">Type Refresh Token Expiry Time.
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="generatecurl" tabindex="-1" aria-labelledby="generatecurlLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="generatecurlLabel">Get CURL to Generate Access Token</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>The following cURL command shows how to generate an access token using the Password Grant type.</p>
            <div>
                curl -k -X POST {{ $url }}/oauth2/token -d "grant_type=password&username=Username&password=Password"
                -H "Authorization: Basic <a id="userpasscurl" href="#">Base64(consumer-key:consumer-secret)</a>"
            </div>
            <p>In a similar manner, you can generate an access token using the Client Credentials grant type with the following cURL command.</p>
            <div>
                curl -k -X POST {{ $url }}/oauth2/token -d "grant_type=client_credentials"
                -H "Authorization: Basic <a id="credentialcurl" href="#">Base64(consumer-key:consumer-secret)</a>"
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="generateaccess" tabindex="-1" aria-labelledby="generateaccessLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="generateaccessLabel">Generate Access Token</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('accesstoken') }}" method="POST" id="form-accesstoken">
                @csrf
                <input type="hidden" name="consumersecretkey" value="{{ $data->consumerSecret ?? '' }}">
                <input type="hidden" name="id" value="{{ $app->applicationId }}">
                <input type="hidden" name="idmapping" value="{{ $data->keyMappingId ?? '' }}">
            </form>
            <div class="before-accesstoken">
                <p class="fw-bold">Scopes</p>
                <hr>
                <p class="text-break">When you generate access tokens to APIs protected by scope/s, you can select the scope/s and then generate the token for it. Scopes enable fine-grained access control to API resources based on user roles. You define scopes to an API resource. When a user invokes the API, his/her OAuth 2 bearer token cannot grant access to any API resource beyond its associated scopes.</p>
            </div>
            <div class="result-accesstoken">
                <h4>Please Copy the Access Token</h4>
                <p>
                    If the token type is JWT or API Key, please copy this generated token value as it will be displayed only for the current browser session. ( The token will not be visible in the UI after the page is refreshed. )
                </p>
                <label for="text-accesstoken"></label>
                <textarea name="token" id="text-accesstoken" cols="30" rows="10" disabled>
                </textarea>
                <button class="btn btn-success" onclick="myFunction()">Copy To clipboard</button>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-accesstoken" form="form-accesstoken">
                <i class='bx bx-cog bx-rotate-180'></i> 
                Generate
            </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            $('.result-accesstoken').hide();
        });
        
        const myModalEl = document.getElementById('generateaccess')
        myModalEl.addEventListener('hidden.bs.modal', event => {
            $('.btn-accesstoken').show();
            $('.before-accesstoken').show();
            $('.result-accesstoken').hide();
        });

        $(document).on('submit','#form-accesstoken', function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $('.btn-accesstoken').html(`<i class='bx bx-cog bx-spin'></i> Loading`).attr('disabled', true);
                },
                success: function(data) {
                    $('.before-accesstoken').hide();
                    $('.result-accesstoken').show();
                    $('#text-accesstoken').val(data.data.accessToken);
                    $('.btn-accesstoken').hide();
                    $('.btn-accesstoken').html(`<i class='bx bx-cog bx-rotate-180'></i> Generate`).attr('disabled', false);
                }
            });
        });

        function myFunction() {
            // Get the text field
            var copyText = document.getElementById("text-accesstoken");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);
            if(copyText.value.length > 10) copyText.value = copyText.value.substring(0,20);

            Swal.fire(
            'Already Copied',
            copyText.value+'....',
            'success'
            )
        }

        $('#credentialcurl').on('click', function(e){
            e.preventDefault();
            if($(this).html() == 'Base64(consumer-key:consumer-secret)'){
                $(this).html('{{ $base64 }}'); 
            }else{
                $(this).html('Base64(consumer-key:consumer-secret)');
            }
        });
        $('#userpasscurl').on('click', function(e){
            e.preventDefault();
            if($(this).html() == 'Base64(consumer-key:consumer-secret)'){
                $(this).html('{{ $base64 }}'); 
            }else{
                $(this).html('Base64(consumer-key:consumer-secret)');
            }
        });
    </script>
@endpush

@endsection

