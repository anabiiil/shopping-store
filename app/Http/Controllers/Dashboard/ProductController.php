<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Images;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use Jenssegers\Date\Date;
use App\Models\Transaction;
use App\Models\OrderProduct;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

 class ProductController extends Controller
{

   // index page

   public function index()
   {


         $products =  Product::with('transactions')->get();
       // RETURN products INDEX PAGE
       return view('dashboard.products.index', compact('products'));
   }

   public function create()
   {
       // get all categories
        $categories = Category::where(['parent_id' => 0])->get();
		$categories_drop_down = "<option value='' selected disabled>All Category</option>";
		foreach($categories as $cat){
			$categories_drop_down .= "<option value='".$cat->id."'>".$cat->name."</option>";
			$sub_categories = Category::where(['parent_id' => $cat->id])->get();
			foreach($sub_categories as $sub_cat){
				$categories_drop_down .= "<option value='".$sub_cat->id."'>&nbsp;&nbsp;--&nbsp;".$sub_cat->name."</option>";
			}
		}


       // GO TO CREATE PAGE
       return view('dashboard.products.create',compact('categories_drop_down'));
   }

   // STORE DATA
   public function store(Request $request)
   {

        $validation = $request->validate([
            'name'                   => 'required|max:255',
            'description'            => 'required|max:1000',
            'status'                 => 'required|in:active,un_active',
            'category_id'            => 'required',
            'cover'                 => 'required|mimes:jpg,jpeg,png|image',
            'discount'               => 'required',
            'price'               => 'required',
            'code'               => 'required',
            'color'               => 'required',
            'care'               => 'required',
            'feature_item'         => 'required|in:0,1',
        ]);



       $request->merge(['external_id' => auth()->guard('admin')->user()->id , 'type' => 'admin']);

       !$request->has(['status','feature_item']) ?
        $request->request->add(['status' => 'un_active','feature_item'=>'0'])
        : $request->request->add(['status' => 'active','feature_item'=>'1']);

       $request_data = $request->except(['cover']);


            if($request->cover){
                Image::make($request->cover)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/products/cover/'.$request->cover->hashName()));

                $request_data['cover'] = $request->cover->hashName();
            }

            // return $request->feature_item;
            $product = Product::create($request_data);

       // return session with success msg
       session()->flash('success', "Product Has Been Added Succefully");
       // retun index
       return redirect()->route('dashboard.products.index');

   }//end of store

   public function edit(Request $request,$id)
   {
       // GET ELEMENT BY ID
        $product = Product::findOrFail($id);

		// Categories drop down start //

        $categories = Category::where(['parent_id' => 0])->get();

		$categories_drop_down = "<option value='' disabled>All Category</option>";
		foreach($categories as $cat){
			if($cat->id==$product->category_id){
				$selected = "selected";
			}else{
				$selected = "";
			}
			$categories_drop_down .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
			$sub_categories = Category::where(['parent_id' => $cat->id])->get();
			foreach($sub_categories as $sub_cat){
				if($sub_cat->id==$product->category_id){
					$selected = "selected";
				}else{
					$selected = "";
				}
				$categories_drop_down .= "<option value='".$sub_cat->id."' ".$selected.">&nbsp;&nbsp;--&nbsp;".$sub_cat->name."</option>";
			}
		}
		// Categories drop down end //


    // RETURN EDIT PAGE
    return view('dashboard.products.edit', compact('product','categories_drop_down'));

   }//end of edit

   public function update(Request $request,$id)
   {

        $products = Product::findOrFail($id);

       // Validate data

         $validation = $request->validate([
            'name'                   => 'required|max:255',
            'description'            => 'required|max:1000',
            'status'                 => 'required|in:active,un_active',
            'feature_item'           => 'required|in:1,0',
            'category_id'            => 'required',
            'discount'               => 'required',
            'color'                  => 'required',
            'price'                  => 'required',
            'code'                   => 'required',
            'care'                   => 'required',
        ]);

       $request->merge(['external_id' => auth()->guard('admin')->user()->id , 'type' => 'admin']);

       if (!$request->has(['status',]))
       $request->request->add(['status' => 'un_active']);
       else
       $request->request->add(['status' => 'active']);

       if (!$request->has('feature_item'))
       $request->request->add(['feature_item' => '0']);
       else
       $request->request->add(['feature_item' => '1']);

    //    return $request->all();
       $validation = $request->except(['cover']);

       if($request->cover){
           if($products->cover != 'default.png'){
               Storage::disk('public_uploads')->delete('/products/cover/'. $products->cover);
           }//end of inner if


               Image::make($request->cover)->resize(300, null, function ($constraint) {
                   $constraint->aspectRatio();
           })->save(public_path('uploads/products/cover/'.$request->cover->hashName()));

          $validation['cover'] = $request->cover->hashName();

       }
       $products->update($validation);
       // return session with success msg
       session()->flash('success', 'Product Has Been Updated Succefully');
       // RETURN INDEX PAGE
       return redirect()->route('dashboard.products.index');

   }

