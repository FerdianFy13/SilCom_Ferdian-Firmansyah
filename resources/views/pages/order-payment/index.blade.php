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
                    @if ($data->isEmpty())
                        <div class="" style="margin-top: 1.2em">
                            <h4 class="text-danger fw-bold">Data checkout course is null...</h4>
                        </div>
                    @else
                        @include('pages.order-payment.checkout')
                    @endif
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @include('pages.order-payment.history')
                </div>
            </div>
        </div>
    </div>

    {{-- modal snap midtrans --}}
    @include('pages.order-payment.modal')
    {{-- end modal snap midtrans --}}
@endsection

@include('pages.order-payment.dist.h_snap')
@include('pages.order-payment.dist.h_table')
