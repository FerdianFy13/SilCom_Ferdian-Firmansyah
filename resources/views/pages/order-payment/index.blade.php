@extends('layouts.front')

@section('fe_content')
    <div class="container-fluid">
        <div class="container wow fadeInUp" data-wow-delay="0.1s">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">Checkout</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">History</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="" style="margin-top: 1.2em">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <h4 class="mb-2">A. Personal Information</h4>
                                    <div class="mb-3 row">
                                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="name"
                                                value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="nik" class="col-sm-2 col-form-label">NIK:</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="nik"
                                                value="{{ Auth::user()->nik }}">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="email"
                                                value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <label for="phone" class="col-sm-2 col-form-label">Phone Number:</label>
                                        <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="phone"
                                                value="{{ Auth::user()->phone }}">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="mb-3">B. Course Information</h4>
                                    @foreach ($data as $item)
                                        <div class="card mb-3 shadow-sm">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <img src="{{ Storage::exists($item->course->image_poster) ? asset('storage/' . $item->course->image_poster) : asset('front/img/about-1.jpg') }}"
                                                        class="img-fluid rounded-start" alt="{{ $item->course->title }}">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $item->course->title }}</h5>
                                                        <p class="card-text">{{ $item->course->description }}</p>
                                                        <ul class="">
                                                            <li>Category:
                                                                {{ $item->course->category->name }}</li>
                                                            <li>Duration: {{ $item->course->duration }}
                                                                Week</li>
                                                            <li>Price: ${{ $item->course->price }}</li>
                                                            <li>Quota: {{ $item->course->quota }}</li>
                                                        </ul>
                                                        <a id="btn-delete-checkout" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-4">
                                <h4 class="mb-3">C. Payment Course</h4>
                                <ul class="list-group list-group-numbered">
                                    @foreach ($data as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">{{ $item->course->title }}</div>
                                                <div class="text-muted mt-1">
                                                    <i
                                                        class="fa fa-signal text-primary me-2"></i>{{ $item->course->category->name }}
                                                    <span class="mx-2">|</span>
                                                    <i
                                                        class="fa fa-calendar-alt text-primary me-2"></i>{{ $item->course->duration }}
                                                    Week
                                                </div>
                                            </div>
                                            <span
                                                class="badge bg-warning text-dark rounded-pill">${{ $item->course->price }}</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">Total(USD)</div>
                                        </div>
                                        <span class="badge bg-warning text-dark rounded-pill">${{ $data->sum('course.price') }}</span>
                                    </li>
                                </ul>
                                <Button class="btn btn-primary w-100"><i class="fa fa-credit-card me-2"></i>Payment Now</Button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...
                </div>
            </div>
        </div>
    </div>
@endsection
