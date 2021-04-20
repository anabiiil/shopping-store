@extends('layouts.dashboard')

@section('content')

<div>
    <h2>Banner</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Banner</li>
     @if (auth()->guard('admin')->user()->hasPermission('create_banners'))
            <li class="breadcrumb-item"><a href="{{ route('dashboard.banners.create') }}"> Add New Banner </a></li>
        @endif
</ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">
            <div class="row">
                <div class="col-md-12">
                    @if ($banners->count() > 0)
                    <table class="table table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Link</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $index => $banner)

                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $banner->link }}</td>
                                <td>{{ $banner->title}} </td>
                                <td>
                                    <img src="{{ asset('uploads/banners/'.$banner->image) }}" style="width:60px;height:60px" alt="image"  class="img-thumbnail">
                                </td>
                                 <td>
                                    @if($banner->getStatus() == 'active')
                                       <span class="btn-sm btn-success">{{ $banner->getStatus() }}</span>
                                   @else
                                       <span class="btn-sm btn-danger">{{ $banner->getStatus() }}</span>
                                   @endif
                               </td>
                                 <td>
                                    @if (auth()->guard('admin')->user()->hasPermission('update_banners'))
                                    <a href="{{ route('dashboard.banners.edit', $banner->id) }}" title="edit"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if (auth()->guard('admin')->user()->hasPermission('delete_banners'))
                                    <form method="post" action="{{ route('dashboard.banners.destroy', $banner->id) }}" style="display: inline-block;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" style="background: none;border:0px;color:#c13232;outline:0" class="delete" title="delete"><i class="fa fa-trash"></i></button>
                                    </form><!-- end of form -->

                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    @else
                    <h3 style="font-weight: 400;">Sorry no records found</h3>
                    @endif
                </div>
            </div>
        </div><!-- end of tile -->
    </div><!-- end of col -->

</div><!-- end of row -->

@endsection
