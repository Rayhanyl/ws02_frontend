@extends('app')

@section('content')

<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="{{route('index')}}">Home</a></li>
            <li>My Application</li>
        </ol>
        <h2>Subscription</h2>

    </div>
</section>

<section class="inner-page">
    <div class="container" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">

        <div class="col-12 mb-3">
            <a class="btn btn-primary" href="{{route ('subscription', $data->applicationId)}}"><i class='bx bx-chevrons-left'></i>
                List Subscription
            </a>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <h4><i class="bi bi-node-plus-fill"></i> Add Subscription</h4>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a class="btn btn-success my-2" href="#"><i class='bx bx-add-to-queue text-light'></i>  Colective Subscribe</a>
            </div>
            <hr>
        </div>

        <div class="my-2">
            <p class="fw-bold"><i class="bi bi-list"></i> List API</p>
        </div>
        <div class="row">

            @if ($notsubs == null)
                <div class="col-md-12 my-2">
                    <div class="col-md-12 row bd-callout bd-callout-warning rounded-2 my-2 p-4">
                        <div class="col-1">
                            <h1><i class='bx bx-info-circle bx-flashing text-dark'></i></h1>
                        </div>
                        <div class="col-11 text-dark">
                            <p class="fw-bold fs-3">No APIs Available</p>
                            <p class="">No api are available for this Application</p>
                        </div>
                    </div>
                </div> 
            @else
                @foreach ($notsubs as $item)
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <p class="fw-bold">{{$item->name}}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="form-check d-flex justify-content-end">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body row">
                                <form action="{{route ('storesubs')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="appid" value="{{$data->applicationId}}">
                                    <input type="hidden" name="apiid" value="{{$item->id}}">
                                    <div class="col-12 col-md-4 my-1">
                                        <p class="fw-bold">Version {{$item->version}}</p>
                                    </div>
                                    <div class="col-12 col-md-8 my-1">
                                        <label for="subs">Subscription Status</label>
                                        <select class="form-select my-1" aria-label="Choice Subscription Status" name="status" required>
                                            <option value=""  selected disabled>-- Select --</option>
                                            @foreach ($item->throttlingPolicies as $items)
                                            <option value="{{$items}}">{{$items}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-grid gap-2 my-2">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="bi bi-plus-circle"></i>
                                            Subscribe
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


            <div class="col-12 my-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>

        {{-- <div class="col-12 col-lg-3">
            <a class="btn btn-primary" href="{{route ('subscription', $data->applicationId)}}"><i
            class='bx bx-chevrons-left'></i>
        List Subscription
        </a>
    </div> --}}

    </div>
</section>




@endsection
