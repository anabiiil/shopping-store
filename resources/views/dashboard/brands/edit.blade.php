@extends('layouts.dashboard')

@section('content')

    <h2>Edit Brand</h2>


    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.brands.index') }}">Brand</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ul>

    <div class="row">

        <div class="col-md-12">
            <div class="tile mb-4">
                <form method="post" action="{{ route('dashboard.brands.update',$brand->id) }}">
                    @csrf
                    @method('put')

                    @include('dashboard.includes._errors')

                    <div class="form-body">
                        <h4 class="form-section"><i class="ft-home"></i> Brand Data</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> Name <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $brand->name }}" id="name" class="form-control" placeholder=" " name="name" required>
                                    @error("name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-control" id="type" required>
                                        <option value="admin" {{ $brand->type == 'admin'? 'selected' : '' }}>admin</option>
                                        <option value="vendor" {{ $brand->type  == 'vendor'? 'selected' : '' }}>vendor  </option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control" id="status" required>
                                        <option value="approved" {{ $brand->status == 'approved'? 'selected' : '' }}>approved</option>
                                        <option value="pending" {{ $brand->status  == 'pending'? 'selected' : '' }}>pending  </option>
                                        <option value="decline" {{ $brand->status  == 'decline'? 'selected' : '' }}>refused  </option>
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
