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
    </script>
@endpush
