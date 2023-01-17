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

        <h4><i class="bi bi-gear"></i> Subscription Management</h4>
        <hr>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="col-12 mb-3">
                    <a class="btn btn-primary" href="{{route ('listapp')}}"><i class='bx bx-chevrons-left'></i>
                        List Application
                    </a>
                </div>
                <div class="card border-dark rounded-4 shadow border-opacity-50 mt-5">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <p class="fw-bold">Application Name :</p>
                                <i class='bx bx-desktop'></i> {{$data->name}}
                            </li>
                            <li class="list-group-item">
                                <p class="fw-bold">Owner :</p>
                                <i class="bi bi-person-circle"></i> {{$data->owner}}
                            </li>
                            <li class="list-group-item">
                                <p class="fw-bold">Description :</p>
                                {{$data->description}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{route ('addsubscription',$data->applicationId)}}"
                    class="btn btn-success rounded fw-bold">
                    <i class='bx bx-add-to-queue text-light'></i> Subscribe APIs</a>
                </div>
                <div class="col-12 mt-5">
                    @if ($subs->list == null)
                    <div class="col-md-12 p-5">
                        <div class="col-md-12 row bd-callout bd-callout-warning rounded-2 my-2 p-4">
                            <div class="col-1">
                                <h1><i class='bx bx-info-circle bx-flashing text-dark'></i></h1>
                            </div>
                            <div class="col-11 text-dark">
                                <p class="fw-bold fs-3">No Subscriptions Available</p>
                                <p class="">No subscriptions are available for this Application</p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="table-responsive mt-3">
                        <table id="example" class="table table-striped table-hover" style="width:100%">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">API</th>
                                    <th scope="col">Lifecycle State</th>
                                    <th scope="col">Business Plan</th>
                                    <th scope="col">Subscription Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subs->list as $items)
                                <tr>
                                    <td>{{$items->apiInfo->name}} - {{$items->apiInfo->version}} </td>
                                    <td>{{$items->apiInfo->lifeCycleStatus}}</td>
                                    <td>{{$items->throttlingPolicy}}</td>
                                    <td>{{$items->status}} </td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-edit-subs" data-subs-id="{{ $items->subscriptionId }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <a class="btn btn-danger btn-deletesubs"
                                            href="{{route ('deletesubs',$items->subscriptionId)}}">
                                            <i class="bi bi-trash3"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@include('myapplication.subscription._modal')

@push('script')
    <script>
        var modal = new bootstrap.Modal(document.getElementById('subscription-modal'));
        var jqmodal = $('#subscription-modal');
        var loaderModal = $('#modalLoader');
        var contentModal = $('#modalContent');
        $(document).on('click', '.btn-edit-subs', function() {
            modal.show();
            jqmodal.find('.modal-title').html('Update Subscription');
            $('.btn-submit').show();
            jqmodal.find('.btn-submit').attr('form', 'form-edit-subscription');
            var idsubs = $(this).data('subs-id');
            $.ajax({
                type: "GET",
                url: '{{ route('editsubs') }}',
                dataType: 'html',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_subs: idsubs,
                },
                beforeSend: function() {
                    contentModal.html('');
                    loaderModal.html(
                        '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>'
                    );
                },
                success: function(data) {
                    contentModal.html(data);
                },
                complete: function() {
                    loaderModal.html('');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                    contentModal.html(pesan);
                },
            });
        }); 


        $(document).on('click', '.btn-deletesubs', function(e){
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

        $(document).ready(function () {
            $('#example').DataTable({

                });
        });
    </script>
@endpush

@endsection
