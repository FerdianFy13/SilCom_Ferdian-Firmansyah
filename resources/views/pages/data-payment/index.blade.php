@extends('layouts.main')

@section('be_content')
    <ul class="nav nav-pills nav-secondary nav-pills-no-bd mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab-nobd" data-bs-toggle="pill" href="#pills-home-nobd" role="tab"
                aria-controls="pills-home-nobd" aria-selected="true">Paid</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab-nobd" data-bs-toggle="pill" href="#pills-profile-nobd" role="tab"
                aria-controls="pills-profile-nobd" aria-selected="false">Unpaid</a>
        </li>
    </ul>
    <div class="tab-content mb-3" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
            @include('pages.data-payment.paid')
        </div>
        <div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
            @include('pages.data-payment.unpaid')
        </div>
    </div>
@endsection

@include('pages.data-payment.dist.h_table')
