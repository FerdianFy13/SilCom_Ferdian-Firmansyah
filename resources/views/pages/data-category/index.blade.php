@extends('layouts.main')

@section('be_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-orange text-white btn-round me-auto"
                            onclick="location.href='{{ route('data-category.create') }}'">
                            <i class="fa fa-plus"></i>
                            Add Category
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('data-category.show', encrypt($item->id)) }}"
                                                    class="btn btn-icon btn-round btn-primary btn-md me-3">
                                                    <i class="fa fa-eye text-white"></i>
                                                </a>
                                                <a href="{{ route('data-category.edit', encrypt($item->id)) }}"
                                                    class="btn btn-icon btn-round btn-green btn-md me-3">
                                                    <i class="fa fa-edit text-white"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
