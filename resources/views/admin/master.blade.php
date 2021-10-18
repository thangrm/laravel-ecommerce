<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset('backend/images/logo.png') }}">

    <title>Ecommerce Admin - Dashboard</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

<div class="wrapper">

@include('admin.body.header')

<!-- Left side column. contains the logo and sidebar -->
@include('admin.body.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('admin')
    </div>

    <!-- /.content-wrapper -->
    @include('admin.body.footer')

</div>
<!-- ./wrapper -->


<!-- Vendor JS -->
<script src="{{ asset('backend/js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('backend/js/pages/data-table.js') }}"></script>

<!-- RM Admin App -->
<script src="{{ asset('backend/js/template.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript" ></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    @if(Session::has('message'))
    let type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
@yield('js')
</body>
</html>
