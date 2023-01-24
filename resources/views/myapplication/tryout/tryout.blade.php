@extends('app')

@section('content')

<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <ol>
            <li><a href="{{route('index')}}">Home</a></li>
            <li>My Application</li>
        </ol>
        <h2>Try Out Api</h2>
    </div>
</section>

<section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 p-2">
                    <div class="bg-light p-3 rounded shadow">
                        <div class="p-3 d-flex justify-content-center">
                            <img src="{{asset ('assets/landingpage/img/app.png')}}" class="card-img-top w-50 mx-auto"
                            alt="Card Image">
                        </div>
                        <div class="mt-4">
                            <p class="fw-bold">{{ $app->name }}</p>
                            <p class="fw-bold text-capitalize">{{ $app->owner }}</p>
                            <p class="fw-bold">Subscription: {{ $app->subscriptionCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="row g-3">
                        <div class="col-12 mb-2">
                            <h4>Security</h4>
                            <hr>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioTryOut" id="oauth" value="1" checked>
                                <label class="form-check-label fw-bold" for="oauth">
                                  Oauth
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioTryOut" id="apikey" value="2">
                                <label class="form-check-label fw-bold" for="apikey">
                                  API Key
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioTryOut" id="basic" value="3">
                                <label class="form-check-label fw-bold" for="basic">
                                  Basic
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                          <div for="Oauth" class="option" id="Option1">
                            <div class="">
                              <form class="row g-3" action="{{ route ('generatetestkeyoauth') }}" method="POST" id="form-tryout-oauth"> 
                                @csrf
                                <input type="hidden" name="cosumersecret" value="">
                                <div class="col-12 col-md-12 col-lg-8">
                                  <label class="visually-hidden" for="inlineFormInputGroupUsername"></label>
                                  <div class="input-group">
                                    <span class="input-group-text" type="button" id="toggleAccesstoken"><i class="bi bi-eye-fill"></i></span>
                                    <input type="password" class="form-control oauthbearer" id="accesstoken" placeholder="Authorization: Bearer">
                                  </div>
                                </div>
                                                            
                                <div class="col-12 col-md-12 col-lg-4 d-grid gap-2">
                                  <button type="submit" class="btn btn-primary"><i class="bi bi-key-fill"></i> GENERATE TEST KEY</button>
                                </div>
                                <div class="col-12 col-md-6 mb-2">
                                  <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" name="gateway">
                                      <option selected>-- Select --</option>
                                      <option value="default">Default</option>
                                    </select>
                                    <label for="floatingSelectGrid">API Gateways</label>
                                  </div>
                                </div>
                                <div class="col-12 col-md-6">
                                  <div class="form-floating">
                                    <select class="form-select" id="floatingSelectKeytype" name="keytype">
                                      <option selected>-- Select --</option>
                                      <option value="PRODUCTION">Production</option>
                                      <option value="SANDBOX">SandBox</option>
                                    </select>
                                    <label for="floatingSelectKeytype">Key Type</label>
                                  </div>
                                </div>
                                <div class="col-12">
                                  <div class="form-floating">
                                    <select class="form-select" id="floatingSelectApi">
                                      <option selected>-- Select --</option>
                                      @foreach ($subs->list as $items)
                                      <option value="{{ $items->apiInfo->name }}" data-toggle="tooltip" data-placement="top"
                                        title="{{ $items->apiInfo->description}} ">
                                        {{ $items->apiInfo->name }}
                                      </option>
                                      @endforeach
                                    </select>
                                    <label for="floatingSelectApi">API</label>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <div for="Apikey" class="option" id="Option2" style="display: none;">
                            <div class="">
                              <form class="row g-3" action="{{ route ('generatetestkeyapikey') }}" method="POST" id="form-tryout-apikey">
                                @csrf
                                <input type="hidden" name="appid" value="{{ $app->applicationId }}">
                                <div class="col-12 col-md-12 col-lg-8">
                                  <label class="visually-hidden" for="inlineFormInputGroupUsername"></label>
                                  <div class="input-group">
                                    <span class="input-group-text" type="button" id="toggleAccesstoken"><i class="bi bi-eye-fill"></i></span>
                                    <input type="password" class="form-control inputapikey" id="accesstoken" placeholder="API Key" placeholder="apikey">
                                  </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-4 d-grid gap-2">
                                  <button type="submit" class="btn btn-primary btn-generate-test-key-apikey"><i class="bi bi-key-fill"></i> GENERATE TEST KEY</button>
                                </div>
                                <div class="col-12 col-md-6 mb-2">
                                  <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGateways" name="gateway">
                                      <option selected>-- Select --</option>
                                      <option value="default">Default</option>
                                    </select>
                                    <label for="floatingSelectGrid">API Gateways</label>
                                  </div>
                                </div>
                                <div class="col-12 col-md-6">
                                  <div class="form-floating">
                                    <select class="form-select" id="floatingSelectKeytype" name="keytype">
                                      <option selected>-- Select --</option>
                                      <option value="PRODUCTION">Production</option>
                                      <option value="SANDBOX">SandBox</option>
                                    </select>
                                    <label for="floatingSelectKeytype">Key Type</label>
                                  </div>
                                </div>
                                <div class="col-12">
                                  <div class="form-floating">
                                    <select class="form-select" id="floatingSelectApi" name="apitryout">
                                      <option selected>-- Select --</option>
                                      @foreach ($subs->list as $items)
                                      <option value="{{ $items->apiInfo->name }}" data-toggle="tooltip" data-placement="top"
                                        title="{{ $items->apiInfo->description}} ">
                                        {{ $items->apiInfo->name }}
                                      </option>
                                      @endforeach
                                    </select>
                                    <label for="floatingSelectApi">API</label>
                                  </div>
                                </div>
                              </div>
                              </form>
                          </div>
                          <div for="Basic" class="option" id="Option3" style="display: none;">
                            <div class="row g-3">
                              <div class="col-12 col-md-6">
                                <label for="username" class="fw-bold mb-2">Username</label>
                                <input type="text" class="form-control form-control-lg basicusername" id="username" name="username" placeholder="Username" aria-label="Username">
                              </div>
                              <div class="col-12 col-md-6">
                                <label for="password" class="fw-bold mb-2">Password</label>
                                <input type="password" class="form-control form-control-lg basicpassword" id="password" name="password" placeholder="Password" aria-label="Password">
                              </div>
                              <div class="col-12">
                                <div class="form-floating">
                                  <select class="form-select" id="floatingSelectGrid">
                                    <option selected>-- Select --</option>
                                    <option value="default">Default</option>
                                  </select>
                                  <label for="floatingSelectGrid">API Gateways</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                  <div id="swagger-ui"></div>
                </div>
            </div>
        </div>
</section>
@push('script')
<script>

    $('#toggleAccesstoken').on('click', function(e){
            e.preventDefault();
            var passInput=$("#accesstoken");
            if(passInput.attr('type')==='password')
            {
                passInput.attr('type','text');
                $(this).html('<i class="bi bi-eye-slash-fill"></i>');
                
            }else{
                passInput.attr('type','password');
                $(this).html('<i class="bi bi-eye-fill"></i>');
            }
        });

    $('.form-check-input').on('click', function(){
        if ($(this).val() == 'option1') {
            $('#apikey').hide();
            $('#basic').hide();
        }
        if ($(this).val() == 'option2') {
            $('#apikey').show(700);
            $('#basic').hide();
        }
        if ($(this).val() == 'option3') {
            $('#ipaddress').hide();
            $('#basic').show(700);
        }
    });

  $(document).ready(function() {
    $("input[name$='RadioTryOut']").click(function() {
        var valueoption = $(this).val();

        $("div.option").hide();
        $("#Option" + valueoption).show(700);
    });
  });
  
  $(document).on('submit','#form-form-tryout-apikey', function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $('.btn-generate-test-key').html(`<i class='bx bx-loader-circle bx-spin bx-rotate-270' style='color:#0b62e3' ></i>`).attr('disabled', true);
                },
                success: function(data) {
                    $('#accesstoken').val(data.data.apikey);
                },
                complete: function(){
                  location.reload();
                },

            });
        });
</script>
@endpush

@endsection