<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> @if(!empty($meta_title)){{ $meta_title }}@else Home | Shopper @endif </title>
    @if(!empty($meta_description))
    <meta name="description" content="{{ $meta_description }}">@endif
    @if(!empty($meta_keywords))
    <meta name="keywords" content="{{ $meta_keywords }}">@endif
    <link href="{{ asset('front/') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('front/') }}/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('front/') }}/css/prettyPhoto.css" rel="stylesheet">
    <link href="{{ asset('front/') }}/css/price-range.css" rel="stylesheet">
    <link href="{{ asset('front/') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('front/') }}/css/main.css" rel="stylesheet">
    <link href="{{ asset('front/') }}/css/responsive.css" rel="stylesheet">


    <!-- noty -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/noty/noty.css')}}">
    <script src="{{ asset('admin/plugins/noty/noty.min.js')}}"></script>

    <link rel="shortcut icon" href="{{ asset('front/') }}/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ asset('front/') }}/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ asset('front/') }}/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ asset('front/') }}/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed"
        href="{{ asset('front/') }}/images/ico/apple-touch-icon-57-precomposed.png">
    @stack('css')
</head>
<!--/head-->

<body>

    @include('front.includes._header')

    @include('front.includes._sessions')
    @yield('content')
    @include('front.includes._footer')


    <script src="{{ asset('front/') }}/js/jquery.js"></script>
    <script src="{{ asset('front/') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('front/') }}/js/jquery.scrollUp.min.js"></script>
    <script src="{{ asset('front/') }}/js/price-range.js"></script>
    <script src="{{ asset('front/') }}/js/jquery.prettyPhoto.js"></script>
    <script src="{{ asset('front/') }}/js/main.js"></script>
    <script src="{{ asset('front/js/jquery.validate.js') }}"></script>
    <script>




        $(function () {
        $(document).on('click', '.favClass i', function (event) {

            event.preventDefault()

            var id = $(this).data('id');

            var url = $(this).data('url');

            var method = $(this).data('method');

            var thisSpan = $(this);
            $.ajax({
                type: method,
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function (data) {

                    // console.log(data.count);
                   thisSpan.toggleClass('fa-heart');
                   thisSpan.toggleClass('fa-heart-o');
                   $('#fav').html('').append('<i class="fa fa-heart"> </i> Favorite ( ' +data.count+' ) ');


                    // var is_favorite = data.data.is_favorite;
                    // event = event || window.event; // IE
                    // var target = event.target || event.srcElement; // IE
                    // var id = target.id;
                    // $('.test').each(function () {
                    //     console.log($(this).find(".icon-" + id))
                    //     $(this).find(".icon-" + id).toggleClass('fa-heart');
                    //     $(this).find(".icon-" + id).toggleClass('fa-heart-o');
                    //     if(is_favorite == 1){
                    //         $(this).find(".icon-" + id).addClass('fa-heart').removeClass('fa-heart-o');
                    //     }else{
                    //         $(this).find(".icon-" + id).addClass('fa-heart-o').removeClass('fa-heart');
                    //     }
                    // });
                }

            });
        });


    });
    </script>
    @stack('js')

</body>

</html>
