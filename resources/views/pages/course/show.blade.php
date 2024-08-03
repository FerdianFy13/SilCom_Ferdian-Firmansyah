@extends('layouts.front')

@section('fe_content')
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden ps-5 pt-5 h-100" style="min-height: 400px;">
                        @php
                            $defaultPoster = 'front/img/about-1.jpg';
                            $defaultBanner = 'front/img/about-2.jpg';
                        @endphp

                        <img class="position-absolute w-100 h-100"
                            src="{{ Storage::exists($data->image_poster) ? asset('storage/' . $data->image_poster) : asset($defaultPoster) }}"
                            alt="" loading="lazy" style="object-fit: cover;">

                        <img class="position-absolute top-0 start-0 bg-white pe-3 pb-3"
                            src="{{ Storage::exists($data->image_banner) ? asset('storage/' . $data->image_banner) : asset($defaultBanner) }}"
                            alt="" loading="lazy" style="width: 200px; height: 200px;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h6 class="text-primary text-uppercase mb-2">About Us</h6>
                        <h1 class="display-6 mb-4">{{ $data->title }}</h1>
                        <p>{{ $data->description }}</p>
                        <p class="mb-4">Join our SilCom Course and enhance your vehicle care skills in
                            just {{ $data->duration }} weeks. With a small group of only {{ $data->quota }} participants,
                            you'll receive personalized attention
                            and hands-on experience from industry experts. Priced at just ${{ $data->price }}, this course
                            offers a
                            comprehensive introduction to car maintenance, making it ideal for both enthusiasts and those
                            looking to improve their practical knowledge.</p>
                        <div class="row g-2 mb-4 pb-2">
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Fully Licensed
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Afordable Fee
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Best Trainers
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Price ${{ $data->price }}
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Duration {{ $data->duration }} Week
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Quota {{ $data->quota }}
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-sm-6">
                                @if ($data->quota > 0 && $data->status == 'Active')
                                    @if (Auth::check())
                                        @role('Customer')
                                            <form id="formInsert" enctype="multipart/form-data" method="POST">
                                                <input type="hidden" name="course_id" value="{{ $data->id }}">
                                                <a class="btn btn-primary py-3 px-5" id="btn-checkout">
                                                    Checkout Now
                                                </a>
                                            </form>
                                        @endrole
                                    @else
                                        <a class="btn btn-primary py-3 px-5"
                                            href="{{ route('login') . '?redirect=' . urlencode(url('/courses/' . encrypt($data->id))) }}">
                                            Checkout Now
                                        </a>
                                    @endif
                                @else
                                    <a class="btn btn-secondary py-3 px-5" tabindex="-1" id="btn-disabled"
                                        aria-disabled="true">
                                        Checkout Now
                                    </a>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <a class="d-inline-flex align-items-center btn btn-outline-primary border-2 p-2"
                                    href="{{ url('/courses') }}">
                                    <span class="flex-shrink-0 btn-square bg-primary">
                                        <i class="fa fa-backward text-white"></i>
                                    </span>
                                    <span class="px-3">Back</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('pages.course.dist.h_insert')