   public function destroy($id)
   {

        $product = Product::find($id);

        // return $product->images; die;

        // return $product->cover; die;
        $transaction = $product->transactions();

        $mainImages = $product->images();

        // $images = "";
        foreach($product->images as $img){
            $images[] = $img->name;
        }

        // return $images;die;

        // return $images == 'default.png' ? 'yes' : 'no' ;

        if (isset($transaction) || isset($images) && $transaction->count() > 0 || $images->count() > 0) {

            if ($product->cover != 'default.png') {
                Storage::disk('public_uploads')->delete('/products/cover/'.$product->cover);

            }elseif($images != 'default.png'){
                Storage::disk('public_uploads')->delete('/products/product_images/'.$images);
            }
            $transaction->delete();
            $mainImages->delete();
            $product->delete();
            session()->flash('success', 'Product Has Been Deleted Succefully');
            // RETURN INDEX PAGE
            return redirect()->route('dashboard.products.index');
        }


   }

   public function attribute(Request $request ,$id=null){

    $productDetails = Product::with(['transactions','category'])->where(['id' => $id])->first();

    $productDetails = json_decode(json_encode($productDetails));

    return view('dashboard.products.product_attributes')->with(compact('productDetails'));

   }
   public function addAttributes(Request $request, $id=null)
   {

        if($request->isMethod('post'))
        {

            $data = $request->all();

            foreach($data['size'] as $key => $val){
                if(!empty($val)){
                    $attrCountSizes = Transaction::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSizes>0){
                        session()->flash('success', 'Product Size Already Exist ');
                        return redirect('dashboard/products/add-attributes/'.$id);
                    }
                    $attr = Transaction::create([
                        'product_id'=> $id,
                        'size' => $data['size'][$key],
                        'price' => $data['price'][$key] ,
                        'stock' => $data['stock'][$key] ,
                        'sku' => $data['sku'][$key] ,
                    ]);
                    $attr->save();
                }
            }

            // for($i = 0 ; $i < count($data['size']) ; $i++)
            // {
            //     // return $data['size'][$key];
            //     $sizeCount = Transaction::where([ 'size'=>$data['size']])->count();
            //     if($sizeCount > 1){
            //         // dd('true');
            //         return redirect('dashboard/products/add-attributes/'.$id)->with('flash_message_success', '  لا يمكن Add الحجم مرتين    ');
            //     }

            //     $attr = Transaction::create([
            //         'product_id'=> $id,
            //         'size' => $data['size'][$i],
            //         'price' => $data['price'][$i] ,
            //         'stock' => $data['stock'][$i] ,
            //     ]);

            //     $attr->save();

            session()->flash('success', 'Product Attribute Has Been Added Succefully');
            return redirect('dashboard/products/attributes/'.$id);

        }
        // if($request->isMethod('post')){

        //     // $data = $request->all();
        //     $data = $request->except(['_token','product_id']);


        //         // return $request->all();
        //         $attr = Transaction::create([
        //             'product_id'=> $id,
        //             'size' => json_encode($data['size']),
        //             'color' => json_encode($data['color']),
        //             'purchase_price' => json_encode($data['purchase_price']),
        //             'price' =>json_encode($data['price']),
        //         ]);





        //     return redirect('dashboard/products/add-attributes/'.$id)->with('flash_message_success', ' تمت الAdd بنجاح');

