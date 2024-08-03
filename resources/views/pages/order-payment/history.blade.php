<div class="table-responsive">
    <table id="basic-datatables" class="display table table-hover">
        <thead>
            <tr>
                <th class="text-start">No</th>
                <th class="text-start">Course</th>
                <th class="text-start">Transaction Code</th>
                <th class="text-center">Payment Status</th>
                <th class="text-start">Payment Method</th>
                <th class="text-start">Account Number</th>
                <th class="text-center">Price</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($history as $item)
                <tr>
                    <td class="text-start">{{ $loop->iteration }}</td>
                    <td class="text-start">{{ Str::limit($item->course->title, 20) }}</td>
                    <td class="text-start">{{ $item->transaction_code }}</td>
                    <td class="text-center">{{ $item->status }}</td>
                    <td class="text-start">{{ $item->payment_method }}</td>
                    <td class="text-start">{{ $item->account_number }}</td>
                    <td class="text-end">${{ $item->course->price }}</td>
                    <td class="text-center">
                        <div class="form-button-action">
                            <a href="{{ url('courses/' . encrypt($item->id)) }}"
                                class="btn btn-icon btn-round btn-primary btn-md me-3">
                                <i class="fa fa-eye text-white"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr></tr>
                <th class="text-end fw-bold" colspan="6">Result All</th>
                <th class="text-end">${{ $totalPrice }}</th>
                <th class="text-center"></th>
            </tr>
        </tfoot>
    </table>
</div>
