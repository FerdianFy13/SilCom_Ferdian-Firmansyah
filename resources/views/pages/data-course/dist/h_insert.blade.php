@push('scripts')
    <script>
        $(document).ready(function() {
            $('#imageInput').change(function(event) {
                const [file] = this.files;
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#imagePreview').hide();
                }
            });

            $('#imageInputCourse').change(function(event) {
                const [file] = this.files;
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreviewCourse').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#imagePreviewCourse').hide();
                }
            });
        });

        $(document).ready(() => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#formInsert').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: 'Make sure all the data entered is correct',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, I am sure',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#0F345E',
                    cancelButtonColor: '#BB1F26',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ url('/data-course') }}`,
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Data added successfully',
                                    icon: 'success',
                                    confirmButtonColor: '#0F345E',
                                }).then((result) => {
                                    window.location.href =
                                        `{{ url('/data-course') }}`;
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
                                } else if (xhr.status === 423) {
                                    Swal.fire({
                                        title: 'Validation Error',
                                        text: 'Courier name is required',
                                        icon: 'error',
                                        confirmButtonColor: '#0F345E',
                                    });
                                } else if (xhr.status === 426) {
                                    Swal.fire({
                                        title: 'Failed',
                                        text: 'Sorry, sorted waste data for this month and year is already available',
                                        icon: 'warning',
                                        confirmButtonColor: '#0F345E',
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Failed',
                                        text: 'Failed to add data',
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