        // }
     }

    public function editAttributes(Request $request, $id=null){

        // return $request->all();
        $transactions = Transaction::findOrFail($request->trans_id);
        // return $transactions->product_id;
        $validation = Validator::make($request->all(), [
            'size'                 => 'required',
            'price'              => 'required',
            'stock'              => 'required',
            'sku'              => 'required',
         ]);
         if ($validation->fails()) {
            return redirect('dashboard/products/attributes/'.$id)->withErrors($validation)->with('edit_transaction','edit_error');
          }


        $getPrice = Cart::where(['product_id' =>$transactions->product_id ])->first();

        if(empty($getPrice)){
            $transactions->update([
                'size' => $request->size,
                'price'=>$request->price,
                'stock'=>$request->stock,
                'sku'=>$request->sku,
              ]);
              session()->flash('success', 'Product Attribute Has Been Updated Succefully');
              return redirect('dashboard/products/attributes/'.$id);
        }else{
            $transactions->update([
                'size' => $request->size,
                'price'=>$request->price,
                'stock'=>$request->stock,
                'sku'=>$request->sku,
              ]);
            $getPrice->update([
                'price' => $transactions->price,
            ]);
            session()->flash('success', 'Product Attribute Has Been Updated Succefully');
            return redirect('dashboard/products/attributes/'.$id);
        }
    }

    public function deleteAttribute($id)
    {

         Transaction::find($id)->delete();
        // return session with success msg
        session()->flash('success', 'Product Attribute Has Been Deleted Succefully');
         // RETURN INDEX PAGE
        return back();

    }

    public function product_images(Request $request , $id)
    {

        $productImages = Product::with(['category','images'])->where(['id' => $id])->first();
        // return $productDetails->images;
        if($request->isMethod('post'))
        {

            if($request->hasFile("image")){
                $files = $request->file('image');
                $array = [];
                foreach($files as $file)
                {
                    $img = new Images();
                    $name = time().'-'.$file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());
                    $image_resize->resize(300,300);
                    $image_resize->save(public_path('uploads/products/product_images/'.$name));
                    $img->create(['name'=>$name,'product_id'=>$id]);
                }
            }
            session()->flash('success', 'Product Images Has Been Added Succefully');
            return redirect('dashboard/products/product-images/'.$id);

        }
        return view('dashboard.products.product_images',compact('productImages'));
    }

    public function update_images(Request $request , $id)
    {

        $prodImages = Images::findOrFail($request->image_id);

        $request_data = $request->all();

        if ($request->image) {


            if ($prodImages->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/product_images/' . $prodImages->image);

            }//end of if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/products/product_images/' . $request->image->hashName()));

            $request_data['name'] = $request->image->hashName();


        }//end of if

        // return $request_data;

        $prodImages->update($request_data);

            session()->flash('success', 'Product Image Has Been updated Succefully');
         // RETURN INDEX PAGE
        return back();

    }

    public function delete_images( $id)
    {

        $images  = Images::find($id);

        if ($images->name != 'default.png') {
            Storage::disk('public_uploads')->delete('/products/product_images/'.$images->name);
        }//end of if

        $images->delete();
        // return session with success msg
        session()->flash('success', 'Product Image Has Been Deleted Succefully');
        // RETURN INDEX PAGE
        return back();
    }


    public function products($url=null){

    	// Show 404 Page if Category does not exists

        $banners = Banner::where('status','1')->get();

        $categoryCount = Category::where(['url'=>$url,'status'=>'active'])->count();
         if($categoryCount==0){
            return view('front.includes.404');
         }


        // get main categories with sub categories
    	$categories = Category::with('child_categories')->where(['parent_id' => 0])->get();

        // get category with matching url ... url in link == url in category table
    	$categoryDetails = Category::where(['url'=>$url])->first();

        if($categoryDetails->parent_id==0){
            // if url is main category
            //get all sub categories particular main category
    		$subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
    		$subCategories = json_decode(json_encode($subCategories));


    		foreach($subCategories as $subcat){
                $cat_ids[] = $subcat->id;
    		}
            // print_r($cat_ids);die;
    	    $productsAll = Product::with('transactions','fav')->whereIn('category_id', $cat_ids)->where('status','active')->orderBy('products.id','Desc');
     	}else{
            //if url is sub category
     		$productsAll = Product::with('transactions','fav')->where(['category_id'=>$categoryDetails->id])->where('status','active')->orderBy('products.id','Desc');
            $mainCategory = Category::where('id',$categoryDetails->parent_id)->first();
     	}



        $productsAll = $productsAll->paginate(6);
        /*$productsAll = json_decode(json_encode($productsAll));
        echo "<pre>"; print_r($productsAll); die;*/


        /*echo "<pre>"; print_r($sizesArray); die;*/

        $meta_title = $categoryDetails->meta_title;
        $meta_description = $categoryDetails->meta_description;
    	$meta_keywords = $categoryDetails->meta_keywords;

    	return view('front.products.listing_product')->with(compact('categories','productsAll','banners','categoryDetails','meta_title','meta_description','meta_keywords','url'));
    }




    public function product($id = null){

        $productCount = Product::where(['id'=>$id,'status'=>'active'])->count();
        if($productCount==0){
            return view('front.includes.404');

        }

        // Get Product Details
        $productDetails = Product::with('transactions')->where('id',$id)->first();

        $relatedProducts = Product::where('id','!=',$id)->where(['category_id' => $productDetails->category_id])->get();


        // Get Product Alt Images
        $productAltImages = Images::where('product_id',$id)->get();



        $categories = Category::with('child_categories')->where(['parent_id' => 0])->get();

        $total_stock = Transaction::where('product_id',$id)->sum('stock');

        $meta_title = $productDetails->product_name;
        $meta_description = $productDetails->description;
        $meta_keywords = $productDetails->product_name;

        return view('front.products.details',compact('productDetails','categories','productAltImages','total_stock','relatedProducts','meta_title','meta_description','meta_keywords'));
    }

    public function search_product(Request $request){
        $data = $request->all();

        $categories = Category::with('child_categories')->where(['parent_id' => 0])->get();

        $search_product = $data['product'];

        $banners  = Banner::get();

        $productsAll = Product::where(function($query) use($search_product){
            $query->where('name','like','%'.$search_product.'%')
            ->orWhere('code','like','%'.$search_product.'%')
            ->orWhere('description','like','%'.$search_product.'%')
            ->orWhere('color','like','%'.$search_product.'%');
        })->where('status','active')->get();

        $breadcrumb = "<a href='/'>Home</a> / ".$search_product;

        return view('front.products.listing_product')->with(compact('categories','productsAll','search_product','banners','breadcrumb'));
    }

    public static function countItem(){
        $user = request()->user();
        if($user){
            return Cart::where('user_id',$user->id)->sum('quantity');
        }
    }

    public function addtocart(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();

         if(empty(Auth::user()->email)){
            $data['user_email'] = '';
        }else{
            $data['user_email'] = Auth::user()->email;
        }

        $countProducts = DB::table('carts')->where(['product_id' => $data['product_id'],'user_id' =>auth()->user()->id,'color' => $data['color'],
        'size' => $data['size']])->count();

        if($countProducts>0){
            session()->flash('success', 'Product Already Exist In Cart');
            return redirect()->back();
        }else{

            $getSKU = Transaction::select('sku','price')->where(['product_id' => $data['product_id'], 'size' => $data['size']])->first();

            $cart = new Cart;
            $cart->user_id =  auth()->user()->id;
            $cart->user_email =  auth()->user()->email;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->name = $request->name;
            $cart->code = $getSKU['sku'];
            $cart->color = $request->color;
            $cart->price = $getSKU['price'];
            $cart->size = $request->size;
            $cart->save();
            session()->flash('success', 'Product Has Been Added Succefully To Cart');
            return redirect('cart');

        }




    }
    public function cart(Request $request){

       $userCart = DB::table('carts')->where(['user_id' => Auth::user()->id])->get();
        foreach($userCart as $key => $product){
            // return $product->size;

             $productDetails = Product::where(['id'=>$product->product_id])->first();

            // return $productDetails->id;
            $transDetails = Transaction::where(['product_id'=>$productDetails->id])->first();

            $userCart[$key]->cover = $productDetails->cover_path;

            // $userCart[$key]->price = $transDetails->price;

        }
        // return $userCart;
        return view('front.products.cart',compact('userCart'));
    }

    public function delete_cart(Request $request , $id){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $cart = Cart::find($id)->delete();
        session()->flash('success', 'Product Has Been Deleted Succefully from Cart');
        return redirect('cart');

    }

    public function updateCartQuantity(Request $request , $id = null , $quantity = null){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $getProductSku = Cart::select('code','quantity')->where('id',$id)->first();
        $getProductStock = Transaction::where('sku',$getProductSku->code)->first();
        $updated_quantity = $getProductSku->quantity+$quantity;
        if($getProductStock->stock>=$updated_quantity){
            DB::table('carts')->where('id',$id)->increment('quantity',$quantity);
            session()->flash('success', 'Quantity Has Been Updated Succefully');
            return redirect('cart');
        }else{
            session()->flash('success', 'Not Fount Another Quantity');
            return redirect('cart');
        }
    }

    public function applyCoupon(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        //check if coupon code is exist in coupon table

        // return $request->all();
        $data = $request->all();

        $coupon_code = Coupon::where(['coupon_code' => $request->coupon_code ])->count();

        if($coupon_code == 0){
            session()->flash('success', 'Not Found Coupone Like This Name');
            return redirect()->back();
        }
        else
        {

                //check if coupon is un active
                $coupon = Coupon::where(['coupon_code' => $request->coupon_code ])->first();
                if($coupon->status == 'un_active'){
                    session()->flash('success', 'Coupone Is Unactive');
                    return redirect()->back();
                }
                //check if coupon is expired
                $current_date = date('Y-m-d');
                if($current_date > $coupon->expiry_date){
                    session()->flash('success', 'This Coupone Is Expired');
                    return redirect()->back();

                }
                //get total amount
                $user_id = auth()->user()->id;
                $getItem = Cart::where('user_id' , $user_id)->get();
                $total_amount = 0;
                foreach($getItem as $item){
                    $total_amount = $total_amount + ($item->price * $item->quantity) ;
                }

                //Check if amount type is Fixed or Percentage

                if($coupon->amount_type == 'Fixed'){
                    $couponAmount = $coupon->amount;
                }else{
                    $couponAmount =   $total_amount * ( $coupon->amount / 100);
                }

                 // Add Coupon Code & Amount in Session
                Session::put('CouponAmount',$couponAmount);
                Session::put('CouponCode',$data['coupon_code']);
                session()->flash('success', 'Coupone is work ? You Have a Discound Now ');
                 return redirect()->back();

        }

    }

    public function checkout(Request $request){
        $user_id = Auth::user()->id;

        $userDetails = User::find($user_id);
        $countries = Country::get();

        // Check if Shipping Address exists
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        $shippingDetails = array();
        if($shippingCount>0){
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }

        return view('front.products.checkout')->with(compact('userDetails','countries','shippingDetails'));
    }
    public function docheckout(Request $request){

        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;

        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        // Return to Checkout page if any of the field is empty
        if(empty($data['billing_name']) || empty($data['billing_address']) || empty($data['billing_city'])  || empty($data['billing_country']) || empty($data['billing_pincode']) || empty($data['billing_mobile']) || empty($data['shipping_name']) || empty($data['shipping_address']) || empty($data['shipping_city'])  || empty($data['shipping_country']) || empty($data['shipping_pincode']) || empty($data['shipping_mobile'])){
            session()->flash('success', 'Please enter all Data');
            return redirect()->back();
        }

        // Update User details
        User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],'pincode'=>$data['billing_pincode'],'country'=>$data['billing_country'],'mobile'=>$data['billing_mobile']]);

        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        if($shippingCount>0){
            // Update Shipping Address
            DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],'city'=>$data['shipping_city'],'pincode'=>$data['shipping_pincode'],'country'=>$data['shipping_country'],'mobile'=>$data['shipping_mobile']]);
        }else{
            // Add New Shipping Address
            $shipping = new DeliveryAddress;
            $shipping->user_id = $user_id;
            $shipping->user_email = $user_email;
            $shipping->name = $data['shipping_name'];
            $shipping->address = $data['shipping_address'];
            $shipping->city = $data['shipping_city'];
             $shipping->pincode = $data['shipping_pincode'];
            $shipping->country = $data['shipping_country'];
            $shipping->mobile = $data['shipping_mobile'];
            $shipping->save();
        }
        return redirect('/order-review');


    }

    public function orderReview(){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        $shippingDetails = json_decode(json_encode($shippingDetails));
        $userCart = DB::table('carts')->where(['user_id' => $user_id])->get();
        foreach($userCart as $key => $product){
             $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->cover = $productDetails->cover_path;

        }
        // echo "<pre>"; print_r($userCart); die;
        return view('front.products.order_review')->with(compact('userDetails','shippingDetails','userCart'));
    }

    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            // Get Shipping Address of User
            $shippingDetails = DeliveryAddress::where(['user_id' => $user_id])->first();

            /*echo "<pre>"; print_r($data); die;*/

            // dd(session()->get('CouponCode'));
            if(empty(Session::get('CouponCode'))){
               $coupon_code = 'null';
            }else{
               $coupon_code = Session::get('CouponCode');
            }


            if(empty(Session::get('CouponAmount'))){
               $coupon_amount = '0';
            }else{
               $coupon_amount = Session::get('CouponAmount');
            }

            // return $coupon_amount;
            $order = new Order;
            $order->name = $shippingDetails->name;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->pincode = $shippingDetails->pincode;
            $order->country = $shippingDetails->country;
            $order->mobile = $shippingDetails->mobile;
            $order->coupone_code = $coupon_code;
            $order->coupone_amount = $coupon_amount;
            $order->shipping_charges = 0;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->grand_total = $data['grand_total'];
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();

            $cartProducts = DB::table('carts')->where(['user_email'=>$user_email])->get();
            foreach($cartProducts as $pro){
                $cartPro = new OrderProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->code;
                $cartPro->product_name = $pro->name;
                $cartPro->product_color = $pro->color;
                $cartPro->product_size = $pro->size;
                $cartPro->product_price = $pro->price;
                $cartPro->product_qty = $pro->quantity;
                $cartPro->save();
            }

            Session::put('order_id',$order_id);
            Session::put('grand_total',$data['grand_total']);

            if($data['payment_method']=="COD"){

                $productDetails = Order::with('orders')->where('id',$order_id)->first();
                $productDetails = json_decode(json_encode($productDetails),true);
                /*echo "<pre>"; print_r($productDetails);*/ /*die;*/

                $userDetails = User::where('id',$user_id)->first();
                $userDetails = json_decode(json_encode($userDetails),true);
                /*echo "<pre>"; print_r($userDetails); die;*/
                /* Code for Order Email Start */
                $email = $user_email;
                $messageData = [
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails
                ];
                // Mail::send('emails.order',$messageData,function($message) use($email){
                //     $message->to($email)->subject('Order Placed - E-com Website');
                // });
                /* Code for Order Email Ends */

                // COD - Redirect user to thanks page after saving order
                return redirect('/thanks');
            }else if($data['payment_method']=="Paypal"){
                // Paypal - Redirect user to paypal page after saving order
                return redirect('/paypal');
            }else if($data['payment_method']=="stripe"){
                return redirect('/stripe');
            }
            else{
                return redirect('/paypal-sdk');
            }


        }
    }


    public function thanks(Request $request){
        $user_email = Auth::user()->email;
        DB::table('carts')->where('user_email',$user_email)->delete();
        return view('front.orders.thanks');
    }



    public function viewOrders(){
        $orders = Order::with('orders')->orderBy('id','Desc')->get();
        return view('dashboard.orders.view_orders')->with(compact('orders'));
    }

    public function viewOrderDetails($order_id){
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('dashboard.orders.order_details')->with(compact('orderDetails','userDetails'));
    }

    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            session()->flash('success', 'Order Status has been updated successfully!');
            return redirect()->back();
        }
    }
    public function viewOrderInvoice($order_id){
        // if(Session::get('adminDetails')['orders_access']==0){
        //     return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        // }
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        /*echo "<pre>"; print_r($orderDetails); die;*/
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        /*$userDetails = json_decode(json_encode($userDetails));
        echo "<pre>"; print_r($userDetails);*/
        return view('dashboard.orders.order_invoice')->with(compact('orderDetails','userDetails'));
    }

    public function viewOrdersCharts(){


        $current_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $last_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $last_to_last_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
        return view('dashboard.orders.view_orders_charts')->with(compact('current_month_orders','last_month_orders','last_to_last_month_orders'));
    }

}
