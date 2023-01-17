@extends('app')

@section('content')

<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="{{route('index')}}">Home</a></li>
            <li>My Application</li>
        </ol>
        <h2>Create Application</h2>

    </div>
</section>

<section class="inner-page">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="mb-5">
                    <a class="btn btn-primary" href="{{route('listapp')}}"><i class='bx bx-chevrons-left'></i> List
                        Application</a>
                </div>
            </div>
            <div class="col-12 col-lg-9" data-aos="zoom-in-left">
                <div class="mb-3">
                    <h2>Create an application</h2>
                    <p class="fw-light p-2">Create an application providing name and quota parameters. Description is
                        optional.</p>
                    <hr>
                </div>
                <div class="p-3">
                    <form action="{{route ('storeapp')}}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Application Name</label>
                            <div class="col-sm-10  @error('appname') is-invalid @enderror">
                                <input type="text" class="form-control" name="appname"
                                    placeholder="Enter Application Name" />
                                <p class="fw-light mt-2"><small>Enter a name to identify the Application. You will be
                                        able
                                        to pick this application when subscribing to APIs</small></p>
                                @error('appname')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="sharedquota" class="col-sm-2 col-form-label">Shared Quota</label>
                            <div class="col-sm-10 @error('shared') is-invalid @enderror">
                                <select class="form-select" aria-label="Choice Shared Quota" name="shared">
                                    <option selected>-- Select --</option>
                                    @foreach ($data->list as $item)
                                    <option value="{{$item->name}}" data-toggle="tooltip" data-placement="top"
                                        title="{{$item->description}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <p class="fw-light mt-2"><small>Assign API request quota per access token. Allocated
                                        quota
                                        will be shared among all the subscribed APIs of the application.</small></p>
                                @error('shared')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Description</label>
                            <div class="col-sm-10 @error('description') is-invalid @enderror">
                                <textarea id="basic-default-message" class="form-control" name="description"
                                    placeholder="Enter Description"></textarea>

                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Create Application</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
