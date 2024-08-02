@push('scripts')
    <script>
        $(document).ready(() => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#btn-disabled').on('click', function(event) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Quota Full',
                    text: 'Sorry, the quota is full. Please choose another option.',
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#0F345E',
                    reverseButtons: true
                });
            });

            $('#btn-checkout').on('click', function(e) {
                e.preventDefault();

                var form = $('#formInsert')[0];
                var formData = new FormData(form);

                Swal.fire({
                    icon: 'question',
                    title: 'Confirm Checkout',
                    text: 'Are you sure you want to proceed with the checkout for this course? Please ensure all the details are correct before confirming.',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, I am sure',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#0F345E',
                    cancelButtonColor: '#BB1F26',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ url('/courses') }}`,
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Checkout is successfully',
                                    icon: 'success',
                                    confirmButtonColor: '#0F345E',
                                }).then((result) => {
                                    window.location.href =
                                        `{{ url('/order-payment') }}`;
                                });
                            },
                            error: function(xhr) {
                                if (xhr.status === 422) {
                                    var errors = xhr.responseJSON.errors;
                                    var errorMessage = '';

                                    for (var key in errors) {
                                        errorMessage += errors[key][0] + '\n';
                                    }

                                    Swal.fire({
                                        title: 'Validation Error',
                                        text: errorMessage,
                                        icon: 'error',
                                        confirmButtonColor: '#0F345E',
                                    });
                                } else if (xhr.status === 400) {
                                    Swal.fire({
                                        title: 'Failed',
                                        text: 'You cannot proceed with checkout because you have an existing unpaid order.',
                                        icon: 'warning',
                                        confirmButtonColor: '#0F345E',
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Failed',
                                        text: 'Failed to checkout course',
                                        icon: 'error',
                                        confirmButtonColor: '#0F345E',
                                    });
                                }
                            }
                        });
                    }
                });

            });

            $('#basic-datatables').on('click', '.deleteButton', function(e) {
                e.preventDefault();

                var itemId = $(this).closest('form').find('input[name="id"]').val();
                var form = $(this).closest('form');

                Swal.fire({
                    icon: 'question',
                    title: 'Konfirmasi Hapus?',
                    text: "Apakah anda yakin ingin menghapus item ini!",
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#0F345E',
                    cancelButtonColor: '#BB1F26',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                _method: 'DELETE',
                                item_id: itemId
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Berhasil',
                                    text: 'Hapus data berhasil',
                                    icon: 'success',
                                    confirmButtonColor: '#0F345E',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                if (xhr.status === 422) {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Maaf, data tidak dapat dihapus karena sedang digunakan oleh data lainnya',
                                        icon: 'warning',
                                        confirmButtonColor: '#0F345E',
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Hapus data gagal',
                                        icon: 'error',
                                        confirmButtonColor: '#0F345E',
                                    });
                                }
                            }

                        });
                    }
                });
            });
        });
    </script>
@endpush
