    <!-- jquery latest version -->
    <script src="{{ asset('public/backend/assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ asset('public/backend/assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('public/backend/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('public/backend/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('public/backend/assets/js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('public/backend/assets/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('public/backend/assets/js/jquery.slicknav.min.js')}}"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="{{ asset('public/backend/assets/js/line-chart.js')}}"></script>
    <!-- all pie chart -->
    <script src="{{ asset('public/backend/assets/js/pie-chart.js')}}"></script>
    <!-- others plugins -->
    <script src="{{ asset('public/backend/assets/js/plugins.js')}}"></script>
    <script src="{{ asset('public/backend/assets/js/scripts.js')}}"></script>
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>



    {{-- toastr cdn link --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{asset('public/backend/assets/select/js/select2.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/js/parsley.min.js')}}"></script>
    <script src="{{asset('public/backend/assets/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 100
            });
        });
    </script>
    <script src="{{ asset('public/backend/assets/js/dropify/js/dropify.min.js') }}"></script>
    <script>
        $(".dropify").dropify();
    </script>

    <script>
        $(document).ready(function() {
            $('#dataTable3').DataTable({
                "pageLength": 50,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $('#form').parsley().on('field:validated', function() {
                    var ok = $('.parsley-error').length === 0;
                    $('.bs-callout-info').toggleClass('hidden', !ok);
                    $('.bs-callout-warning').toggleClass('hidden', ok);
                })
                .on('form:submit', function() {
                    return true;
                });
        });
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


