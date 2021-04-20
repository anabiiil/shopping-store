@extends('layouts.dashboard')

@section('content')



<div>
    <h2> Product Details </h2>
</div>

@if(Session::has('flash_message_error'))
<div class="alert alert-error alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{!! session('flash_message_error') !!}</strong>
</div>
@endif
@if(Session::has('flash_message_success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{!! session('flash_message_success') !!}</strong>
</div>
@endif

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active"> Product Details </li>
    {{--<li class="breadcrumb-item active">Data</li>--}}
</ul>

<div class="row">

    <div class="col-md-12">

        <div class="tile mb-4">

            <div class="row">

                <div class="col-12">

                    <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{ route('dashboard.addattribute',$productDetails->id) }}" name="add_product"
                        id="add_product">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3" for="projectinput1"> Category Name </label>
                                        <label class="col-md-3" for="projectinput1"> <strong
                                                style="color: #17416b">{{ $productDetails->category->name }}</strong>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-3" for="projectinput1"> Product Name </label>
                                        <label class="col-md-3" for="projectinput1"> <strong
                                                style="color: #17416b">{{$productDetails->name}}</strong> </label>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"></label>
                            <div class="controls field_wrapper" style="margin-left: 14px">
                                <div class="row">
                                    <input required="" title="Required" type="text" class="form-control col-md-2"
                                        name="size[]" id="size" placeholder="Size">
                                    <input required title="Required" type="number" class="form-control col-md-2"
                                        name="price[]" id="price" placeholder="Price">
                                    <input required title="Required" type="number" class="form-control col-md-2"
                                        name="stock[]" id="stock" placeholder="Stock">
                                    <input required title="Required" type="text" class="form-control col-md-2"
                                        name="sku[]" id="sku" placeholder="sku">
                                    <a href="javascript:void(0);" style="text-decoration: none; width: 160px; height: auto;background: #153b61; color: #f2f2f2;text-align: center; margin-left: 5px; border-radius: 5px; padding-top: 6px;" class="add_button" title="Add field">Add New Row</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions" style="margin-top: 10px;margin-bottom:20px">
                            <input type="submit" value="Add Product Attributes" class="btn btn-primary">
                        </div>
                    </form>

                </div><!-- end of col 12 -->

            </div><!-- end of row -->

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Size</th>
                                <th>Price </th>
                                <th> Stock </th>
                                <th> Sku</th>
                                <th> Date </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productDetails->transactions as $key => $transaction)
                            <tr class="gradeX">
                                <td class="center"> {{ $key+1 }}</td>
                                <td class="center">{{ $transaction->size }}</td>
                                <td class="center">{{ $transaction->price }}</td>
                                <td class="center">{{ $transaction->stock }}</td>
                                <td class="center">{{ $transaction->sku }}</td>
                                <td class="center">{{ $transaction->created_at }}</td>
                                {{-- <td class="center"> {{dateFormat($transaction->created_at)}} --}}
                                </td>
                                <td class="center">
                                    <a style="color: #1c4e80" data-toggle="modal" data-target="#EditModal"
                                        data-transid="{{ $transaction->id }}" data-size="{{ $transaction->size }}"
                                        data-price="{{ $transaction->price }}" data-stock="{{ $transaction->stock }}"
                                        data-sku="{{ $transaction->sku }}" class="" title="Edit"> <i
                                            class="fa fa-edit"></i></a>
                                    {{-- <input type="submit" value="Edit" class="btn btn-primary btn-mini" /> --}}


                                    <form method="post"
                                        action="{{ route('dashboard.transaction.destroy', $transaction->id) }}"
                                        style="display: inline-block;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit"
                                            style="background: none;border:0px;color:#c13232;outline:0" class="delete"
                                            title="Delete"><i class="fa fa-trash"></i></button>
                                    </form><!-- end of form -->

                                    {{-- <a rel="{{ $transaction->id }}" rel1="delete-attribute" href="javascript:"
                                    class="btn btn-danger btn-mini deleteRecord">Delete</a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div><!-- end of tile -->

        {{-- edit modal --}}

        <!-- Edit -->
        <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    @if(isset($transaction))
                    <form action="{{ route('dashboard.editattribute',$productDetails->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="trans_id" id="trans_id" value="">
                            <div class="form-group">
                                <label class="control-label col-md-4"> Size : </label>
                                <div class="col-md-8">
                                    <input type="text" name="size" id="size" class="form-control" />
                                    @if (Session::has('edit_transaction') && $errors->has('size'))
                                    <span class="text-danger">{{ $errors->first('size') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4"> Price : </label>
                                <div class="col-md-8">
                                    <input type="text" name="price" id="price" class="form-control" />
                                    @if (Session::has('edit_transaction') && $errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4"> Sku : </label>
                                <div class="col-md-8">
                                    <input type="text" name="sku" id="sku" class="form-control" />
                                    @if (Session::has('edit_transaction') && $errors->has('sku'))
                                    <span class="text-danger">{{ $errors->first('sku') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4"> Stock : </label>
                                <div class="col-md-8">
                                    <input type="text" name="stock" id="stock" class="form-control" />
                                    @if (Session::has('edit_transaction') && $errors->has('stock'))
                                    <span class="text-danger">{{ $errors->first('stock') }}</span>
                                    @endif
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                            <button type="submit" class="btn btn-primary"> Update</button>
                        </div>
                    </form>

                    @endif

                </div>
            </div>
        </div>
        <!-- /edit -->
        @php
        global $value_edit;
        $value_edit = Session::has('edit_transaction')? Session::has('edit_transaction'):'null';
        // dd($value_edit)
        @endphp
        {{-- ./edit modal --}}
    </div><!-- end of col -->

</div><!-- end of row -->

@endsection

@push('js')
<script>
    if({{$value_edit}} != null)
    {
        $('#EditModal').modal('show');
    }

    $('#EditModal').on('show.bs.modal', function (event) {

        console.log('asss')
        var button = $(event.relatedTarget)

        var size = button.data('size')
        // console.log(size)
        var price = button.data('price')
        var stock = button.data('stock')
        var sku = button.data('sku')

        var trans_id = button.data('transid')
        //  console.log(trans_id)
        var modal = $(this)
        modal.find('.modal-body #size').val(size);
         modal.find('.modal-body #price').val(price);
        modal.find('.modal-body #stock').val(stock);
        modal.find('.modal-body #sku').val(sku);
        modal.find('.modal-body #trans_id').val(trans_id);
    });

</script>
@endpush
