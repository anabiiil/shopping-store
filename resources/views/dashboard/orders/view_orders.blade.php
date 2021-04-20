@extends('layouts.dashboard')

@section('content')


<div>
    <h2>Orders</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Orders</li>

</ul>
<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">


            <div class="row">
                <div class="col-md-12">
                    @if ($orders->count() > 0)
                        <table class="table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Order Date</th>
                                    <th>Ordered Products</th>
                                    <th>Order Amount</th>
                                    <th>Payment Method</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($orders as $order)
                                <tr class="gradeX">
                                    <td class="center">{{ $order->id }}</td>
                                    <td class="center">{{ $order->name }}</td>
                                    <td class="center">{{ $order->user_email }}</td>
                                    <td class="center"> {{$order->created_at}}
                                    <td class="center">
                                        @foreach($order->orders as $pro)
                                        {{ $pro->product_code }}
                                        ({{ $pro->product_qty }})
                                        <br>
                                        @endforeach
                                    </td>
                                    <td class="center">${{ $order->grand_total }}</td>

                                    <td class="center">{{ $order->payment_method }}</td>
                                    <td class="center" style="display: flex">
                                        <a target="_blank" style="margin-right: 20px" href="{{ url('dashboard/view-order/'.$order->id)}}"
                                            class="btn btn-primary btn-mini">View Order Details</a>

                                            <a target="_blank" href="{{ url('dashboard/view-order-invoice/'.$order->id)}}"
                                                class="btn btn-primary btn-mini">View Order Invoices</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @else
                    <h3 style="font-weight: 400;">Sorry no records found</h3>
                    @endif
                </div>
            </div>
        </div><!-- end of tile -->
    </div><!-- end of col -->

</div><!-- end of row -->


@endsection
