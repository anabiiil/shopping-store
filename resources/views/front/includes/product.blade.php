<!-- new-products -->

 <div class="new-products">
    <div class="container">
        <h3>New Product</h3>
        <div class="agileinfo_new_products_grids">
            @foreach($products as $index => $product)
                <div class="col-md-3 agileinfo_new_products_grid">
                    <div class="agile_ecommerce_tab_left agileinfo_new_products_grid1">
                        <div class="hs-wrapper hs-wrapper1">

                            @foreach($product->images as  $image)
                                <img src="{{ $image->image_path }}" alt=" " style="height: 100%" class="img-responsive" />
                            @endforeach

                            <div class="w3_hs_bottom w3_hs_bottom_sub">
                                <ul>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#myModal{{ $product->id }}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                            <h5><a href="single.html">  {{ $product->name }}</a></h5>
                            @php
                                $prices = $product->transactions->pluck('sale_price')->toArray();
                                $price = min(...$prices);
                            @endphp
                            <div class="simpleCart_shelfItem">
                                <p><span>${{ $price }}</span> <i class="item_price">${{ $price - $product->discount }}</i></p>
                                <p><a class="item_add" href="#">Add to cart</a></p>
                            </div>

                    </div>
                </div>

                <div class="modal video-modal fade" id="myModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="myModal{{ $product->id }}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <section>
                                <div class="modal-body">
                                    <div class="col-md-5 modal_body_left">
                                        <img src="{{ $product->images->first()->image_path }}" alt=" " class="img-responsive" />
                                    </div>
                                    <div class="col-md-7 modal_body_right">
                                        <h4>a good look women's {{ $product->name }}</h4>
                                        <p>Ut enim ad minim veniam, quis nostrud
                                            exercitation ullamco laboris nisi ut aliquip ex ea
                                            commodo consequat.Duis aute irure dolor in
                                            reprehenderit in voluptate velit esse cillum dolore
                                            eu fugiat nulla pariatur. Excepteur sint occaecat
                                            cupidatat non proident, sunt in culpa qui officia
                                            deserunt mollit anim id est laborum.</p>
                                        <div class="rating">
                                            <div class="clearfix"> </div>
                                        </div>
                                        <div class="modal_body_right_cart simpleCart_shelfItem">
                                            <p>
                                                <span id="price_color{{ $product->id }}">
                                                    ${{ $price  }}
                                                </span>

                                                <i class="item_price" id="discount_color{{ $product->id }}">
                                                    ${{ $price - $product->discount }}
                                                </i>
                                            </p>
                                            <p><a class="item_add" href="#">Add to cart</a></p>
                                        </div>
                                        <h4>colors</h4>
                                        <div class="color-quality">
                                            <ul style="margin-top: 25px">
                                                @foreach($product->transactions as $color)
                                                    <li id="color-ajax">
                                                        <a class="change_color"

                                                        data-url="{{ url('products/change-price') }}"
                                                        data-id="{{ $color->id }}"
                                                        data-method="GET"

                                                        style="font-weight: bold;font-size:18px;color:#000;" href="#">
                                                            <span class="color" style="background: {{ $color->code }}"></span>
                                                            {{ $color->color }}
                                                        </a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>


                @if($index == 3) @break @endif
            @endforeach
            <div class="clearfix"> </div>
        </div>
    </div>
</div>


@push('js')
<script>
    $(function(){
        $(document).on('click','.change_color', function(e) {

            e.preventDefault();
            var id = $(this).data('id');
            var url = $(this).data('url');
            var method = $(this).data('method');
            $.ajax({
                type: method,
                url:url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(data) {
                    var price = parseInt(data.data.sale_price);
                    $("#price_color"+data.data.product_id).html('');
                    $("#price_color"+data.data.product_id).html(price);


                    $("#discount_color"+data.data.product_id).html('');
                    $("#discount_color"+data.data.product_id).html(price - parseInt(data.discount.discount));
                }

            });
        });



    });

</script>
@endpush

