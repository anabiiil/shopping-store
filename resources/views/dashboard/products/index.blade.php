@extends('layouts.dashboard')
@push('css')
<style>
    .cus-pro {
        background: #1c4e80;
        color: #f2f2f2;
        display: inline-block;
        width: 80px;
        text-align: center;
        height: 36px;
        margin-left: 10px;
        border-radius: 5px;
        font-size: 12px;
        line-height: 33px;
        text-decoration: none
    }

</style>
@endpush
@section('content')

<div>
    <h2> Products </h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
    <li class="breadcrumb-item active"> Products </li>
    @if (auth()->guard('admin')->user()->hasPermission('create_products'))
        <li class="breadcrumb-item"><a href="{{ route('dashboard.products.create') }}"> Add New Product </a></li>
    @endif
</ul>

<div class="row">

    <div class="col-md-12">

        <div class="tile mb-4">



            <div class="row">
                <div class="col-md-12">
                    @if ($products->count() > 0)
                    <table class="table table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>color</th>
                                <th>Description</th>
                                <th>Material</th>
                                <th>Discound</th>
                                <th>price</th>
                                <th>Code</th>
                                <th>Category Name</th>
                                <th>Cover</th>
                                <th>Status</th>
                                <th>Feature Item</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->color }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->care }}</td>
                                <td>{{ $product->discount }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    <img src="{{ $product->cover_path }}" style="width:60px;height:60px" alt="image"
                                        class="img-thumbnail">
                                </td>
                                <td>
                                    @if($product->getActive() == 'active')
                                    <span class="btn-sm btn-success">{{ $product->getActive() }}</span>
                                    @else
                                    <span class="btn-sm btn-danger">{{ $product->getActive() }}</span>
                                    @endif
                                </td>
                                <td>{{ $product->feature_item }}</td>



                                <td>
                                    <div class="dropdown">
                                        <button aria-expanded="false" aria-haspopup="true"
                                            class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                            type="button"><i class="fa fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu tx-13">

                                            @if (auth()->guard('admin')->user()->hasPermission('update_products'))
                                            <a href="{{ route('dashboard.products.edit', $product->id) }}" class="dropdown-item">
                                                Edit
                                            </a>
                                            @endif
                                            @if (auth()->guard('admin')->user()->hasPermission('delete_products'))
                                            <form method="post" action="{{ route('dashboard.products.destroy', $product->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="deleteprodcuts dropdown-item">
                                                    Delete
                                                </button>
                                            </form><!-- end of form -->
                                            @endif

                                            <a href="{{ url('/dashboard/products/attributes/'.$product->id) }}"   class="dropdown-item">
                                                Add Attribute
                                            </a>
                                            <a class="dropdown-item" href="{{ url('dashboard/products/product-images/'.$product->id) }}">
                                                Add Images
                                            </a>


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

        <!-- Start Image Modal -->
        <div class="modal fade" id="imageModal" name="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row" id="data"></div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- End Image Modal -->

    </div><!-- end of col -->

</div><!-- end of row -->

@endsection


@push('js')
<script>
    $(document).ready(function () {

        $('.deleteprodcuts').click(function (e) {

            var that = $(this)

            e.preventDefault();

            var n = new Noty({
                text: "Delete This Product will lead to Delete Images And Attribute which linked with it",
                type: "warning",
                killer: true,
                buttons: [
                    Noty.button("Yes", 'btn btn-success mr-2', function () {
                        that.closest('form').submit();
                    }),

                    Noty.button("No", 'btn btn-primary mr-2', function () {
                        n.close();
                    })
                ]
            });

            n.show();


        })
        // $('#imageModal').on('show.bs.modal', function (event) {
        //         $('.all_images').remove();
        //         //console.log("as");
        //         var button = $(event.relatedTarget)
        //         //var title = button.data('mytitle')

        //         var name = button.data('name')
        //        console.log(name)
        //         var $data = '' ;
        //          //console.log(name[0].name);
        //         // var $s = name.forEach(myFunction);
        //         // function myFunction() {
        //         //     document.getElementById("data").innerHTML +=
        //         //     `<div class="all_images">
        //         //         <img class="img-fluid" style="width:260px;margin:0 98px 50px;text-align:center;display:block;" src={{ asset('uploads/employee_images') }}`+`/`+name[0].name+`>
        //         //     </div>`;
        //         // }
        //         // console.log(s$);
        //         for (i in name) {

        //             // console.log(name[i].name);
        //             $data += `
        //             <div class="all_images">
        //                 <img class="img-fluid" style="width:260px;margin:0 98px 50px;text-align:center;display:block;" src={{ asset('uploads/product_images') }}`+`/`+name[i].name+`>
        //             <div>
        //             `;
        //         }
        //         // console.log($data);
        //         var modal = $(this)
        //         modal.find('.modal-body #data').append($data);
        //         });
    });

</script>
@endpush
