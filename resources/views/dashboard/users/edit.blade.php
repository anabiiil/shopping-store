@extends('layouts.dashboard')

@section('content')

    <div>
        <h2>Users</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Users</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow mb-4">

                <form method="post" action="{{ route('dashboard.users.update', $user->id) }}">
                    @csrf
                    @method('put')

                    {{--name--}}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                        @error('name')
                        <span class="text-danger">{{$message}} </span>
                        @enderror
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                        @error('email')
                        <span class="text-danger">{{$message}} </span>
                        @enderror
                    </div>

                     {{--password--}}
                     <div class="form-group">
                        <label for="projectinput1">Password</label>
                        <input type="password" name="password" value="" id="password"
                               class="form-control"
                               placeholder="Enter Your Password "
                               name="password">
                        @error('password')
                        <span class="text-danger">{{$message}} </span>
                        @enderror
                    </div>
                    <div class="form-group text-left">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
