    <!-- jQuery -->
    <script src="{{ asset('public/frontend/assets/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('public/frontend/assets/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('public/frontend/assets/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ asset('public/frontend/assets/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('public/frontend/assets/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('public/frontend/assets/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('public/frontend/assets/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{ asset('public/frontend/assets/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{ asset('public/frontend/assets/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{ asset('public/frontend/assets/Flot/jquery.flot.js')}}"></script>
    <script src="{{ asset('public/frontend/assets/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{ asset('public/frontend/assets/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{ asset('public/frontend/assets/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{ asset('public/frontend/assets/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('public/frontend/assets/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{ asset('public/frontend/assets/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{ asset('public/frontend/assets/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{ asset('public/frontend/assets/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('public/frontend/assets/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{ asset('public/frontend/assets/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{ asset('public/frontend/assets/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('public/frontend/assets/moment/min/moment.min.js')}}"></script>
    <script src="{{ asset('public/frontend/assets/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('public/frontend/assets/build/js/custom.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('public/backend/assets/js/dropify/js/dropify.min.js') }}"></script>
    <script>
        $(".dropify").dropify();
    </script>
    <script>
        @if (Session::has('Message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
            case 'info':
            toastr.info("{{ Session::get('Message') }}");
            break;

            case 'warning':
            toastr.warning("{{ Session::get('Message') }}");
            break;

            case 'success':
            toastr.success("{{ Session::get('Message') }}");
            break;

            case 'error':
            toastr.error("{{ Session::get('Message') }}");
            break;
            }
        @endif
    </script>

<!-- Datatables -->
<script src="{{ asset('public/frontend/assets/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/frontend/assets/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('public/frontend/assets/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('public/frontend/assets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{ asset('public/frontend/assets/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('public/frontend/assets/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('public/frontend/assets/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('public/frontend/assets/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{ asset('public/frontend/assets/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{ asset('public/frontend/assets/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('public/frontend/assets/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{ asset('public/frontend/assets/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
<script src="{{ asset('public/frontend/assets/jszip/dist/jszip.min.js')}}"></script>
<script src="{{ asset('public/frontend/assets/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{ asset('public/frontend/assets/pdfmake/build/vfs_fonts.js')}}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
    $('.show_confirm').click(function(event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: "Are you sure you want to delete this record?",
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
        });
    });
</script>
