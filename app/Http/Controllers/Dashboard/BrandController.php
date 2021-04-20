<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{

    // index page
    public function index()
    {
        // GET PAGINATE DATA
        $brands =  Brand::get();
        // RETURN brands INDEX PAGE
        return view('dashboard.brands.index', compact('brands'));
    }

    public function create()
    {
        // GO TO CREATE PAGE
        return view('dashboard.brands.create');
    }

    // STORE DATA
    public function store(Request $request)
    {
        // return $request->all();
        // Validate data
        $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|in:admin,vendor',
            'status' => 'required|in:approved,pending,decline',
        ]);

        $request->merge(['external_id' => auth()->guard('admin')->user()->id]);

        // implement model
        $store = Brand::create($request->all());


        // return session with success msg
        session()->flash('success', "Brand has been Added successfully");
        // retun index
        return redirect()->route('dashboard.brands.index');

    }//end of store

    public function edit(Request $request,$id)
    {
        // GET ELEMENT BY ID
        $brand = Brand::findOrFail($id);
        // RETURN EDIT PAGE
        return view('dashboard.brands.edit', compact('brand'));

    }//end of edit

    public function update(Request $request,$id)
    {
        // Validate data
        $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|in:admin,vendor',
            'status' => 'required|in:approved,pending,decline',
        ]);
        // GET ELEMENT BY ID
        $brand = Brand::findOrFail($id)->update($request->all());
        // return session with success msg
        session()->flash('success', 'Brand has been updated successfully');
        // RETURN INDEX PAGE
        return redirect()->route('dashboard.brands.index');

    }

    public function destroy(Brand $brand)
    {
        // DELETE ELEMENT WITH ID
        $brand->delete();
        // return session with success msg
        session()->flash('success', 'Brand has been deleted successfully');
        // RETURN INDEX PAGE
        return redirect()->route('dashboard.brands.index');

    }
}
