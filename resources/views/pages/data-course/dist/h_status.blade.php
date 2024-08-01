@push('scripts')
    <script>
        $(document).ready(function() {
            $('#basic-datatables').on('click', '#btn-status', function(e) {
                e.preventDefault();

                var itemId = $(this).data('id');
                var form = $(this).closest('form');

                console.log(itemId);

                Swal.fire({
                    icon: 'question',
                    title: 'Confirm Status Update?',
                    text: "Are you sure you want to change the status of this item?",
                    showCancelButton: true,
                    confirmButtonText: 'Yes, update!',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#0F345E',
                    cancelButtonColor: '#BB1F26',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ url('/data-course') }}/${itemId}/update-status`,
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Data updated successfully',
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
                                        title: 'Failed',
                                        text: 'Sorry, the data cannot be updated because it is being used by other data',
                                        icon: 'warning',
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
