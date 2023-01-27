@extends('app')

@section('content')

<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <ol>
            <li><a href="{{route('index')}}">Home</a></li>
            <li>Documentation</li>
        </ol>
        <h2>API Documentation</h2>
    </div>
</section>

<section class="inner-page">
    <div class="container">
        <h4>API Update: January 2023</h4>
        <hr>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="mb-3 row">
                    <label for="apiname" class="col-sm-2 col-form-label">API Name:</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control-plaintext fw-bold" id="apiname" value="jsonplaceholder1.0">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="selectapi" class="col-sm-2 col-form-label">Select API</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Select Api">
                            <option selected>-- Select API --</option>
                            <option>jsonplaceholder1.0</option>
                          </select>
                    </div>
                  </div>
            </div>
            <div class="col-md-12">
                <div class="enrollment">
                    <h5 class="bg-secondary fw-bold text-white rounded p-2">Enrollment</h5>
                    <div class="">
                        <p class="fw-bold">1. Pensiun</p>
                        <p>API ini digunakan untuk melihat kegiatan klaim</p>
                        <p>Request:</p>
                        <div class="row text-center">
                            <hr>
                            <div class="col-3">
                                <p>Field</p>
                            </div>
                            <div class="col-3">
                                <p>DataType</p>
                            </div>
                            <div class="col-3">
                                <p>Mandatory</p>
                            </div>
                            <div class="col-3">
                                <p>Description</p>
                            </div>
                            <hr>
                        </div>
                        <div class="row text-center">
                            <div class="col-3">
                                <p>UserID</p>
                            </div>
                            <div class="col-3">
                                <p>String (21)</p>
                            </div>
                            <div class="col-3">
                                <p>Y</p>
                            </div>
                            <div class="col-3">
                                <p>ID user</p>
                            </div>
                        </div>
                        <p class="fw-bold">cURL: </p>
                        <p class="text-break" id="text-curl">
                            curl -L -X POST 'http://dev-aas.asabri.co.id/pensiun' -H 'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6IlUyRnNkR1ZrWDE4WDlJemJOcTlQWlNKWHRXemFpV2o4ODdNMkdQNFNqdHM9IiwicGFzc3dvcmQiOiJVMkZzZEdWa1gxL3ltRWxtTmFwMHdIdHVlQlpWMy9JN05OSXdSUXRtSEVjPSIsImlhdCI6MTY1ODIyOTk1MSwiZXhwIjoxNjYwODIxOTUxfQ.6_UXZCmofvHuUOkHuamHa4HbQx_GGnJjOE9ytTBTJHA' -H 'Content-Type: application/x-www-form-urlencoded' --data-urlencode 'pen_nomor=ED371647111195
                        </p>
                        <div class="col-2 my-2 d-grid gap-2">
                            <button class="btn btn-primary btn-sm" onclick="myCopyCurl()"><i class="bi bi-clipboard"></i> Copy cURL</button>
                        </div>
                        <p class="fw-bold">Response:</p>
                        <div class="row text-center">
                            <hr>
                            <div class="col-3">
                                <p>Field</p>
                            </div>
                            <div class="col-3">
                                <p>DataType</p>
                            </div>
                            <div class="col-1">
                                <p>Mandatory</p>
                            </div>
                            <div class="col-3">
                                <p>Description</p>
                            </div>
                            <div class="col-2">
                                <p>LengtType</p>
                            </div>
                            <hr>
                        </div>
                        <div class="row text-center">
                            <div class="col-3">
                                <p>statusCode</p>
                            </div>
                            <div class="col-3">
                                <p>String (3)</p>
                            </div>
                            <div class="col-1">
                                <p>Y</p>
                            </div>
                            <div class="col-3">
                                <p>Status code</p>
                            </div>
                            <div class="col-2">
                                <p>Fixed</p>
                            </div>
                        </div>
                        <p class="fw-bold">JSON Body</p>
                        <p class="text-break">
                            {    <br>
                                "statusCode": 401,
                                <br>    
                                "code": "FST_JWT_AUTHORIZATION_TOKEN_EXPIRED",   
                                <br>
                                "error": "Unauthorized",    
                                <br>
                                "message": "Authorization token kadaluarsa"
                                <br>
                            }
                        </p>
                    </div>
                </div>
                <div class="kemenku">
                    <h5 class="bg-secondary fw-bold text-white rounded p-2">KEMENKEU</h5>
                </div>
            </div>
            {{-- <div class="col-md-12 row bd-callout bd-callout-warning rounded-2 my-2 p-4">
                <div class="col-1">
                    <h1><i class='bx bx-info-circle bx-flashing text-dark'></i></h1>
                </div>
                <div class="col-11 text-dark">
                    <p class="fw-bold fs-3">No Documents Available</p>
                    <p class="">No documents are available for this API</p>
                </div>
            </div> --}}
        </div>
    </div>
</section>
    @push('script')
        <script>
            let text = document.getElementById('text-curl').innerHTML;
            const myCopyCurl = async () => {
                try {
                await navigator.clipboard.writeText(text);
                    Swal.fire(
                        'Already Copied',
                        '',
                        'success'
                    )
                } catch (err) {
                console.error('Failed to copy: ', err);
                }
            }
        </script>
    @endpush
@endsection  