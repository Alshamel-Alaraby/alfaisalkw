@push('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/b-print-1.6.1/rr-1.2.6/datatables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#clientSideDataTable').DataTable({
                responsive: true,
                processing: true,
                language: {
                    'url':"{{asset('backend/Arabic.json')}}",
                    'loadingRecords': '&nbsp;',
                    'processing': '<div class="spinner"></div>'
                }
            });
        } );
    </script>
@endpush
