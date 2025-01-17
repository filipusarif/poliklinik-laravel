@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap5.css') }}">
    {{-- <style>
        .table td  {
            white-space: normal;
            word-wrap: break-word;
        }
        .table th {
            white-space: normal;
            word-wrap: break-word;
            vertical-align: middle;
        }
    </style> --}}
@endpush
@push('scripts')
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('.table', {
            "order": [[0, 'desc']] // Mengurutkan berdasarkan kolom pertama (0) secara menurun (desc)
        });
    </script>    
@endpush