@extends('layouts.dashboard')

@section('content')

<div>
    <h2>Discound Coupones</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.coupons.index') }}">Discound Coupones</a></li>
    <li class="breadcrumb-item active">Add</li>
</ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form class="form" action="{{ route('dashboard.coupons.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <h4 class="form-section"><i class="ft-home"></i> Coupone Data</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1">Coupone Code <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('coupon_code') }}" id="coupon_code" class="form-control" maxlength="20" minlength="5" placeholder=" " name="coupon_code" required>
                                @error("coupon_code")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Amount Type</label>
                                <div class="controls">
                                <select name="amount_type" id="amount_type" class="form-control"   >
                                    <option value="Percentage"> Percentage</option>
                                    <option value="Fixed">Fixed</option>
                                </select>
                                </div>
                                @error("amount_type")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">amount</label>
                                <div class="controls">
                                  <input type="number" name="amount" class="form-control" min="0"  id="amount" required>
                                </div>
                                @error("amount")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Expiry Date</label>
                                <div class="controls">
                                  <input type="text" autocomplete="off" name="expiry_date" class="form-control"  id="expiry_date" required>
                                </div>
                                @error("expiry_date")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control" id="status" required>
                                    <option value="active" {{ old('status') == 'active'? 'selected' : '' }}>active</option>
                                    <option value="un_active" {{ old('status') == 'un_active'? 'selected' : '' }}>un_active</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions text-left">
                    {{-- <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                        <i class="ft-x"></i> تراجع
                    </button> --}}
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Add Coupone
                    </button>
                </div>
        </div>


        </form>


    </div>
</div>


@endsection
