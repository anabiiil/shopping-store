@extends('layouts.dashboard')

@section('content')

    <h2>Edit Product</h2>


    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">Products  </a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ul>

    <div class="row">

        <div class="col-md-12">
            <div class="tile mb-4">
                <form method="post" action="{{ route('dashboard.products.update',$product->id) }}"  enctype="multipart/form-data">>
                    @csrf
                    @method('put')

                    @include('dashboard.includes._errors')

                    <div class="form-body">
                        <h4 class="form-section"><i class="ft-home"></i> Product Data</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> Name <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $product->name }}" id="name" class="form-control" placeholder=" " name="name" required>
                                    @error("name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">description <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $product->description }}" id="description" class="form-control" placeholder=" " name="description" required>
                                    @error("description")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> Material <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $product->care }}" id="care" class="form-control" placeholder=" " name="care" required>
                                    @error("care")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> Category  </label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <?php echo $categories_drop_down; ?>
                                      </select>
                                    @error('category_id')
                                        <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Cover</label>
                                    <input type="file" name="cover" class="form-control image">
                                    @error('cover')
                                        <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  for="projectinput1">Discound</label>
                                    <input type="number" class="form-control form-control-lg" id="discount" name="discount" value="{{ $product->discount }}" required>
                                </div>
                            </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <img src="{{ $product->cover_path }}" class="img-thumbnail image-preview" style="width:100px">
                                    </div>
                                </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> color</label>
                                    <input type="text" value="{{ $product->color }}" id="color" required class="form-control"
                                        placeholder=" " name="color" required>
                                    @error("color")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> Code</label>
                                    <input type="text" value="{{ $product->code }}" id="code" required class="form-control"
                                        placeholder=" " name="code" required>
                                    @error("code")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> price</label>
                                    <input type="number" value="{{ $product->price }}" id="price" required class="form-control"
                                        placeholder=" " name="price" required>
                                    @error("price")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> status </label>
                                    <input type="checkbox" name="status" id="status" {{ $product->status == "active" ? 'checked' : "" }}  value="active">
                                    @error('status')
                                        <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> Feature Item </label>
                                    <input type="checkbox" name="feature_item" id="feature_item" {{ $product->feature_item == "1" ? 'checked' : "" }}  value="1">
                                    @error('feature_item')
                                        <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group text-left">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                    </div>
                </form>

            </div>

        </div>

    </div>

@endsection
