@extends('layouts.dashboard')

@section('content')

    <h2>Edit Coupone</h2>


    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.coupons.index') }}">Discound Coupones</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ul>

    <div class="row">

        <div class="col-md-12">
            <div class="tile mb-4">
                <form method="post" action="{{ route('dashboard.coupons.update',$coupon->id) }}"  enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('dashboard.includes._errors')

                    <div class="form-body">
                        <h4 class="form-section"><i class="ft-home"></i> Coupone Data</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">Coupone Code <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $coupon->coupon_code }}" id="coupon_code" class="form-control" placeholder=" " name="coupon_code" required>
                                    @error("coupon_code")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">amount <span class="text-danger">*</span></label>
                                    <input type="number" value="{{ $coupon->amount }}" id="amount" class="form-control" placeholder=" " name="amount" required>
                                    @error("amount")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Expiry Date</label>
                                    <div class="controls">
                                      <input autocomplete="off" value="{{ $coupon->expiry_date }}" type="text" class="form-control" name="expiry_date" id="expiry_date" required>
                                    </div>
                                    @error("expiry_date")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Amount Type</label>
                                    <div class="controls">
                                      <select name="amount_type" class="form-control" id="amount_type" >
                                        <option @if($coupon->amount_type=="Percentage") selected @endif value="Percentage">Percentage</option>
                                        <option @if($coupon->amount_type=="Fixed") selected @endif value="Fixed">Fixed</option>
                                      </select>
                                    </div>
                                    @error("amount_type")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control" id="status" required>
                                        <option value="active" {{ $coupon->status == 'active'? 'selected' : '' }}>active</option>
                                        <option value="un_active" {{ $coupon->status  == 'un_active'? 'selected' : '' }}>un_active</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-left">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                    </div>
                </form>

            </div>

        </div>

    </div>

@endsection
