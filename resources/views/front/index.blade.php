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
                    <h2 class="title text-center">Features Item</h2>
                    @foreach($products as $index => $product)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper test ">
                            <div class="single-products ">
                                <div class="productinfo text-center">
                                    <img src="{{ $product->cover_path }}" alt="" style="width: 300px;height:300px"
                                        class="img-responsive" />

                                    <h2>${{ $product->price }}</h2>
                                    <p>{{ $product->name }}</p>
                                    {{-- <form action=""> --}}
                                    <span id="fill" style="display: block;margin-bottom:10px;" class="favClass">

                                        <i class="fa {{ $product->fav ? 'fa-heart' : 'fa-heart-o' }}  icon-{{ $product->id }}"
                                            data-method="POST" data-id={{ $product->id }}
                                            data-url="{{ route('favorite',$product->id)}}" id="{{$product->id}}"></i>
                                    </span>
                                    {{-- </form> --}}
                                    <a href="{{ url('/product/'.$product->id) }}" style="display: block"
                                        class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                                        cart</a>
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
                    {{-- @if($index == 2) @break @endif --}}
                    @endforeach
                    <div align="center">{{ $products->links() }}</div>


                </div>

            </div>
        </div>
    </div>
</section>

@endsection
@push('js')

<script>


</script>
@endpush
