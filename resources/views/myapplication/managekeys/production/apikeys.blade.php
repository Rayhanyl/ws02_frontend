@extends('app')

@section('content')

<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="{{ route('index') }}">Home</a></li>
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
                    List Application
                </a>
            </div>
            <div class="col-12 mt-5">
                <div class="mb-3">
                    <div class="mb-4">
                        <h2 class="mb-2">Production API Key</h2>
                        <hr>
                    </div>
                </div>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-none-tab" data-bs-toggle="pill" data-bs-target="#pills-none" type="button" role="tab" aria-controls="pills-none" aria-selected="true">None</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-apiaddress-tab" data-bs-toggle="pill" data-bs-target="#pills-apiaddress" type="button" role="tab" aria-controls="pills-apiaddress" aria-selected="false">IP Addresses</button>
                      </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-http-tab" data-bs-toggle="pill" data-bs-target="#pills-http" type="button" role="tab" aria-controls="pills-http" aria-selected="false">HTTP Referrers (Web Sites)</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-none" role="tabpanel" aria-labelledby="pills-none-tab" tabindex="0">
                        @include('myapplication.managekeys.production.apikeys.none')
                    </div>
                    <div class="tab-pane fade" id="pills-apiaddress" role="tabpanel" aria-labelledby="pills-apiaddress-tab" tabindex="0">
                        @include('myapplication.managekeys.production.apikeys.apiaddress')
                    </div>
                    <div class="tab-pane fade" id="pills-http" role="tabpanel" aria-labelledby="pills-http-tab" tabindex="0">
                        @include('myapplication.managekeys.production.apikeys.http')
                    </div>
                  </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="generateapikey" tabindex="-1" aria-labelledby="generateapikeyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="generateapikeyLabel">Generate API Key</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="before-apikeys">
                <div class="form-check">
                    <form action="{{ route ('genapikey') }}" id="form-apikeys" method="POST">
                        @csrf
                        <input type="hidden" name="keytype" value="PRODUCTION">
                        <input type="hidden" name="appid" value="{{ $app->applicationId }}">
                        <div class="mb-3">
                            <input class="form-check-input" type="checkbox" name="infinitevalidity" id="infinitevalidity" checked>
                            <label class="form-check-label" for="infinitevalidity">
                                API Key with infinite validity period
                            </label>
                        </div>
                        <div class="mb-3 periodapikey" style="display: none;">
                            <label for="exampleInputEmail1" class="form-label">
                               <small>API Key validity period*</small> 
                            </label>
                            <input type="number" class="form-control" id="validityPeriod" name="validityPeriod" aria-describedby="validityPeriod" placeholder="Enter time in seconds">
                            <div id="validityPeriod" class="form-text">You can set an expiration period to determine the validity period of the token after generation. Set this as -1 to ensure that the apikey never expires.</div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="result-apikeys">
                <p>Please Copy the API Key
                    If the token type is JWT or API Key, please copy this generated token value as it will be displayed only for the current browser session. ( The token will not be visible in the UI after the page is refreshed. )</p>
                    <div>
                        <label for="text-apikey"></label>
                        <textarea name="token" id="text-apikey" cols="70" rows="10" disabled>
                        </textarea>
                    </div>
                    <div>
                        <small>Above token has a validity period of seconds.</small>
                    </div>
                    <button class="btn btn-success" onclick="myFunction()">Copy To clipboard</button>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-apikeys" form="form-apikeys">
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
         
        $('#pills-none-tab').on('click',function(){
            reset();
        }); 
        $('#pills-apiaddress-tab').on('click',function(){
            reset();
        }); 
        $('#pills-http-tab').on('click',function(){
            reset();
        });

        function reset(){
            $('.boxaddress').html('');
            $('#addip').val('');
            $('.boxhttp').html('');
            $('#addhttp').val('');
        }

        // API ADDRESS
        $('.addip').on('click',function(){
            let valip = $('.textaddress').val();
            $('.boxaddress').append(`<div class="col-3 deletboxipaddress"><p class="fw-bold permitip">${valip}</p> <button class="btn btn-danger btn-sm deleteaddress"><i class="bi bi-trash2-fill"></i></button></div>`);
            $('.textaddress').val('');
        });
        
        $(document).on('click','.deleteaddress', function(){
            $(this).parents('.deletboxipaddress').remove();
        });

        // Array to string IPADDRESS
        function arraytostringip(ipaddresses){
            let ipaddress = '';
            ipaddresses.forEach((element,i) => {
                if(i > 0 ){
                    ipaddress += ',' + element;
                }else{
                    ipaddress = element;
                }
            });
            return ipaddress;
        }

        // HTTP REFERER
        $('.addhttp').on('click',function(){
            let valhttp = $('.texthttp').val();
            $('.boxhttp').append(`<div class="col-3 deletboxhttp"><p class="fw-bold permithttp">${valhttp}</p> <button class="btn btn-danger btn-sm deletehttp"><i class="bi bi-trash2-fill"></i></button></div>`);
            $('.texthttp').val('');
        });

        $(document).on('click','.deletehttp', function(){
            $(this).parents('.deletboxhttp').remove();
        });

        // Array to string HTTP REFERRER
        function arraytostringhttp(httpreferrers){
            let httpreferer = '';
            httpreferrers.forEach((element,i) => {
                if(i > 0 ){
                    httpreferer += ',' + element;
                }else{
                    httpreferer = element;
                }
            });
            return httpreferer;
        }

        // GENERATE APIKEY
        $("#infinitevalidity").change(function() {
            if($(this).prop('checked')) {
                $('.periodapikey').hide();
            } else {
                $('.periodapikey').show();
            }
        });

        $(document).ready(function() {
            $('.result-apikeys').hide();
        });
        
        const myModalEl = document.getElementById('generateapikey')
        myModalEl.addEventListener('hidden.bs.modal', event => {
            $('.btn-apikeys').show();
            $('.before-apikeys').show();
            $('.result-apikeys').hide();
        });

        $(document).on('submit','#form-apikeys', function(e){
            let httpreferrers = [];
            let ipaddresses = [];

            $('.permitip').each(function(i, obj) {
                ipaddresses.push($(this).html());
            });
            $('.permithttp').each(function(i, obj) {
                httpreferrers.push($(this).html());
            });
            
            let arripaddress = arraytostringip(ipaddresses);
            let arrhttpreferers = arraytostringhttp(httpreferrers);
            let formdata = new FormData(this);
            
            formdata.append('ipaddresses',arripaddress);
            formdata.append('httpreferrers',arrhttpreferers);

            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formdata,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $('.btn-apikeys').html(`<i class='bx bx-cog bx-spin'></i> Loading`).attr('disabled', true);
                },
                success: function(data) {
                    $('.before-apikeys').hide();
                    $('.result-apikeys').show();
                    $('#text-apikey').val(data.data.apikey);
                    $('#text-valitytime').val(data.data.validityTime);
                    $('.btn-apikeys').hide();
                    $('.btn-apikeys').html(`<i class='bx bx-cog bx-rotate-180'></i> Generate`).attr('disabled', false);
                }
            });
        });


        // Copy text APIKEY
        function myFunction() {
            // Get the text field
            var copyText = document.getElementById("text-apikey");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);
            // if(copyText.value.length > 10) copyText.value = copyText.value.substring(0,20);

            Swal.fire(
            'Already Copied',
            '',
            'success'
            )
        }

    </script>
@endpush


@endsection
