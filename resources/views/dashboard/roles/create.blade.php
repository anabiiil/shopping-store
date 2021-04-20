@extends('layouts.dashboard')

@section('content')

<div>
    <h2>Roles</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Add</li>
</ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form method="post" action="{{ route('dashboard.roles.store') }}">
                @csrf
                @method('post')

                {{-- @include('dashboard.includes._errors') --}}

                {{--name--}}
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    @error('name')
                    <span class="text-danger">{{$message}} </span>
                    @enderror
                </div>

                {{--permissions--}}
                <div class="form-group">
                    <h4>Permissions</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 15%;">Module</th>
                                <th>Permissions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php
                            $models = ['admins','categories','coupons','cmsPages','users','brands','products','orders'];
                            @endphp

                            @foreach ($models as $index=>$model)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                {{-- <td class="text-capitalize">{{ __('admin.'.$model) }}</td> --}}
                                <td class="text-capitalize">{{ $model }}</td>
                                <td>
                                    @if ($model == 'orders')
                                        @php
                                            $permission_maps = ['read'];
                                        @endphp

                                        @else

                                        @php
                                            $permission_maps = ['create', 'read', 'update', 'delete'];
                                        @endphp
                                    @endif


                                    <select name="permissions[]" class="form-control select2" multiple>
                                        @foreach ($permission_maps as $permission_map)
                                        <option value="{{ $permission_map . '_' . $model }}">
                                            {{-- {{ __('admin.'.$permission_map)  }} --}}
                                            {{ $permission_map }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('permissions')
                                    <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

               <div class="form-actions text-left">

                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>

                </div>

            </form><!-- end of form -->

        </div><!-- end of tile -->
    </div><!-- end of col -->
</div><!-- end of row -->

@endsection
