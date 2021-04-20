@extends('layouts.site')

@section('content')


<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-3">
                @include('front.includes.sidebar')
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img class="mainImage" src="{{ $productDetails->cover_path }}" alt="" />
                            <h3>ZOOM</h3>
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    @foreach($productAltImages as $img)
                                    <img class="alterImage" style="width: 80px;cursor:pointer"
                                        src="{{$img->image_path}}" alt="">
                                    @endforeach
                                </div>


                            </div>


                        </div>

                    </div>
                    <div class="col-sm-7">

                        <form name="addtoCartForm" id="addtoCartForm" action="{{ route('product.add-cart') }}"
                            method="post">{{ csrf_field() }}
                            <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                            {{-- <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> --}}
                            {{-- <input type="hidden" name="user_email" value="{{ auth()->user()->email }}"> --}}
                            <input type="hidden" name="name" value="{{ $productDetails->name }}">
                            <input type="hidden" name="code" value="{{ $productDetails->code }}">
                            <input type="hidden" name="color" value="{{ $productDetails->color }}">
                            <input type="hidden" name="price" id="price" value="{{ $productDetails->price }}">
                            <div class="product-information">
                                <!--/product-information-->
                                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                                <h2> {{ $productDetails->name }}</h2>
                                <p>Code : {{ $productDetails->code }}</p>
                                <p>
                                    <select id="selSize" name="size" style="width:150px;" required>
                                        <option value="">Select</option>
                                        @foreach($productDetails->transactions as $sizes)
                                        <option class="change_price" data-id="{{ $sizes->id }}"
                                            data-url="{{ url('products_details/change-price') }}" data-method="GET"
                                            value="{{ $sizes->size }}">{{ $sizes->size }}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <img src="images/product-details/rating.png" alt="" />
                                <span>
                                    <span id="price_color{{ $productDetails->id }}">${{ $productDetails->price }}</span>
                                    @if($total_stock>0)

                                    <label>Quantity:</label>
                                    <input type="text" class="qty" name="quantity" value="1" />
                                    <button type="submit" class="btn btn-default cart" id="cartButton">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                    @endif

                                </span>
                                <input type="hidden" id="hid" value="" attr="">
                                <p><b>Availability: </b><span id="Availability"> @if($total_stock>0) In Stock @else Out
                                        Of Stock @endif</span></p>
                                <p><b>Condition:</b> New</p>
                                <a href=""><img src="images/product-details/share.png" class="share img-responsive"
                                        alt="" /></a>
                            </div>
                            <!--/product-information-->
                        </form>

                    </div>
                </div>
                <!--/product-details-->

                <div class="category-tab shop-details-tab">
                    <!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                            <li><a href="#care" data-toggle="tab">Material</a></li>
                            <li><a href="#delivery" data-toggle="tab">Delivery Option</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="description">
                            <div class="col-sm-12">
                                <p>{{ $productDetails->description }}</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="care">
                            <div class="col-sm-12">
                                <p>{{ $productDetails->care }}</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="delivery">
                            <div class="col-sm-12">
                                <p>100% Original Products <br>
                                    Cash on delivery might be available</p>
                            </div>
                        </div>


                    </div>
                </div>
                <!--/category-tab-->


                <div class="recommended_items">
                    <!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php $count=1; ?>
                            @foreach($relatedProducts->chunk(3) as $chunk)

                            <div <?php if($count==1){ ?> class="item active" <?php } else { ?> class="item" <?php } ?>>
                                @foreach($chunk as $item)

                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img style="height: 250px;width:200px" src="{{ $item->cover_path }}"
                                                    alt="" />
                                                <h2>$ {{ $item->price }}</h2>
                                                <p>{{ $item->name }}</p>
                                                <a href="{{ url('/product/'.$item->id) }}"><button type="button"
                                                        class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <?php $count++; ?>
                            @endforeach
                        </div>

                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <!--/recommended_items-->

            </div>
        </div>
    </div>
</section>

@endsection

@push('js')

<script>
    $(function () {
        $(document).on('click', '.change_price', function (e) {

            e.preventDefault();
            var id = $(this).data('id');
            var url = $(this).data('url');
            var method = $(this).data('method');
            $.ajax({
                type: method,
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function (data) {


                    var total_stock = data.data.stock;

                    // $qty = $('.qty').val();
                    jQuery('.qty').keyup(function () {

                        var val = this.value;
                        if (val > total_stock) {
                            $('#cartButton').hide();
                            $('#Availability').text('out of stock');
                        } else {
                            $('#cartButton').show();
                            $('#Availability').text('in stock');
                        }
                    });

                    if (total_stock == 0) {
                        $('#cartButton').hide();
                        $('#Availability').text('out of stock');
                    } else {

                        $('#cartButton').show();
                        $('#Availability').text('in stock');

                    }
                    var price = parseInt(data.data.price);
                    $("#price_color" + data.data.product_id).html('');
                    $("#price_color" + data.data.product_id).html('$' + price);
                    $("#price").val(price);

                }

            });
        });

        $(document).on('click', '.alterImage', function (e) {
            e.preventDefault();
            var attrImg = $(this).attr('src');
            $('.mainImage').attr('src', attrImg);
            // alert($attrImg);

        });
    });

</script>

@endpush
