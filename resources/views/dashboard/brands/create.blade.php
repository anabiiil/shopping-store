@extends('layouts.dashboard')

@section('content')

<div>
    <h2>Brand</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.brands.index') }}">Brand</a></li>
    <li class="breadcrumb-item active">Add</li>
</ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form class="form" action="{{ route('dashboard.brands.store')}}" method="POST">
                @csrf
                <div class="form-body">
                    <h4 class="form-section"><i class="ft-home"></i> Brand Data</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Name <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('name') }}" id="name" class="form-control"
                                    placeholder=" " name="name" required>
                                @error("name")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control" required id="status">
                                    <option value="approved" {{ old('status') == 'approved'? 'selected' : '' }}>approved
                                    </option>
                                    <option value="pending" {{ old('status') == 'pending'? 'selected' : '' }}> pending
                                    </option>
                                    <option value="decline" {{ old('status') == 'decline'? 'selected' : '' }}> refused
                                    </option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> type <span class="text-danger">*</span></label>
                                <select name="type" class="form-control" id="type" required>
                                    <option value="admin" {{ old('type') == 'admin'? 'selected' : '' }}>admin</option>
                                    <option value="vendor" {{ old('type') == 'vendor'? 'selected' : '' }}>vendor</option>
                                </select>
                                @error('type')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions text-left">

                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Add Brand
                    </button>
                </div>
        </div>


        </form>


    </div>
</div>


@endsection
