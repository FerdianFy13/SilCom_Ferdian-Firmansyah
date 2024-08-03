@extends('layouts.main')

@section('be_content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ implode(', ', $item->getPermissionNames() ? $item->getPermissionNames()->toArray() : []) }}
                                        </td>
                                        <td>{{ implode(', ', $item->getRoleNames() ? $item->getRoleNames()->toArray() : []) }}
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                @unless ($item->hasRole(['Admin']))
                                                    <button type="button" id="resetPassword"
                                                        class="btn btn-icon btn-round btn-orange btn-md me-3 resetPassword">
                                                        <i class="fa fa-key text-white" data-user-id="{{ $item->id }}"></i>
                                                    </button>
                                                @endunless

                                                <form method="POST" enctype="multipart/form-data" id="formDelete">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="button"
                                                        class="tn btn-icon btn-round btn-red btn-md deleteButton"
                                                        data-user-id="{{ $item->id }}">
                                                        <i class="fa fa-trash-alt text-white"></i>
                                                    </button>
                                                </form>
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

@include('pages.user-management.dist.h_table')
@include('pages.user-management.dist.h_insert')