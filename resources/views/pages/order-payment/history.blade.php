<div class="table-responsive">
    <table id="basic-datatables" class="display table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Course</th>
                <th>Category</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Quota</th>
                <th>Transaction Code</th>
                <th>Transaction Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($history as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>${{ $item->price }}</td>
                    <td>{{ $item->duration }} Week</td>
                    <td>{{ $item->quota }}</td>
                    <td>
                        <button type="submit"
                            class="btn btn-primary btn-round btn-md {{ $item->status === 'Active' ? 'btn-green' : 'btn-red' }}"
                            id="btn-status" data-id="{{ $item->id }}">
                            {{ $item->status }}
                        </button>

                    </td>
                    <td>
                        <div class="form-button-action">
                            <a href="{{ route('data-course.show', encrypt($item->id)) }}"
                                class="btn btn-icon btn-round btn-primary btn-md me-3">
                                <i class="fa fa-eye text-white"></i>
                            </a>
                            <a href="{{ route('data-course.edit', encrypt($item->id)) }}"
                                class="btn btn-icon btn-round btn-green btn-md me-3">
                                <i class="fa fa-edit text-white"></i>
                            </a>
                            <form action="{{ route('data-course.destroy', $item->id) }}" method="POST"
                                enctype="multipart/form-data" id="formDelete">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button type="button" class="tn btn-icon btn-round btn-red btn-md deleteButton">
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
