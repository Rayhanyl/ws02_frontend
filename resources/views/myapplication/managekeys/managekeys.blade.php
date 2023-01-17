@extends('app')

@section('content')

@push('style')
<style>
    .card-hover {
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .card-hover:hover {
        box-shadow: 5px 6px 6px 2px #e9ecef;
        transform: scale(1.1);
    }

</style>
@endpush


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
        
        <div class="col-12 col-lg-3 mb-3">
            <a class="btn btn-primary" href="{{route('listapp')}}"><i class='bx bx-chevrons-left'></i>
                List Application
            </a>
        </div>

        <h2>Overview</h2>
        <hr>

        <div class="row">
            <div class="col-12 col-md-5 border-bottom rounded-2">
                <div class="text-center fw-bold">
                    <h4 class="text-uppercase">{{$app->name}}</h4>
                    <hr>
                </div>
                <div class="my-1">
                    <p class="fw-bold">Owner : <small class="fw-normal text-uppercase">{{$app->owner}} </small></p>
                </div>
                <div class="my-1">
                    <p class="fw-bold">Workflow Status :  <small class="fw-normal text-success">{{$app->status}} </small></p>
                </div>
                <div class="my-1">
                    <p class="fw-bold">Business Plan : </p>
                    {{$app->throttlingPolicy}}
                </div>
                <div class="my-1">
                   <p class="fw-bold text-center">Description : </p>
                   <p class="text-break">
                    {{$app->description}}
                    </p>
                </div>
            </div>

            <div class="col-12 col-md-7">
                <div class="col-12 p-4">
                    <h4 class="text-center fw-bold">Production</h4>
                    <hr>
                    <div class="d-grid gap-2">
                        <a href="{{route ('prodoauth',$app->applicationId)}}" class="btn btn-primary" type="button">
                            <i class="bi bi-file-earmark-lock2"></i>
                            Oauthkeys
                        </a>
                        <a href="{{route ('prodapi',$app->applicationId)}}" class="btn btn-primary" type="button">
                            <i class="bi bi-key"></i>
                            APIkeys
                        </a>
                    </div>
                </div>
                <div class="col-12 p-4">
                    <h4 class="text-center fw-bold">Sandbox</h4>
                    <hr>
                    <div class="d-grid gap-2">
                        <a href="{{route ('sandoauth', $app->applicationId)}}" class="btn btn-primary" type="button">
                            <i class="bi bi-file-earmark-lock2"></i>
                            Oauthkeys
                        </a>
                        <a href="{{route ('sandapi', $app->applicationId)}}" class="btn btn-primary" type="button">
                            <i class="bi bi-key"></i>
                            APIkeys
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
