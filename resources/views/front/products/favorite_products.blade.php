@extends('layouts.site')
@section('content')


<section>
    <div class="container">


        <div class="row">
            <div class="col-sm-3">
                @include('front.includes.sidebar')
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->

                    <h2 class="title text-center">
                        Favorite Products
                    </h2>
                    @if ($product_all->count() > 0)
                        @foreach($product_all as $fav)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{ $fav->cover_path }}" alt="" style="width: 300px;height:300px"
                                            class="img-responsive" />

                                        <h2>${{$fav->price}}</h2>
                                        <p>{{ $fav->name }}</p>
                                        <a href="{{ url('/products/'.$fav->id) }}" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{ $fav->price }}</h2>
                                            <p>{{ $fav->name }}</p>
                                            <a href="{{ url('/product/'.$fav->id) }}" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <h3 style="font-weight: 400;">There are no favorite products</h3>
                    @endif

                </div>
                <!--features_items-->

            </div>
        </div>
    </div>
</section>

@endsection
