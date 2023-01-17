@extends('app')

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="{{route('index')}}">Home</a></li>
            <li>My Application</li>
        </ol>
        <h2>List Application</h2>

    </div>
</section><!-- End Breadcrumbs -->

<section class="inner-page">
    <div class="container">

        <div class="">
            <a class="btn btn-primary" href="{{route('myapp')}}"><i class='bx bx-chevrons-left'></i> Overview</a>
        </div>

        <section id="breadcrumbs" class="breadcrumbs rounded-3">
            <div class="container">
                <div class="row">
                    <div class="col-10">
                        <h2>List Application</h2>
                    </div>
                    <div class="col-2">
                        <a href="{{route ('createapp')}}" class="btn btn-success rounded"><i
                                class='bx bxs-add-to-queue'></i> Create Application</a>
                    </div>
                </div>
            </div>
        </section>

        <div class="row mt-3" data-aos="fade-up">

            @foreach ($data->list as $item)
            <div class="list-my-app col-12 col-mg-12 col-lg-4 d-flex align-items-stretch my-2">
                <div class="card rounded-lg">
                    <div class="col-12">
                        <div class="text-end p-2">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown" aria-expanded="true">
                                    <h3><i class='bx bx-menu'></i></h3>
                                </button>
                                <div class="dropdown-menu" data-popper-placement="bottom-start"
                                    style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(-23.2px, 27.2px, 0px);">
                                    <a class="dropdown-item" href="{{route ('subscription',$item->applicationId)}}"><i class="bx bx-smile me-1"></i>
                                        Subscription</a>
                                    {{-- <a class="dropdown-item" href="{{route ('oauthkeys',$item->applicationId)}}"><i
                                            class="bx bxs-key me-1"></i> Manage Keys</a> --}}
                                    <a class="dropdown-item" href="{{route ('managekeys',$item->applicationId)}}"><i
                                            class="bx bxs-key me-1"></i> Manage Keys</a>
                                    <a class="dropdown-item" href="{{route('editapp',$item->applicationId)}}"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item btn-deleteapp" href="{{route ('delete',$item->applicationId)}}"><i
                                            class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex bg-light bg-gradient text-dark">
                        <img src="{{asset ('assets/landingpage/img/app.png')}}" class="card-img-top w-50 mx-auto"
                            alt="Card Image">
                    </div>
                    <div class="card-body d-flex flex-column rounded-lg">
                        <h5 class="card-title">{{$item->name}}</h5>
                        <p class="card-text mb-4 text-break fw-light">{{$item->description}}</p>
                        <p class="fw-light">{{$item->throttlingPolicy}}</p>
                        <p class="fs-6">Subscription: {{$item->subscriptionCount}} AP(s)-</small>TryOut</p>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item {{$data->pagination->previous == ''?'disabled': '' }}"><a class="page-link"
                        href="{{$data->pagination->previous ?? '#'}}">Previous</a></li>
                 @for ($i = 0; $i < $numberpages; $i++)
                    <li clas   s="page-item"><a class="page-link" href="/applications?sortBy=name&sortOrder=asc&limit={{$limit}}&offset={{$limit * $i}}&groupId=">{{$i+1}}</a></li>
                 @endfor

                <li class="page-item {{$data->pagination->next == ''?'disabled': '' }}"><a class="page-link"
                        href="{{$data->pagination->next ?? '#'}}">Next</a>
                </li>
            </ul>
        </nav>

    </div>
</section>

@endsection

@push('script')
    <script>
        $(document).on('click', '.btn-deleteapp', function(e){
            e.preventDefault();
            let href = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure you want to delete this item?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href=href;
                }
            })
        });
    </script>
@endpush