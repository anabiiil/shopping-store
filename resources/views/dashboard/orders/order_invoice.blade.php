<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<style>
    @media print {
        #print_Button {
            display: none;
        }
    }

</style>
@php
use Carbon\Carbon;
@endphp

<div class="main" style="background: #f2f2f2;padding-top:40px;min-height:800px">
    <div class="container">
        <div class="row">
            <div class="col-md-6" style="display: flex">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Orders Details</li>
            </div>
            <div class="col-md-6" style="display: flex">
                <li class="breadcrumb-item"><b>Invoice</b></li>
                <li class="breadcrumb-item"> <b>Order #{{ $orderDetails->id }} </b> </li>
            </div>
            <div  id="print" class="col-md-12" style="margin-top:20px">
                <div class="tile">
                    <section class="invoice">
                        <div class="row mb-4">
                            <div class="col-6">
                                <h2 class="page-header"><i class="fa fa-address-card-o"></i> Invoice</h2>
                            </div>

                        </div>
                        <div class="row invoice-info">
                            <div class="col-4"><strong> Billed To : </strong>
                                <address>
                                    {{ $userDetails->name }} <br>
                                    {{ $userDetails->address }} <br>
                                    {{ $userDetails->city }} <br>
                                    {{ $userDetails->country }} <br>
                                    {{ $userDetails->pincode }} <br>
                                    {{ $userDetails->mobile }} <br>
                                </address>
                            </div>
                            <div class="col-4"><strong> Shipped To: </strong>
                                <address>
                                    {{ $orderDetails->name }} <br>
                                    {{ $orderDetails->address }} <br>
                                    {{ $orderDetails->city }} <br>
                                    {{ $orderDetails->country }} <br>
                                    {{ $orderDetails->pincode }} <br>
                                    {{ $orderDetails->mobile }}
                                </address>
                            </div>
                            <div class="col-4"><b>Invoice #007612</b><br><br><b>Order Date:</b>
                                {{   Carbon::today() }}<br><b>Payment Method:</b> {{ $orderDetails->payment_method }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped" style="margin-top: 70px;">
                                    <thead>
                                        <tr>
                                            <th>Product Name / Code</th>
                                             <th>Product Size</th>
                                            <th>Product Color</th>
                                            <th>Product Price</th>
                                            <th>Product Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $Subtotal = 0; ?>
                                        @foreach($orderDetails->orders as $pro)
                                        <tr>
                                            <td>{{ $pro->product_name }} / {{ $pro->product_code }}</td>
                                             <td>{{ $pro->product_size }}</td>
                                            <td>{{ $pro->product_color }}</td>
                                            <td>$ {{ $pro->product_price }}</td>
                                            <td>{{ $pro->product_qty }}</td>
                                            <td>$ {{  $pro->product_price * $pro->product_qty }}</td>
                                        </tr>
                                        <?php $Subtotal = $Subtotal + ($pro->product_price * $pro->product_qty); ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <ul class="list-group col-md-6" style="position: relative;left:50%;padding:0">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Sub Total
                                <span class="badge bg-primary rounded-pill">${{ $Subtotal }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Shipping Charges (+)
                                <span class="badge bg-primary rounded-pill">$ 0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Coupon Discount (-)
                                <span class="badge bg-primary rounded-pill">$ {{ $orderDetails->coupone_amount }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                grand Total
                                <span class="badge bg-primary rounded-pill">$ {{ $orderDetails->grand_total }}</span>
                            </li>
                        </ul>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right">
                                <a class="btn btn-primary" id="print_Button" onclick="printDiv()">
                                    <i class="fa fa-print"></i>
                                     Print
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
     function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

</script>
