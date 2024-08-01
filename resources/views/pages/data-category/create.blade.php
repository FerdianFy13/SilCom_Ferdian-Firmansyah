@extends('layouts.main')

@section('be_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <a href="{{ url('/data-category') }}" class="btn btn-danger btn-round">
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
                                    <label for="nameInput" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="nameInput" aria-describedby="nameInput"
                                        autofocus required placeholder="Input your title category" name="name"
                                        value="{{ old('name') }}" oninput="(() => { restrictInput(this); })()"
                                        maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="descriptionInput" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="descriptionInput"
                                        aria-describedby="descriptionInput" autofocus required
                                        placeholder="Input your description category" name="description"
                                        value="{{ old('description') }}" oninput="(() => { restrictInput(this); })()"
                                        maxlength="200">
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

@include('pages.data-category.dist.h_validation')
@include('pages.data-category.dist.h_insert')
