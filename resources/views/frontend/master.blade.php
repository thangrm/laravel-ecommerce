<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css')}}">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->

@include('frontend.body.header')

<!-- ============================================== HEADER : END ============================================== -->

@yield('content')
@include('frontend.common.product_modal')

<!-- ============================================================= FOOTER ============================================================= -->

@include('frontend.body.footer')

<!-- ============================================================= FOOTER : END============================================================= -->

<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
{{--<script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>--}}
<script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript" ></script>
<script>
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

    function productView(id){
        $.ajax({
            url: '{{ url('ajax/product') }}'+'/'+id,
            type: "GET",
            success: function (data){
                let hostUrl = '{{asset('')}}';
                data = JSON.parse(data);
                let price;
                if(data.discount_price != null){
                    price = data.discount_price;
                }else{
                    price = data.selling_price;
                }

                let checkClassification = false;
                let htmlClassification =  '<option value="">--Select options--</option>';
                data.classification.forEach(el => {
                    htmlClassification += `<option value="${el.id}">${el.name}</option>`;
                    checkClassification = true;
                });

                $('#pImage').attr('src',hostUrl+data.product_thumbnail)
                $('#pName').text(data.product_name);
                $('#pCode').text(data.product_code);
                $('#price').text(price.toLocaleString() + ' ₫');
                $('#pCategory').text(data.sub_sub_category.subsubcategory_name);
                $('#pBrand').text(data.brand.brand_name);
                if(checkClassification){
                    $('#optionClassification').show();
                    $('#classificationProductModal').html(htmlClassification);
                }else{
                    $('#classificationProductModal').html('');
                    $('#optionClassification').hide();
                }

            }
        });
    }

    $('#classificationProductModal').on('change',function (e){
        let id = $('#classificationProductModal').val();
        $.ajax({
            url: '{{ url('ajax/classification') }}'+'/'+id,
            type: "GET",
            success: function (data){
                data = JSON.parse(data)
                $('#pStock').html(data['quantity']);
            }
        });
    });
</script>
@yield('script')
</body>
</html>