@extends('layouts.dashboard')

@section('content')

<div>
    <h2>Banner</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.banners.index') }}">Banner</a></li>
    <li class="breadcrumb-item active">Add</li>
</ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form class="form" action="{{ route('dashboard.banners.store')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                     <h4 class="form-section"><i class="ft-home"></i>  Banner Data</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Link <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('link') }}" id="link" required class="form-control"
                                    placeholder=" " name="link" required>
                                @error("link")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Address </label>
                                <input type="text" value="" id="title" class="form-control" placeholder=""
                                    required name="title">
                                 @error("title")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Status </label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" value="1">
                                  </div>
                                @error('status')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Image </label>
                                <input type="file" class="form-control" required name="image">
                                @error("image")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                </div>
                <div class="form-actions text-left">
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Add Banner
                    </button>
                </div>
        </div>


        </form>


    </div>
</div>


@endsection
