@extends('layouts.dashboard')

@section('content')

<div>
    <h2>Category</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Category</a></li>
    <li class="breadcrumb-item active">Add</li>
</ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form class="form" action="{{ route('dashboard.categories.store')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <h4 class="form-section"><i class="ft-home"></i> Category Data </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Name </label>
                                <input type="text" value="" id="name" class="form-control" required placeholder=" " name="name">
                                @error("name")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Sub Category </label>
                                <select name="parent_id" required class="form-control">
                                    <option value="0">All Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @error("parent_id")
                                <span class="text-danger"> this field is required</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1">  link </label>
                                <input type="text" value="" id="url" class="form-control" required placeholder=" " name="url">
                                @error("url")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1">description </label>
                                <input type="text" value="" id="description" class="form-control" placeholder="" required name="description">
                                @error("description")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> status </label>
                                <div class="controls">
                                    {{-- <input type="checkbox" value="1" name="status" id="status"
                                    id="switcheryColor4"class="switchery" data-color="success" checked/> --}}
                                    <input type="checkbox" name="status" id="status" value="active">
                                  </div>
                                @error('status')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

        </div>

            <div class="form-actions text-left">
                {{-- <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                    <i class="ft-x"></i> تراجع
                </button> --}}
                <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Add
                </button>
            </div>
        </form>


    </div><!-- end of tile -->
</div><!-- end of col -->
</div><!-- end of row -->

@endsection
