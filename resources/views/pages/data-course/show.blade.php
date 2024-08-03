@extends('layouts.main')

@section('be_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <a href="{{ url('/data-course') }}" class="btn btn-danger btn-round">
                            <i class="fa fa-backward me-2"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="nameInput" class="form-label">Title</label>
                                <input type="text" class="form-control" id="nameInput" aria-describedby="nameInput"
                                    autofocus required placeholder="Input your title course" name="title"
                                    value="{{ old('title', $data->title ?? '') }}"
                                    oninput="(() => { restrictInput(this); })()" maxlength="50" readonly>
                            </div>
                            <div class="form-group">
                                <label for="categoryInput" class="form-label">Category</label>
                                <input type="text" class="form-control" id="categoryInput"
                                    aria-describedby="categoryInput" autofocus required
                                    placeholder="Input your category course" name="category"
                                    value="{{ old('category', $data->category->name ?? '') }}"
                                    oninput="(() => { restrictInput(this); })()" maxlength="50" readonly>
                            </div>
                            <div class="form-group">
                                <label for="priceInput" class="form-label">Price</label>
                                <input type="text" class="form-control" id="priceInput" aria-describedby="priceInput"
                                    autofocus required placeholder="Input your price course" name="price"
                                    inputmode="numeric" value="{{ old('price', $data->price ?? '') }}"
                                    oninput="(() => { restrictNumber(this); })()" maxlength="10" readonly>
                            </div>
                            <div class="form-group">
                                <label for="durationInput" class="form-label">Duration</label>
                                <input type="text" class="form-control" id="durationInput"
                                    aria-describedby="durationInput" autofocus required
                                    placeholder="Input your duration course" name="duration" inputmode="numeric"
                                    value="{{ old('duration', $data->duration ?? '') }}"
                                    oninput="(() => { restrictNumber(this); })()" maxlength="10" readonly>
                            </div>
                            <div class="form-group">
                                <label for="quotaInput" class="form-label">Quota</label>
                                <input type="text" class="form-control" id="quotaInput" aria-describedby="quotaInput"
                                    autofocus required placeholder="Input your quota course" name="quota"
                                    inputmode="numeric" value="{{ old('quota', $data->quota ?? '') }}"
                                    oninput="(() => { restrictNumber(this); })()" maxlength="10" readonly>
                            </div>
                            <div class="form-group">
                                <label for="descriptionInput" class="form-label">Description</label>
                                <input type="text" class="form-control" id="descriptionInput"
                                    aria-describedby="descriptionInput" autofocus required
                                    placeholder="Input your description course" name="description"
                                    value="{{ old('description', $data->description ?? '') }}"
                                    oninput="(() => { restrictInput(this); })()" maxlength="200" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="imageInput" class="form-label">Image Poster</label>
                                @if (Storage::exists($data->image_poster))
                                    <div class="mt-2 mb-2">
                                        <img src="{{ asset('storage/' . $data->image_poster) }}" alt="Image Poster Preview"
                                            class="rounded" height="200" id="imagePreview">
                                    </div>
                                @else
                                <div class="mt-2 mb-2">
                                    <img src="{{ asset('front/img/carousel-2.jpg') }}" alt="Image Poster Preview"
                                        class="rounded" height="200" id="imagePreview">
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="imageInputCourse" class="form-label">Image Course</label>
                                @if (Storage::exists($data->image_banner))
                                    <div class="mt-2 mb-2">
                                        <img src="{{ asset('storage/' . $data->image_banner) }}" alt="Image Poster Preview"
                                            class="rounded" height="200" id="imagePreview">
                                    </div>
                                @else
                                <div class="mt-2 mb-2">
                                    <img src="{{ asset('front/img/carousel-1.jpg') }}" alt="Image Poster Preview"
                                        class="rounded" height="200" id="imagePreview">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('pages.data-course.dist.s_show')