@extends('layouts.dashboard')

@section('content')



<div>
    <h3>Orders Details</h3>
    <h4>Order #{{ $orderDetails->id }}</h4>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Orders Details</li>
</ul>

<div class="row">
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">User Detailes</h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>User Name</td>
                        <td>{{ $orderDetails->name }}</td>
                    </tr>
                    <tr>
                        <td>User Email</td>
                        <td>{{ $orderDetails->user_email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Update Order Status</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('dashboard/update-order-status') }}" method="post">{{ csrf_field() }}
                    <input type="hidden" name="order_id" value="{{ $orderDetails->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="order_status" id="order_status" class="form-control" required="">
                                <option value="New" @if($orderDetails->order_status == "New") selected @endif>New</option>
                                <option value="Pending" @if($orderDetails->order_status == "Pending") selected @endif>Pending</option>
                                <option value="Cancelled" @if($orderDetails->order_status == "Cancelled") selected @endif>Cancelled</option>
                                <option value="In Process" @if($orderDetails->order_status == "In Process") selected @endif>In Process</option>
                                <option value="Shipped" @if($orderDetails->order_status == "Shipped") selected @endif>Shipped</option>
                                <option value="Delivered" @if($orderDetails->order_status == "Delivered") selected @endif>Delivered</option>
                                <option value="Paid" @if($orderDetails->order_status == "Paid") selected @endif>Paid</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" class=" btn btn-primary form-control" value="Update Status">
                        </div>

                    </div>

                  </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Order Detailes</h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Order Date</td>
                        <td>{{ $orderDetails->created_at }}</td>
                    </tr>
                    <tr>
                        <td>Order Status</td>
                        <td>{{ $orderDetails->order_status }}</td>
                    </tr>
                    <tr>
                        <td>Order Total</td>
                        <td>$ {{ $orderDetails->grand_total }}</td>
                    </tr>
                    <tr>
                        <td>Shipping Charges</td>
                        <td>$ {{ $orderDetails->shipping_charges }}</td>
                    </tr>
                    <tr>
                        <td>Coupon Code</td>
                        <td>{{ $orderDetails->coupone_code }}</td>
                    </tr>
                    <tr>
                        <td>Coupon Amount</td>
                        <td>$ {{ $orderDetails->coupone_amount }}</td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td>{{ $orderDetails->payment_method }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Customer Detailes</h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="taskDesc">Customer Name</td>
                        <td class="taskStatus">{{ $orderDetails->name }}</td>
                      </tr>
                      <tr>
                        <td class="taskDesc">Customer Email</td>
                        <td class="taskStatus">{{ $orderDetails->user_email }}</td>
                      </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="bs-component">
            <div class="list-group">
                <a class="list-group-item list-group-item-action active" href="#"><h4>Billing Address</h4></a>
                <a class="list-group-item list-group-item-action" href="#">{{ $userDetails->name }}</a>
                <a class="list-group-item list-group-item-action" href="#">{{ $userDetails->address }}</a>
                <a class="list-group-item list-group-item-action" href="#">{{ $userDetails->city }}</a>
                <a class="list-group-item list-group-item-action" href="#">{{ $userDetails->country }}</a>
                <a class="list-group-item list-group-item-action" href="#">{{ $userDetails->pincode }}</a>
                <a class="list-group-item list-group-item-action" href="#">{{ $userDetails->mobile }}</a>
             </div>
          </div>
    </div>
    <div class="col-md-6">
        <div class="bs-component">
            <div class="list-group">
                <a class="list-group-item list-group-item-action active" href="#"><h4>Shipping Address</h4></a>
                <a class="list-group-item list-group-item-action" href="#">{{ $orderDetails->name }}</a>
                <a class="list-group-item list-group-item-action" href="#">{{ $orderDetails->address }}</a>
                <a class="list-group-item list-group-item-action" href="#">{{ $orderDetails->city }}</a>
                <a class="list-group-item list-group-item-action" href="#">{{ $orderDetails->country }}</a>
                <a class="list-group-item list-group-item-action" href="#">{{ $orderDetails->pincode }}</a>
                <a class="list-group-item list-group-item-action" href="#">{{ $orderDetails->mobile }}</a>
             </div>
          </div>
    </div>
    <div class="col-md-12" style="margin-top: 20px">
        <div class="tile">
             <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Size</th>
                        <th>Product Color</th>
                        <th>Product Price</th>
                        <th>Product Qty</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($orderDetails->orders as $pro)
                    <tr>
                        <td>{{ $pro->product_code }}</td>
                        <td>{{ $pro->product_name }}</td>
                        <td>{{ $pro->product_size }}</td>
                        <td>{{ $pro->product_color }}</td>
                        <td>{{ $pro->product_price }}</td>
                        <td>{{ $pro->product_qty }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
