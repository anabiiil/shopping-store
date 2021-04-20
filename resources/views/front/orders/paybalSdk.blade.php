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
			<form action="{{ route('payWithPaypalSdk') }}" method="post">
                @csrf
				<input type="hidden" name="order_id" value="{{ Session::get('order_id') }}">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="amount" value="{{ Session::get('grand_total') }}">
				<input type="hidden" name="first_name" value="{{ $nameArr[0] }}">
				<input type="hidden" name="last_name" value="{{ $nameArr[1] }}">
				<input type="hidden" name="address" value="{{ $orderDetails->address }}">
                <input type="hidden" name="city" value="{{ $orderDetails->city }}">
                <input type="hidden" name="pincode" value="{{ $orderDetails->pincode }}">
				<input type="hidden" name="email" value="{{ $orderDetails->user_email }}">
                  <input type="submit" name="" class="form-controller" id="">
			</form>
		</div>
	</div>
</section>

@endsection

<?php
// Session::forget('grand_total');
// Session::forget('order_id');
?>
