<?php
    use App\Http\Controllers\Controller;
    use App\Http\Controllers\Dashboard\ProductController;
    use App\Models\Product;
    $mainCategories =  Controller::mainCategories();
    $itemCount =  ProductController::countItem();


?>

<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +01552923438</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> mustafa.salama2608@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ url('/') }}"><img src="{{ asset('front/') }}/images/home/logo.png" alt="" /></a>
                    </div>

                </div>
                    <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            @auth
                            <li><a href="{{ url('/orders') }}"><i class="fa fa-crosshairs"></i> orders</a></li>
                            <li>
                                <a href="{{ route('favorite_products') }}" id="fav">
                                    <i class="fa fa-heart"></i>
                                    Favorite ( {{ App\Models\Favorite::count() }} )
                                </a>
                            </li>
                             <li>
                                 <a href="{{ url('/cart') }}" >
                                    <i class="fa fa-shopping-cart"></i> ({{ $itemCount }})
                                </a>
                            </li>

                            <li><a href="{{ url('/account') }}"><i class="fa fa-user"></i> Account </a></li>
                            <li><a href="{{ url('front/logout') }}"><i class="fa fa-sign-out fa-lg"></i> Logout </a></li>
                            @else
                            <li><a href="{{ url('front/login') }}"><i class="fa fa-lock"></i> Login</a></li>
                            @endauth

                        </ul>
                    </div>
                    </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{ asset('/') }}" class="active">Home</a></li>
                            <li class="dropdown"><a href="#">Categories<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach($mainCategories as $cat)
                                        @if($cat->status == 'active')
                                        <li><a href="{{ asset('products/'.$cat->url) }}">{{ $cat->name }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                             <li><a href="{{ url('contact-page') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form action="{{ route('search-product') }}" method="POST">
                            @csrf
                            <input type="text" placeholder="Search Product" name="product"/>
                            <button type="submit">Go</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
