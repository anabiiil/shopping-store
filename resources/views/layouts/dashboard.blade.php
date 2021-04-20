<!DOCTYPE html>
<html>

<head>
    <meta name="description"
        content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description"
        content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Vali Admin - Free Bootstrap 4 Admin Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/')}}/css/main.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="{{ asset('admin/') }}/js/jquery-3.3.1.min.js"></script>

    <!-- noty -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/noty/noty.css')}}">
    <script src="{{ asset('admin/plugins/noty/noty.min.js')}}"></script>
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .dt-buttons button {
            background: #1c4e80;
            margin: 0 10px 13px;
            border-radius: 7px;
            border: 0;
        }
        #datatable_length{
            position: relative;
            top: 34px;
            width: 50%;
        }

    </style>

    @stack('css')
</head>

<body class="app sidebar-mini">

    <!-- Navbar-->
    @include('dashboard.includes._header')
    <!-- Sidebar menu-->
    @include('dashboard.includes._aside')

    <main class="app-content">
        @include('dashboard.includes._sessions')
        @yield('content')
    </main>





    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('admin/') }}/js/popper.min.js"></script>
    <script src="{{ asset('admin/') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin/') }}/js/main.js"></script>
    <!-- Data table plugin-->

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $('#datatable').DataTable({
            "lengthMenu": [5, 10, 20, 40, 80, 100 ],
            dom: 'Blfrtip',
            buttons: [{
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                },

                {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>Pdf',

                }, {
                    extend: 'csv',
                    text: '<i class="fa fa-file"></i>Csv',
                },
                {
                    extend: 'copy',
                    text: '<i class="icon-clipboard "></i>Copy',
                },
            ]
        });

    </script>
    {{--select 2--}}
    <script src="{{ asset('admin/js/plugins/select2.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('admin/js/jquery.validate.js') }}"></script>


    <script>
        $(function () {
            $("#expiry_date").datepicker({
                minDate: 0,
                dateFormat: 'yy-mm-dd',
                isRTL: true
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {

            //delete
            $('.delete').click(function (e) {

                var that = $(this)

                e.preventDefault();

                var n = new Noty({
                    text: "Confirm deleting record",
                    type: "warning",
                    killer: true,
                    buttons: [
                        Noty.button("Yes", 'btn btn-success mr-2', function () {
                            that.closest('form').submit();
                        }),

                        Noty.button("No", 'btn btn-primary mr-2', function () {
                            n.close();
                        })
                    ]
                });

                n.show();

            }); //end of delete

            //image preview
            $(".image").change(function () {

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.image-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                }

            });


        }); //end of document ready


        // add more row
        $(document).ready(function () {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = `<div class="controls field_wrapper" style="margin: 5px 0px 5px 0px;">
                <div class="row">
        <input type="text" placeholder="Size" class="form-control col-md-2" name="size[]" style="width:15%"/>&nbsp;
        <input type="number" placeholder=" Price" class="form-control col-md-2" name="price[]" style="width:15%"/>&nbsp;
        <input type="number" placeholder="Stock" class="form-control col-md-2" name="stock[]"
        style="width:15%"/>
        <input type="text" placeholder="sku" class="form-control col-md-2" name="sku[]" style="width:15%"/>&nbsp;
        <a href="javascript:void(0);"
        class="remove_button" style="text-decoration: none;
        width: 160px;
        height: auto;
        background: #153b61;
        color: #f2f2f2;
        text-align: center;
        line-height: -2px;
        margin-left: 5px;
        border-radius: 5px;
        padding-top: 6px;" title="Remove field"> Delete Row</a>
        </div>
        </div>`;

            var x = 1; //Initial field counter is 1
            $(addButton).click(function () { //Once add button is clicked
                if (x < maxField) { //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                }
            });
            $(wrapper).on('click', '.remove_button', function (e) { //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });

        // ./add more row

        //select2
        $('.select2').select2({
            'width': '100%'
        });

    </script>

    @stack('js')

</body>

</html>
