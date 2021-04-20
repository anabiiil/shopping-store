@php
    use App\Models\Product;
@endphp
<div class="left-sidebar">
    <h2>Category</h2>
        <div class="panel-group category-products" id="accordian">
            <!--category-products-->

            @foreach($categories as $cat)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$cat->id}}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{$cat->name}}
                        </a>
                    </h4>
                </div>
                <div id="{{$cat->id}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach($cat->child_categories as $subcat)
                                <?php $productCount = Product::productCount($subcat->id); ?>
                                @if($subcat->status== 'active' )
                                <li><a href="{{ asset('products/'.$subcat->url) }}">{{$subcat->name}} </a> ({{ $productCount }})</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
    </div><!--/category-products-->

    {{-- @if(!empty($url))

    <h2>Colors</h2>
    <div class="panel-group">
        @foreach($colorArray as $color)
            @if(!empty($_GET['color']))
                <?php $colorArr = explode('-',$_GET['color']) ?>
                @if(in_array($color,$colorArr))
                    <?php $colorcheck="checked"; ?>
                @else
                    <?php $colorcheck=""; ?>
                @endif
            @else
                <?php $colorcheck=""; ?>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <input name="colorFilter[]" onchange="javascript:this.form.submit();" id=" " value=" " type="checkbox" {{ $colorcheck }}>&nbsp;&nbsp;<span class="products-colors">{{ $color }}</span>
                    </h4>
                </div>
            </div>
        @endforeach
    </div>

    <div>&nbsp;</div>




    <h2>Size</h2>
    <div class="panel-group">
        @foreach($sizesArray as $size)
            @if(!empty($_GET['size']))
                <?php $sizeArr = explode('-',$_GET['size']) ?>
                @if(in_array($size,$sizeArr))
                    <?php $sizecheck="checked"; ?>
                @else
                    <?php $sizecheck=""; ?>
                @endif
            @else
                <?php $sizecheck=""; ?>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <input name="sizeFilter[]" onchange="javascript:this.form.submit();" id=" " value=" " type="checkbox" {{ $sizecheck }}>&nbsp;&nbsp;<span class="products-sizes">{{ $size }}</span>
                    </h4>
                </div>
            </div>
        @endforeach
    </div>

    <div>&nbsp;</div> --}}

{{-- @endif --}}
</div>
