@push('scripts')
    <script type="text/javascript">
        function initializeSnap() {
            var snapToken = '{{ $snapToken }}';

            if (typeof window.snap !== 'undefined' && snapToken) {
                var payButton = document.getElementById('pay-button');

                payButton.addEventListener('click', function() {
                    // Show the modal
                    var myModal = new bootstrap.Modal(document.getElementById('snap-modal'));
                    myModal.show();

                    // Embed Snap Midtrans in the modal
                    window.snap.embed(snapToken, {
                        embedId: 'snap-container',
                        onSuccess: function(result) {
                            alert("Payment success!");
                            console.log(result);
                        },
                        onPending: function(result) {
                            alert("Waiting for your payment!");
                            console.log(result);
                        },
                        onError: function(result) {
                            alert("Payment failed!");
                            console.log(result);
                        },
                        onClose: function() {
                            alert('You closed the popup without finishing the payment');
                        }
                    });
                });
            } else {
                console.error('Snap Midtrans library is not loaded or snapToken is missing.');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeSnap();
        });

        $(document).ready(() => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#btn-delete-checkout').on('click', function(e) {
                e.preventDefault();

                const itemId = $(this).closest('form').find('input[name="id"]').val();
                const form = $(this).closest('form');

                Swal.fire({
                    icon: 'question',
                    title: 'Confirm Deletion?',
                    text: "Are you sure you want to delete this item?",
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete!',
                    cancelButtonText: 'Cancel',
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
                                _method: 'POST',
                                item_id: itemId
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Item successfully deleted',
                                    icon: 'success',
                                    confirmButtonColor: '#0F345E'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                let errorMessage = 'Failed to delete item';
                                if (xhr.status === 422) {
                                    errorMessage =
                                        'Sorry, the data cannot be deleted because it is being used by other data';
                                }
                                Swal.fire({
                                    title: 'Failed',
                                    text: errorMessage,
                                    icon: 'error',
                                    confirmButtonColor: '#0F345E'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
