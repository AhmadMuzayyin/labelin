<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('template/backend/assets/js/vendor.min.js') }}" type="ac4260cbb75c0f083a46ae98-text/javascript"> </script>
<script src="{{ asset('template/backend/assets/js/app.min.js') }}" type="ac4260cbb75c0f083a46ae98-text/javascript"></script>
<script src="{{ asset('template/backend/assets/rocket-loader.min.js') }}"
    data-cf-settings="ac4260cbb75c0f083a46ae98-|49" defer=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-lib').select2();
    });

    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    // $(document).ready(function() {
    //     selesai();
    // });

    // function selesai() {
    //         setTimeout(function() {
    //             jumlah();
    //             selesai();
    //             pesan();
    //         }, 500);
    //     }

    // function jumlah() {
    //     $.getJSON("/panel/jmlNotif/", function(datas) {
    //         $("#jml_notif").html(datas);
    //     });
    // }
</script>
