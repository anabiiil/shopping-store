@extends('layouts.dashboard')

@section('content')

<div>
    <h2>Pages</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Pages</li>
      @if (auth()->guard('admin')->user()->hasPermission('create_cmsPages'))
        <li class="breadcrumb-item"><a href="{{ route('dashboard.cmsPages.create') }}"> Add New Page </a></li>
    @endif
</ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <div class="row">
                <div class="col-md-12">
                    @if ($cmsPages->count() > 0)
                    <table class="table table-hover"  id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Url</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cmsPages as $index => $pages)

                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $pages->url }}</td>
                                <td>{{ $pages->title}} </td>
                                <td>{{ $pages->description}} </td>
                                 <td>
                                    @if($pages->getStatus() == 'active')
                                    <span class="btn-sm btn-success">{{ $pages->getStatus() }}</span>
                                @else
                                    <span class="btn-sm btn-danger">{{ $pages->getStatus() }}</span>
                                @endif
                               </td>
                                 <td>
                                    @if (auth()->guard('admin')->user()->hasPermission('update_cmsPages'))
                                    <a href="{{ route('dashboard.cmsPages.edit', $pages->id) }}" class="btn btn-primary btn-sm" title="edit"><i class="fa fa-edit"></i>Edit</a>
                                    @endif
                                    @if (auth()->guard('admin')->user()->hasPermission('delete_cmsPages'))
                                    <form method="post" action="{{ route('dashboard.cmsPages.destroy', $pages->id) }}" style="display: inline-block;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"  class="delete btn btn-danger btn-sm" title="delete"><i class="fa fa-trash"></i>Delete</button>
                                    </form><!-- end of form -->
                                    @endif
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal-{{ $pages->id }}">
                                        View
                                    </button>
                                   <!-- Modal -->
                                    <div class="modal fade" id="exampleModal-{{ $pages->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $pages->title }} Page Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Title:</strong> {{ $pages->title }}</p>
                                                <p><strong>URL:</strong> {{ $pages->url }}</p>
                                                <p><strong>Status:</strong> @if($pages->status==1) Active @else Inactive @endif</p>
                                                <p><strong>Created on:</strong> {{ $pages->created_at }}</p>
                                                <p><strong>Description:</strong> {{ $pages->description }}</p>
                                              </div>

                                        </div>
                                        </div>
                                    </div>
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
