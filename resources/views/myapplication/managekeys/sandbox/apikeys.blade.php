@include('component.header')

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
                <a class="btn btn-primary" href="#"><i class='bx bx-chevrons-left'></i>
                    OAuth2 Keys
                </a>
            </div>
            <div class="col-12 mt-5">
                <div class="mb-3">
                    <div class="mb-4">
                        <h2 class="mb-2">API Keys</h2>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4 bg-light rounded" data-aos="fade-up-right">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p class="fw-bold">
                                        Application Name:
                                    </p>
                                    {{$app->name}}
                                </li>
                                <li class="list-group-item">
                                    <p class="fw-bold">
                                        Business Plan:
                                    </p>
                                    {{$app->throttlingPolicy}}
                                </li>
                                <li class="list-group-item text-break">
                                    <p class="fw-bold">
                                        Description:
                                    </p>
                                    {{$app->description}}
                                </li>
                            </ul>
                            <div class="d-grid gap-2 my-3">
                                <button class="btn btn-outline-primary" type="button"><i class='bx bxs-key'></i>
                                    Generate Key</button>
                                <small class="text-muted p-3">(Use the Generate Key button to generate a self-contained
                                    JWT token.)</small>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 mt-1" data-aos="fade-up-left">
                            <h4 class="p-2">Sandbox API Keys</h4>
                            <p class="fw-bold">Key Restrictions</p>
                            <div class="">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="optionapi"
                                        id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">None</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="optionapi"
                                        id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">IP Addresses</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="optionapi" value="option3"  id="inlineRadio3">
                                    <label class="form-check-label" for="inlineRadio3">HTTP Referrers (Web
                                        Sites)</label>
                                </div>
                            </div>
                            <div class="ps-5 mt-2">
                                <div class="border rounded">

                                    <div class="mb-3 row" id="ipaddress" style="display: none;">
                                        <div class="col-12">
                                            <h5>Description Address</h5>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control textaddress" placeholder="IP Address">
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-outline-success mb-3 shadow addip"><i
                                                    class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                        <div class="col-12 px-4 boxaddress">
                                        </div>
                                    </div>

                                    <div class="mb-3 row" id="httpref" style="display: none;">
                                        <div class="col-12">
                                            <h5>Description HTTP</h5>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control texthttp" placeholder="HTTP Referrers">
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-outline-success mb-3 shadow addhttp"><i
                                                    class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                        <div class="col-12 px-4 boxhttp">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script')
<script>
    $('.form-check-input').on('click', function(){
        if ($(this).val() == 'option1') {
            $('#ipaddress').hide();
            $('#httpref').hide();
        }

        if ($(this).val() == 'option2') {
            $('#ipaddress').show(700);
            $('#httpref').hide();
        }

        if ($(this).val() == 'option3') {
            $('#ipaddress').hide();
            $('#httpref').show(700);
        }

    });

    $('.addip').on('click',function(){
        let valhttp = $('.textaddress').val();
        $('.boxaddress').append(`<p>${valhttp}<button class="btn btn-danger btn-sm deleteaddress"><i class="bi bi-trash3"></i></button></p>`);
        $('.textaddress').val('');
    });
    
    $(document).on('click','.deleteaddress', function(){
        $(this).parents('p').remove();
    });

    $('.addhttp').on('click',function(){
        let valhttp = $('.texthttp').val();
        $('.boxhttp').append(`<p>${valhttp}<button class="btn btn-danger btn-sm deletehttp"><i class="bi bi-trash3"></i></button></p>`);
        $('.texthttp').val('');
    });

    $(document).on('click','.deletehttp', function(){
        $(this).parents('p').remove();
    });



    
    
</script>
@endpush

@include('component.footer')
