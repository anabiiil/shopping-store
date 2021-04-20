<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\Console\Input\Input;

use App\Models\Coupon;
use App\Models\Role;

class CouponsController extends Controller
{
    // index page
    public function index()
    {
        // GET PAGINATE DATA
        $coupons =  Coupon::get();
        // RETURN COUPONS INDEX PAGE
        return view('dashboard.coupons.index', compact('coupons'));
    }

    public function create()
    {
        // GO TO CREATE PAGE
        return view('dashboard.coupons.create');
    }

    // STORE DATA
    public function store(Request $request)
    {
         //Validate data
        $request->validate([
            'coupon_code' => 'required|unique:coupons,coupon_code|max:15',
            'amount' => 'required|numeric|min:0|max:99',
            'amount_type' => 'required',
            'expiry_date'=> 'required|date|date_format:Y-m-d',
            'status' => 'required|in:active,un_active',
        ]);
        // implement model
        $store = Coupon::create($request->all());
        // return session with success msg
        session()->flash('success', "Coupone Has Been Added Succefully");
        // retun index
        return redirect()->route('dashboard.coupons.index');
    }//end of store

    public function edit(Request $request,$id)
    {
        // GET ELEMENT BY ID
        $coupon = Coupon::findOrFail($id);
        // RETURN EDIT PAGE
        return view('dashboard.coupons.edit', compact('coupon'));

    }//end of edit

    public function update(Request $request,$id)
    {
        try{

        // Validate data
        $request->validate([
            'coupon_code' => 'required|max:20|unique:coupons,coupon_code,'. $id,
            'amount' => 'required|numeric|min:0|max:99',
            'amount_type' => 'required',
            'expiry_date'=> 'required|date|date_format:Y-m-d',
            'status' => 'required|in:active,un_active',
        ]);
        // GET ELEMENT BY ID
        $coupon = Coupon::findOrFail($id)->update($request->all());
        // return session with success msg
        session()->flash('success', "Coupone Has Been Updated Succefully");
        // RETURN INDEX PAGE
        return redirect()->route('dashboard.coupons.index');
         }catch(\Exception $ex){
            dd($ex);
            return redirect()->route('dashboard.coupons.index')->with('error','هناك خطا ما ');

        }

    }

    public function destroy(Coupon $coupon)
    {
        // DELETE ELEMENT WITH ID
        $coupon->delete();
        // return session with success msg
        session()->flash('success', 'Coupone Has Been Deleted Succefully');
        // RETURN INDEX PAGE
        return redirect()->route('dashboard.coupons.index');

    }
}
