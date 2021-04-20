<?php

namespace App\Http\Controllers\front;

use App\Models\Order;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Transaction;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    public function index()
    {


        // $images = Images::where(['product_id'=>1])->get();
        // $images = json_decode(json_encode($images));

        //  foreach($images as $img){
        //     $img_ids[] = $img->product_id;
        // }
        // // print_r($img_ids);die;
        // foreach (OrderProduct::where('product_id',$img_ids)->get() as $key => $value) {
        //     dd($value->product->images()->first()->product);
        // }

        // $products = Product::with('transactions')->orderBy('id','DESC')->get();

        $products = Product::with('transactions','fav')->inRandomOrder()->where(['status'=>'active','feature_item'=>'1'])->paginate(3);


        $categories = Category::with('child_categories')->where('parent_id' , 0)->get();

        $banners = Banner::where('status','1')->get();
        // Meta tags
        $meta_title = "E-shop Sample Website";
        $meta_description = "Online Shopping Site for Men, Women and Kids Clothing";
        $meta_keywords = "eshop website, online shopping, men clothing";

        return view('front.index',compact('products','categories','banners','meta_title','meta_description','meta_keywords'));
    }

    public function change_price(Request $request){

        // return $request->all();
        $trans = Transaction::find($request->id);
        return response()->json([
            'data' => Transaction::find($request->id),
         ], 200);

    }
    public function userOrders(){
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        /*$orders = json_decode(json_encode($orders));
        echo "<pre>"; print_r($orders); die;*/
        return view('front.orders.user_orders')->with(compact('orders'));
    }

    public function userOrderDetails($order_id){
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        /*echo "<pre>"; print_r($orderDetails); die;*/
        return view('front.orders.user_order_details')->with(compact('orderDetails'));
    }

    public function favorite(Request $request , $id=null){


        $product = Product::where('id',$id)->first();
        $userId = auth()->user()->id;
        $fav = Favorite::where('user_id',$userId)->where('product_id',$product->id)->first() ;
         if($fav){
            $fav->delete();
            return response()->json([
                'status' => 'The product has been removed from the Favorite',
                'count' => Favorite::count(),
                ]
            );
         }else{
            Favorite::create([
                'user_id' => $userId,
                'product_id' => $product->id,
            ]);
            return response()->json([
                'status' => 'The product has been added To the Favorite',
                'count' => Favorite::count(),
                ]);

         }

    }
    public function product_favorite(){
        $userId = auth()->user()->id;
        $favorite_products = Favorite::with('product')->where('user_id' , $userId)->get();
        $categories = Category::with('child_categories')->where(['parent_id' => 0])->get();
        $favorite_products_count = Favorite::with('product')->where('user_id' , $userId)->count();
        if($favorite_products_count == 0){
            session()->flash('success', 'There are no favorite products');
            return redirect()->back();
        }
        foreach($favorite_products as $fav){
            $pro_ids[] = $fav->product_id;
        }
        $product_all = Product::with('transactions')->whereIn('id',$pro_ids)->where('status','active')->get();
        return view('front.products.favorite_products',compact('product_all','categories'));
    }



}
