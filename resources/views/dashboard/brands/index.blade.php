@extends('layouts.dashboard')

@section('content')

<div>
    <h2> Brand</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
    <li class="breadcrumb-item active"> Brands </li>
    @if (auth()->guard('admin')->user()->hasPermission('create_brands'))
    <li class="breadcrumb-item"><a href="{{ route('dashboard.brands.create') }}"> Add New Brand </a></li>
    @endif
</ul>

<div class="row">

    <div class="col-md-12">

        <div class="tile mb-4">



            <div class="row">
                <div class="col-md-12">
                    @if ($brands->count() > 0)
                    <table class="table table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th> Type</th>
                                <th>Status</th>
                                <th>external_id</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($brands as $index => $brand)

                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    @if($brand->getType() == 'admin')
                                    <span class="btn-sm btn-success">{{ $brand->getType() }}</span>
                                    @else
                                    <span class="btn-sm btn-primary">{{ $brand->getType() }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($brand->getStatus() == 'approved')
                                    <span class="btn-sm btn-success">{{ $brand->getStatus() }}</span>
                                    @elseif($brand->getStatus() == 'pending')
                                    <span class="btn-sm btn-primary">{{ $brand->getStatus() }}</span>
                                    @else
                                    <span class="btn-sm btn-danger">{{ $brand->getStatus() }}</span>

                                    @endif
                                </td>
                                <td>{{ $brand->external_id }}</td>
                                <td>
                                    @if (auth()->guard('admin')->user()->hasPermission('update_brands'))
                                    <a href="{{ route('dashboard.brands.edit', $brand->id) }}" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    @endif
                                    @if (auth()->guard('admin')->user()->hasPermission('delete_brands'))
                                    <form method="post" action="{{ route('dashboard.brands.destroy', $brand->id) }}"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            style="background: none;border:0px;color:#c13232;outline:0" class="delete"
                                            title="status"><i class="fa fa-trash"></i></button>
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
