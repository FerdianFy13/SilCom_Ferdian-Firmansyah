@push('scripts')
    <script>
        $(document).ready(function() {
            $('#imageInput').change(function(event) {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#currentImagePreview').attr('src', e.target.result).show();
                        $('#imageInput').removeAttr('required');
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#currentImagePreview').attr('src', '').hide();
                    $('#imageInput').attr('required', 'required');
                }
            });

            $('#imageInputCourse').change(function(event) {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreviewCourseBanner').attr('src', e.target.result).show();
                        $('#imageInputCourse').removeAttr('required');
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#imagePreviewCourseBanner').attr('src', '').hide();
                    $('#imageInputCourse').attr('required', 'required');
                }
            });

            // Initialize display for existing images
            if ($('#currentImagePreview').attr('src') === "") {
                $('#currentImagePreview').hide();
                $('#imageInput').attr('required', 'required');
            }

            if ($('#imagePreviewCourseBanner').attr('src') === "") {
                $('#imagePreviewCourseBanner').hide();
                $('#imageInputCourse').attr('required', 'required');
            }
        });

        $(document).ready(() => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#formUpdate').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: 'Please make sure all the entered data is correct!',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, I’m sure',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#0F345E',
                    cancelButtonColor: '#BB1F26',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: $('#formUpdate').attr('action'),
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Data updated successfully',
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
                                        title: 'Invalid Input',
                                        text: errorMessage,
                                        icon: 'error',
                                        confirmButtonColor: '#0F345E',
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Failed',
                                        text: 'Failed to update data',
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
