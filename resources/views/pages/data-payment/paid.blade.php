<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-hover">
                        <thead>
                            <tr>
                                <th class="text-start">No</th>
                                <th class="text-start">Course</th>
                                <th class="text-start">User</th>
                                <th class="text-start">Transaction Code</th>
                                <th class="text-center">Payment Status</th>
                                <th class="text-start">Payment Method</th>
                                <th class="text-start">Account Number</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Payment Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPaid as $item)
                                <tr>
                                    <td class="text-start">{{ $loop->iteration }}</td>
                                    <td class="text-start">{{ Str::limit($item->course->title, 20) }}</td>
                                    <td class="text-start">{{ $item->user->name }}</td>
                                    <td class="text-start">{{ $item->transaction_code }}</td>
                                    <td class="text-center">{{ $item->status }}</td>
                                    <td class="text-start">{{ $item->payment_method }}</td>
                                    <td class="text-start">{{ $item->account_number }}</td>
                                    <td class="text-end">${{ $item->course->price }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <a href="{{ url('data-course/' . encrypt($item->id)) }}" target="_blank"
                                                class="btn btn-icon btn-round btn-primary btn-md me-3">
                                                <i class="fa fa-eye text-white"></i>
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
