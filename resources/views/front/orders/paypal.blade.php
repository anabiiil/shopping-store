@extends('layouts.site')
@section('content')
<?php use App\Models\Order; use App\Models\Country; ?>
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Thanks</li>
			</ol>
		</div>
	</div>
</section>

<section id="do_action">
	<div class="container">
		<div class="heading" style="text-align: center">
			<h3>YOUR ORDER HAS BEEN PLACED</h3>
            <p>Your order number is {{ Session::get('order_id') }} and total payable about is $ {{ Session::get('grand_total') }}</p>
			<p>Please make payment by clicking on below Payment Button</p>
            @php
                $nameArr = explode(' ',$orderDetails->name);
            @endphp
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="business" value="mustafa.salama2608@gmail.com">
				<input type="hidden" name="item_name" value="{{ Session::get('order_id') }}">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="amount" value="{{ Session::get('grand_total') }}">
				<input type="hidden" name="first_name" value="{{ $nameArr[0] }}">
				<input type="hidden" name="last_name" value="{{ $nameArr[1] }}">
				<input type="hidden" name="address1" value="{{ $orderDetails->address }}">
				<input type="hidden" name="address2" value="">
				<input type="hidden" name="city" value="{{ $orderDetails->city }}">
 				<input type="hidden" name="zip" value="{{ $orderDetails->pincode }}">
				<input type="hidden" name="email" value="{{ $orderDetails->user_email }}">
 				<input type="hidden" name="return" value="{{ url('paypal/thanks') }}">
				<input type="hidden" name="cancel_return" value="{{ url('paypal/cancel') }}">
				<input type="image"
				    src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="ادفع الان">
				  <img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif"
				    width="1" height="1">
			</form>
		</div>
	</div>
</section>

@endsection

<?php
// Session::forget('grand_total');
// Session::forget('order_id');
?>
