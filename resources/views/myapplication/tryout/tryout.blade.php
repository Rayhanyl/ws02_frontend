@extends('app')

@section('content')

<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">
      <ol>
          <li><a href="{{route('index')}}">oauth</a></li>
          <li>My Application</li>
      </ol>
      <h2>Try Out API</h2>
  </div>
</section>

<section class="inner-page">
  <div class="container">
  <div class="col-12 col-lg-3">
      <div class="mb-5">
          <a class="btn btn-primary" href="{{route('listapp')}}"><i class='bx bx-chevrons-left'></i> List
              Application</a>
      </div>
  </div>
    <div class="glass card">
      <div class="card-body row g-4">
        <div class="col-12 col-md-4" data-aos="zoom-in-right">
          <div class="card rounded-5">
            <div class="card-body row">
                <div class="col-12 p-3 d-flex justify-content-center">
                  <img src="{{asset ('assets/landingpage/img/app.png')}}" class="card-img-top w-25 mx-auto"
                  alt="Card Image">
                </div>
                <div class="col-12 row p-3">
                  <p class="fw-bold fs-6">{{ $app->name }}</p>
                  <div class="col-6 fs-6">
                   Business plan <br>
                   {{ $app->throttlingPolicy }}
                  </div>
                  <div class="col-6 fs-6">
                    Subscription API <br>
                    {{ $app->subscriptionCount }}
                  </div>
                  <p class="fw-bold fs-6 mt-2">Description:</p>
                  <p class="fw-light fs-6 text-break">{{ $app->description }}</p>
                </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-8">
          <ul class="nav nav-pills justify-content-center fw-bold mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-oauth-tab" data-bs-toggle="pill" data-bs-target="#pills-oauth" type="button" role="tab" aria-controls="pills-oauth" aria-selected="true">OAuth</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-apikey-tab" data-bs-toggle="pill" data-bs-target="#pills-apikey" type="button" role="tab" aria-controls="pills-apikey" aria-selected="false">API key</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-basic-tab" data-bs-toggle="pill" data-bs-target="#pills-basic" type="button" role="tab" aria-controls="pills-basic" aria-selected="false">Basic</button>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-oauth" role="tabpanel" aria-labelledby="pills-oauth-tab" tabindex="0">
              @include('myapplication.tryout.oauth')
            </div>
            <div class="tab-pane fade" id="pills-apikey" role="tabpanel" aria-labelledby="pills-apikey-tab" tabindex="0">
              @include('myapplication.tryout.apikey')
            </div>
            <div class="tab-pane fade" id="pills-basic" role="tabpanel" aria-labelledby="pills-basic-tab" tabindex="0">
              @include('myapplication.tryout.basic')
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="swagger">
      <hr>
      <h1>Swagger 3.0</h1>
      {{-- <div id="swagger-ui"></div> --}}
    </div>
  </div>
</section>


@push('script')
    <script>

        $(document).on('click','.toggleAccesstoken', function(e){
            e.preventDefault();
            var passInput=$(".generatetestkey");
            if(passInput.attr('type')==='password')
            {
                passInput.attr('type','text');
                $(this).html('<i class="bi bi-eye-slash-fill"></i>');
                
            }else{
                passInput.attr('type','password');
                $(this).html('<i class="bi bi-eye-fill"></i>');
            }
        });

    </script>
@endpush


@endsection