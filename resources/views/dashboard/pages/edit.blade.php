@extends('layouts.dashboard')

@section('content')

    <h2>Edit Page</h2>


    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.cmsPages.index') }}"> Page</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ul>

    <div class="row">

        <div class="col-md-12">
            <div class="tile mb-4">
                <form method="post" action="{{ route('dashboard.cmsPages.update',$cmspage->id) }}"  enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('dashboard.includes._errors')

                    <div class="form-body">
                        <h4 class="form-section"><i class="ft-home"></i> Page</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> Url <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $cmspage->url }}" id="url" class="form-control" placeholder=" " name="url" required>
                                    @error("url")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">Title <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $cmspage->title }}" id="title" class="form-control" placeholder=" " name="title" required>
                                    @error("title")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control">{{ $cmspage->description }}</textarea>
                                    @error("description")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> Status </label>
                                    <input type="checkbox" name="status" id="status" {{ $cmspage->status == "1" ? 'checked' : "" }}  value="1">

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
