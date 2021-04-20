@extends('layouts.dashboard')

@section('content')

    <h2>Category</h2>


    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Category</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile mb-4">

                <form method="post" action="{{ route('dashboard.categories.update',$categories->id) }}"  enctype="multipart/form-data">
                    @csrf
                    @method('put')


                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Name </label>
                                <input type="text" value="{{ $categories->name }}" id="name" class="form-control" placeholder=" " name="name">
                                @error('name')
                                    <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1">   Sub Category </label>
                                <select name="parent_id" class="form-control">
                                <option value="0">All Category</option>
                                    @foreach ($levels as $level)
                                        <option
                                            value="{{$level->id}}"
                                            @if($level->id == $categories->parent_id )  selected @endif >
                                            {{$level->name}}
                                        </option>
                                    @endforeach
                                </select>

                                @error('parent_id')
                                    <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Link </label>
                                <input type="text" value="{{ $categories->url }}" id="url" class="form-control" placeholder=" " name="url">
                                @error("url")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1">description </label>
                                <input type="text" value="{{ $categories->description }}" id="description" class="form-control" placeholder=" " name="description">
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
                                <input type="checkbox" name="status" id="status" {{ $categories->status == "active" ? 'checked' : "" }}  value="1">

                                @error('status')
                                    <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="form-group text-left">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
