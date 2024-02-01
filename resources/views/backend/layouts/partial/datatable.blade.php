@push('js')
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/b-print-1.6.1/rr-1.2.6/datatables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#clientSideDataTable').DataTable({
                responsive: true,
                processing: true,
                language: {
                    'url':"{{asset('backend/Arabic.json')}}",
                    'loadingRecords': '&nbsp;',
                    'processing': '<div class="spinner"></div>',

                },
                bPaginate: false,
                    info: false,
                    paging: false
            });
            function updateTotals() {
                var finalTotal = 0;
                var totalPaid = 0;
                var discountsTotal = 0;
                var additionsTotal = 0;
                var remainingTotal = 0;

                table.rows().every(function() {
                    var data = this.data();

                    finalTotal += parseFloat(data[8]);
                    totalPaid += parseFloat(data[9]);
                    discountsTotal += parseFloat(data[10]);
                    additionsTotal += parseFloat(data[11]);
                    remainingTotal += parseFloat(data[12]);
                });

                $('#finalTotal').text(finalTotal.toFixed(2));
                $('#totalPaid').text(totalPaid.toFixed(2));
                $('#discountsTotal').text(discountsTotal.toFixed(2));
                $('#additionsTotal').text(additionsTotal.toFixed(2));
                $('#remainingTotal').text(remainingTotal.toFixed(2));
            }


            updateTotals();

            table.on('draw', function() {
                updateTotals();
            });
        } );

     
</script>
@endpush
