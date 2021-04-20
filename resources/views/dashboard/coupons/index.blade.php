@extends('layouts.dashboard')

@section('content')

<div>
    <h2>Discound Coupones</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
    <li class="breadcrumb-item active">Discound Coupones</li>
        @if (auth()->guard('admin')->user()->hasPermission('create_coupons'))
    <li class="breadcrumb-item"><a href="{{ route('dashboard.coupons.create') }}"> Add New Coupone </a></li>
    @endif
</ul>

<div class="row">

    <div class="col-md-12">

        <div class="tile mb-4">
        <div class="row">
            <div class="col-md-12">
                @if ($coupons->count() > 0)
                <table class="table table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Discound Code</th>
                            <th>Amount</th>
                            <th> Amount Type</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($coupons as $index => $coupon)

                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $coupon->coupon_code }}</td>

                            <td>
                                @if($coupon->amount_type == 'Fixed')
                                    <span>${{ $coupon->amount }}<span>
                                @else
                                    <span>{{ $coupon->amount }}%<span>
                                @endif
                            </td>

                            <td>
                                @if($coupon->getAmountType() == 'fixed')
                                   <span class="btn-sm btn-success">{{ $coupon->getAmountType()}} </span>
                               @else
                                   <span class="btn-sm btn-success">{{ $coupon->getAmountType() }}</span>
                               @endif
                           </td>
                             {{-- <td class="center"> {{dateFormat($coupon->expiry_date)}} </td> --}}
                             <td class="center"> {{$coupon->expiry_date}} </td>

                            <td>
                                @if($coupon->getActive() == 'active')
                                   <span class="btn-sm btn-success">{{ $coupon->getActive() }}</span>
                               @else
                                   <span class="btn-sm btn-danger">{{ $coupon->getActive() }}</span>
                               @endif
                           </td>
                             <td>
                                @if (auth()->guard('admin')->user()->hasPermission('update_categories'))
                                <a href="{{ route('dashboard.coupons.edit', $coupon->id) }}" title="Edit"><i class="fa fa-edit"></i></a>
                                @endif
                                @if (auth()->guard('admin')->user()->hasPermission('delete_categories'))
                                <form method="post" action="{{ route('dashboard.coupons.destroy', $coupon->id) }}" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" style="background: none;border:0px;color:#c13232;outline:0" class="delete" title="Delete"><i class="fa fa-trash"></i></button>
                                </form><!-- end of form -->

                                @endif
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
