@extends('layouts.site')

@section('content')


@include('front.includes.slider')


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
                        @if(!empty($search_product))
                        Item
                        {{ $search_product }}
                        @else
                        Items
                        {{ $categoryDetails->name }}
                        @endif
                        ({{ count($productsAll) }})

                    </h2>
                    @foreach($productsAll as $pro)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ $pro->cover_path }}" alt="" style="width: 300px;height:300px"
                                        class="img-responsive" />

                                    <h2>${{  $pro->price}}</h2>
                                    <p>{{ $pro->name }}</p>
                                    <a href="{{ url('/products/'.$pro->id) }}" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>${{ $pro->price }}</h2>
                                        <p>{{ $pro->name }}</p>
                                        <a href="{{ url('/product/'.$pro->id) }}" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                                <span id="fill" style="display: block;margin-bottom:10px;" class="favClass">

                                                    <i class="fa {{ $pro->fav ? 'fa-heart' : 'fa-heart-o' }}"  data-method="POST"
                                                         data-url="{{ route('favorite',$pro->id)}}"
                                                        ></i>
                                                </span>
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
                    @if(empty($search_product))
                    <div align="center">{{ $productsAll->links() }}</div>
                    @endif

                </div>
                <!--features_items-->

            </div>
        </div>
    </div>
</section>


@endsection
