@push('scripts')
    <script type="text/javascript">
        function initializeSnap() {
            var snapToken = '{{ $snapToken }}';

            if (typeof window.snap !== 'undefined' && snapToken) {
                var payButton = document.getElementById('pay-button');

                payButton.addEventListener('click', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('snap-modal'));
                    myModal.show();

                    window.snap.embed(snapToken, {
                        embedId: 'snap-container',
                        onSuccess: function(result) {
                            const bank = result.bank ? result.bank.toUpperCase() : 'N/A';
                            const paymentType = result.payment_type ? result.payment_type.replace(/_/g,
                                ' ').replace(/\b\w/g, char => char.toUpperCase()) : 'N/A';

                            const formattedPaymentMethod = `${bank} - ${paymentType}`;
                            const accountNumber = result.masked_card ? result.masked_card : 'N/A';

                            Swal.fire({
                                icon: 'success',
                                title: 'Payment Successful!',
                                text: 'Your payment has been processed successfully.',
                                confirmButtonColor: '#0F345E',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById("formInsert").submit();

                                    const formData = new FormData();
                                    formData.append('payment_method', formattedPaymentMethod);
                                    formData.append('account_number', accountNumber);

                                    $.ajax({
                                        url: $('#formInsert').attr('action'),
                                        type: 'POST',
                                        dataType: 'json',
                                        data: formData,
                                        contentType: false,
                                        processData: false,
                                        success: function(response) {
                                            window.location.href =
                                                `{{ url('/order-payment') }}`;
                                        },
                                        error: function(xhr) {
                                            window.location.href =
                                                `{{ url('/order-payment') }}`;
                                        }
                                    });
                                }
                            });
                        },
                        onPending: function(result) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Waiting for Payment!',
                                text: 'Your payment is still pending.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#0F345E'
                            });
                        },
                        onError: function(result) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Payment Failed!',
                                text: 'There was an error processing your payment.',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#0F345E'
                            });
                        }
                    });
                });
            } else {}
        }

        document.addEventListener('DOMContentLoaded', function() {
            try {
                initializeSnap();
            } catch (error) {}
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
