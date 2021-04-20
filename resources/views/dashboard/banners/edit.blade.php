@extends('layouts.dashboard')

@section('content')

    <h2>Edit Banner</h2>


    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.banners.index') }}">  Banner</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ul>

    <div class="row">

        <div class="col-md-12">
            <div class="tile mb-4">
                <form method="post" action="{{ route('dashboard.banners.update',$banner->id) }}"  enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('dashboard.includes._errors')

                    <div class="form-body">
                        <h4 class="form-section"><i class="ft-home"></i> Banner</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> Link <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $banner->link }}" id="link" class="form-control" placeholder=" " name="link" required>
                                    @error("link")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">Address <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $banner->title }}" id="title" class="form-control" placeholder=" " name="title" required>
                                    @error("title")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Image</label>
                                    <input type="file" name="image" class="form-control image">
                                    @error('image')
                                        <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{asset('uploads/banners/'.$banner->image)}}" class="img-thumbnail image-preview" style="width:100px">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> Status </label>
                                    <input type="checkbox" name="status" id="status" {{ $banner->status == "1" ? 'checked' : "" }}  value="1">

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
