<div class="" style="margin-top: 1.2em">
    <div class="row">
        <div class="col-md-8">
            <div class="mb-4">
                <h4 class="mb-2">A. Personal Information</h4>
                <div class="mb-2 row">
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
                    <label for="phone" class="col-sm-2 col-form-label">Phone:</label>
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
                                    class="img-fluid rounded-start h-100" alt="{{ $item->course->title }}">
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
                                    <form action="{{ route('order-payment.destroy', $item->id) }}" method="POST"
                                        enctype="multipart/form-data" id="formDelete">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <a id="btn-delete-checkout" class="btn btn-danger">Delete</a>
                                    </form>
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
                                <i class="fa fa-signal text-primary me-2"></i>{{ $item->course->category->name }}
                                <span class="mx-2">|</span>
                                <i class="fa fa-calendar-alt text-primary me-2"></i>{{ $item->course->duration }}
                                Week
                            </div>
                        </div>
                        <span class="badge bg-warning text-dark rounded-pill">${{ $item->course->price }}</span>
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
            <Button class="btn btn-primary w-100" id="pay-button"><i class="fa fa-credit-card me-2"></i>Payment
                Now</Button>
        </div>
    </div>
</div>
