@extends('layouts.front')

@section('fe_content')
    <div class="container-xxl courses my-6 py-6 pb-0">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h6 class="text-primary text-uppercase mb-2">Tranding Courses</h6>
                <h1 class="display-6 mb-4">Our Courses Upskill You With Driving Training</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($data as $item)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="courses-item d-flex flex-column bg-white overflow-hidden h-100">
                            <div class="text-center p-4 pt-0">
                                <div class="d-inline-block bg-primary text-white fs-5 py-1 px-4 mb-4">${{ $item->price }}
                                </div>
                                <h5 class="mb-3">{{ $item->title }}</h5>
                                <p>{{ $item->description }}</p>
                                <ol class="breadcrumb justify-content-center mb-0">
                                    <li class="breadcrumb-item small"><i
                                            class="fa fa-signal text-primary me-2"></i>{{ $item->category->name }}</li>
                                    </li>
                                    <li class="breadcrumb-item small"><i
                                            class="fa fa-calendar-alt text-primary me-2"></i>{{ $item->duration }}
                                        Week</li>
                                </ol>
                            </div>
                            <div class="position-relative mt-auto">
                                @if (Storage::exists($item->image_banner))
                                    <img class="img-fluid" src="{{ asset('storage/' . $item->image_banner) }}"
                                        loading="lazy" alt="" style="height: 300px; width: 100%">
                                @else
                                    <img class="img-fluid" src="{{ asset('front/img/courses-1.jpg') }}" alt=""
                                        loading="lazy" style="height: 300px; width: 100%">
                                @endif
                                <div class="courses-overlay">
                                    <a class="btn btn-outline-primary border-2" href="{{ url('courses/' . encrypt($item->id)) }}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
