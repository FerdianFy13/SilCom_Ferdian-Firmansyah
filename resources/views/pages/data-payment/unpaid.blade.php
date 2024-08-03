<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables2" class="display table table-hover">
                        <thead>
                            <tr>
                                <th class="text-start">No</th>
                                <th class="text-start">Course</th>
                                <th class="text-start">User</th>
                                <th class="text-center">Payment Status</th>
                                <th class="text-start">Category</th>
                                <th class="text-center">Duration</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Checkout Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataUnpaid as $item)
                                <tr>
                                    <td class="text-start">{{ $loop->iteration }}</td>
                                    <td class="text-start">{{ Str::limit($item->course->title, 20) }}</td>
                                    <td class="text-start">{{ $item->user->name }}</td>
                                    <td class="text-center">{{ $item->status }}</td>
                                    <td class="text-start">{{ $item->course->category->name }}</td>
                                    <td class="text-center">{{ $item->course->duration }} Week</td>
                                    <td class="text-end">${{ $item->course->price }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
