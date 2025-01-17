@if (session('message'))
    <script>
        // Contoh penggunaan:
        $(document).ready(function() {
            const alertType = '{{ session('alert-type') }}';
            const message = '{{ session('message') }}';

            if (alertType && message) {
                showAlert(alertType, message);
            }
        });
    </script>
@endif
