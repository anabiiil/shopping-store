@extends('layouts.site')

@section('content')

@php
    use App\Models\Product;
@endphp

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @endif
            @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block" style="background-color:#f4d2d2">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
            @endif
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Product</td>
                        <td class="description"> Product Detailes</td>
                        <td class="price">Price</td>
                         <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $total_amount = 0; ?>
                    @foreach($userCart as $cart)

                    <tr>
                        <td class="cart_product">
                            <a href=""><img style="width:100px; height:100px;" src="{{ $cart->cover}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $cart->name }}</a></h4>
                            <p>Product Code: {{ $cart->code }}</p>
                            <p>Product size: {{ $cart->size }}</p>
                        </td>
                        <td class="cart_price">
                            <p>${{ $cart->price }}</p>
                            <?php $product_price = Product::getProductPrice($cart->product_id,$cart->size); ?>
                            {{-- <p>$ {{ $product_price }}</p> --}}
                         </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{ url('/cart/update-quantity/'.$cart->id.'/1') }}"> +
                                </a>
                                <input class="cart_quantity_input" type="text" name="quantity"
                                    value="{{ $cart->quantity }}" autocomplete="off" size="2">
                                @if($cart->quantity>1)
                                <a class="cart_quantity_down"
                                    href="{{ url('/cart/update-quantity/'.$cart->id.'/-1') }}"> - </a>
                                @endif
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">

                                ${{ $cart->price *$cart->quantity }}

                            </p>
                        </td>
                        <td class="cart_delete">
                            <form action="{{ url('/cart/delete-product/'.$cart->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="delete"><i class="fa fa-times"></i></button>
                            </form>

                        </td>
                    </tr>
                    <?php $total_amount = $total_amount + ($cart->price*$cart->quantity); ?>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
			<p>Choose if you have a coupon code you want to use.</p>
         </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <form action="{{ url('cart/apply-coupon') }}" method="post">{{ csrf_field() }}
                                <label>Coupone Code</label>
                                <input type="text" name="coupon_code">
                                <input type="submit" value="Apply" class="btn btn-default">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        @if(!empty(Session::get('CouponAmount')))
                        <li>Sub Total <span>$ <?php echo $total_amount; ?></span></li>
                        <li>Coupon Discount <span>$ <?php echo Session::get('CouponAmount'); ?></span></li>
                        <li>Grand Total <span>$ <?php echo $total_amount - Session::get('CouponAmount'); ?></span></li>
                        @else
                            <li>Grand Total <span>$ <?php echo $total_amount; ?></span></li>
                        @endif
                    </ul>
                     <a class="btn btn-default check_out" href="{{ url('/checkout-view') }}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->


@endsection

@push('js')
<script>
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

                    Noty.button("No", 'btn btn-danger', function () {
                        n.close();
                    })
                ]
            });

            n.show();

        }); //end of delete

    }); //end of document ready
</script>
@endpush
