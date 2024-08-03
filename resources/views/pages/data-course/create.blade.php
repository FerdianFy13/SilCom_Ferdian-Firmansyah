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
                    <form id="formInsert" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="nameInput" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="nameInput" aria-describedby="nameInput"
                                        autofocus required placeholder="Input your title course" name="title"
                                        value="{{ old('title') }}" oninput="(() => { restrictInput(this); })()"
                                        maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label for="categoryInput" class="form-label">Category</label>
                                    <select class="form-control js-example-basic-single" id="category Input"
                                        name="category_id" required>
                                        <option value="">-- Select Category Course --</option>
                                        @foreach ($data as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="priceInput" class="form-label">Price</label>
                                    <input type="text" class="form-control" id="priceInput" aria-describedby="priceInput"
                                        autofocus required placeholder="Input your price course" name="price"
                                        inputmode="numeric" value="{{ old('price') }}"
                                        oninput="(() => { restrictNumber(this); })()" maxlength="10">
                                </div>
                                <div class="form-group">
                                    <label for="durationInput" class="form-label">Duration</label>
                                    <input type="text" class="form-control" id="durationInput"
                                        aria-describedby="durationInput" autofocus required
                                        placeholder="Input your duration course" name="duration" inputmode="numeric"
                                        value="{{ old('duration') }}" oninput="(() => { restrictNumber(this); })()"
                                        maxlength="10">
                                </div>
                                <div class="form-group">
                                    <label for="quotaInput" class="form-label">Quota</label>
                                    <input type="text" class="form-control" id="quotaInput" aria-describedby="quotaInput"
                                        autofocus required placeholder="Input your quota course" name="quota"
                                        inputmode="numeric" value="{{ old('quota') }}"
                                        oninput="(() => { restrictNumber(this); })()" maxlength="10">
                                </div>
                                <div class="form-group">
                                    <label for="descriptionInput" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="descriptionInput"
                                        aria-describedby="descriptionInput" autofocus required
                                        placeholder="Input your description course" name="description"
                                        value="{{ old('description') }}" oninput="(() => { restrictInput(this); })()"
                                        maxlength="200">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="imageInput" class="form-label">Image Poster</label>
                                    <input type="file" accept=".jpg, .jpeg, .png" class="form-control" id="imageInput"
                                        aria-describedby="imageInput" autofocus required name="image_poster">
                                    <div class="mt-3 mb-2" id="imagePreviews">
                                        <img src="" alt="Image Poster Preview" class="rounded" height="200"
                                            id="imagePreview" style="display: none;">
                                    </div>
                                    <div id="imageInput" class="form-text">Please upload a photo in .jpg, .jpeg,
                                        .png format and up to 2 MB.</div>
                                </div>
                                <div class="form-group">
                                    <label for="imageInputCourse" class="form-label">Image Course</label>
                                    <input type="file" accept=".jpg, .jpeg, .png" class="form-control"
                                        id="imageInputCourse" aria-describedby="imageInputCourse" autofocus required
                                        name="image_banner">
                                    <div class="mt-3 mb-2" id="imagePreviews2">
                                        <img src="" alt="Image Course Preview" class="rounded" height="200"
                                            id="imagePreviewCourse" style="display: none;">
                                    </div>
                                    <div id="imageInputCourse" class="form-text">Please upload a photo in .jpg, .jpeg,
                                        .png format and up to 2 MB.</div>
                                </div>
                            </div>
                            <div class="col-sm-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-round btn-primary mb-1 fw-bolder"><i
                                        class="fas fa-save me-2"></i>Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('pages.data-course.dist.h_validation')
@include('pages.data-course.dist.h_insert')
@include('pages.data-course.dist.s_insert')
@include('pages.data-course.dist.select2')
