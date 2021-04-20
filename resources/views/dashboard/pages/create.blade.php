@extends('layouts.dashboard')

@section('content')

<div>
    <h2>Pages</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.cmsPages.index') }}">Pages</a></li>
    <li class="breadcrumb-item active">Add</li>
</ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form class="form" action="{{ route('dashboard.cmsPages.store')}}" name="add_cms_page" id="add_cms_page" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                     <h4 class="form-section"><i class="ft-home"></i>  Pages Data</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> CMS Page URL</label>
                                <input type="text" value="{{ old('url') }}" id="url" required class="form-control"
                                    placeholder=" " name="url" required>
                                @error("url")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Title </label>
                                <input type="text" value="" id="title" class="form-control" placeholder=""
                                    required name="title">
                                 @error("title")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Description </label>
                                <textarea name="description" class="form-control" required=""></textarea>

                                 @error("description")
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

                </div>
                <div class="form-actions text-left">
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Add Pages
                    </button>
                </div>
        </div>


        </form>


    </div>
</div>


@endsection
