@extends('layouts.dashboard')

@section('content')

<div>
    <h2>Products</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Add</li>
</ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form class="form" action="{{ route('dashboard.products.store')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                     <h4 class="form-section"><i class="ft-home"></i> Product Data</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Name <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('name') }}" id="name" required class="form-control"
                                    placeholder=" " name="name" required>
                                @error("name")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1">description </label>
                                <input type="text" value="" id="description" class="form-control" placeholder=""
                                    required name="description">
                                 @error("description")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Material </label>
                                <input type="text" value="" id="care" class="form-control" placeholder="" required name="care">
                                @error("care")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="margin-bottom:20px">Choose Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <?php echo $categories_drop_down; ?>
                                  </select>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Feature Item </label>
                                <div class="controls">
                                    <input type="checkbox" name="feature_item" id="feature_item" value="1">
                                  </div>
                                @error('feature_item')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> status </label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" value="active">
                                  </div>
                                @error('status')
                                <span class="text-danger">{{$message}} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1">Discound</label>
                                <input type="number" class="form-control form-control-lg" id="discount" name="discount"
                                    value=0 required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Image </label>
                                <input type="file" class="form-control" required name="cover">
                                @error("cover")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> Code <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('code') }}" id="code" required class="form-control"
                                    placeholder=" " name="code" required>
                                @error("code")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> color <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('color') }}" id="color" required class="form-control"
                                    placeholder=" " name="color" required>
                                @error("color")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="projectinput1"> price <span class="text-danger">*</span></label>
                                <input type="number" value="{{ old('price') }}" id="price" required class="form-control"
                                    placeholder=" " name="price" required>
                                @error("price")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions text-left">
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Add Product
                    </button>
                </div>
        </div>


        </form>


    </div>
</div>


@endsection
