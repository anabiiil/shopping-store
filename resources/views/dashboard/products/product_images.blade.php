@extends('layouts.dashboard')

@section('content')



<div>
    <h2>   Product Images </h2>
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
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">Products</a></li>
     <li class="breadcrumb-item active"> Product Images</li>
    {{--<li class="breadcrumb-item active">Data</li>--}}
</ul>

<div class="row">

    <div class="col-md-12">

        <div class="tile mb-4">

            <div class="row">

                <div class="col-12">

                    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('dashboard/products/product-images/'.$productImages->id) }}" name="add_product" id="add_product" novalidate="novalidate">{{ csrf_field() }}
                        <input type="hidden" name="product_id" value="{{ $productImages->id }}">
                       <div class="form-body">
                           <div class="row">
                               <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-3" for="projectinput1"> Category Name </label>
                                    <label class="col-md-3" for="projectinput1"> <strong style="color: #17416b">{{ $productImages->category->name }}</strong> </label>
                                </div>
                               </div>

                               <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-3" for="projectinput1"> Product Name </label>
                                    <label class="col-md-3" for="projectinput1"> <strong style="color: #17416b">{{$productImages->name}}</strong> </label>
                                </div>
                               </div>



                           </div>
                       </div>
                        <div class="control-group">
                          <label class="control-label"></label>
                          <div class="controls field_wrapper">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> Image </label>
                                    <input type="file" name="image[]" class="form-control image" multiple>
                                    @error("image")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-actions" style="margin-bottom: 30px">
                          <input type="submit" value="Add" class="btn btn-success">
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
                          <th>Images</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($productImages->images as $key=> $image)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><img src="{{ $image->image_path }}" style="width: 100px"  class="img-thumbnail" alt=""></td>
                            <td>
                                <a style="color: #fff" data-toggle="modal" data-target="#EditModal" data-imageid="{{ $image->id }}"
                                    type="button" class="btn btn-primary" title="Edit"> Edit</a>

                                <form method="post" action="{{ url('dashboard/products/delete-images', $image->id) }}" style="display: inline-block;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit"  class="delete btn btn-danger" title="Delete">Delete</button>
                                </form><!-- end of form -->
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

                <form enctype="multipart/form-data" action="{{ url('dashboard/products/update-images/'.$productImages->id) }}"
                    method="post" >
                  {{csrf_field()}}
                  <div class="modal-body">
                      <input type="hidden" name="image_id" id="image_id" value="">
                      <div class="form-group">
                          <label class="control-label col-md-4"> image : </label>
                          <div class="col-md-8">
                              <input type="file"    name="image" id=""class="form-control image_name"/>
                              @if (Session::has('edit_image') && $errors->has('image'))
                              <span class="text-danger">{{ $errors->first('image') }}</span>
                           @endif
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default"
                          data-dismiss="modal">اغلاق</button>
                      <button type="submit" class="btn btn-primary">  Update</button>
                  </div>
              </form>

            </div>
        </div>
    </div>
    <!-- /edit -->

    {{-- ./edit modal --}}
</div><!-- end of col -->

</div><!-- end of row -->

@endsection

@push('js')
<script>
 $('#EditModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var image_id = button.data('imageid')
    var image_name = button.data('imagename')

    console.log(image_name);

    var modal = $(this)

    modal.find('.modal-body .image_name').val(image_name);

    modal.find('.modal-body #image_id').val(image_id);
    });
</script>
@endpush
