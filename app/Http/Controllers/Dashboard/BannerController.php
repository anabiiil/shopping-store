<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Banner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{

   // index page
   public function index()
   {
       // GET PAGINATE DATA
       $banners =  Banner::get();
       // RETURN banners INDEX PAGE
       return view('dashboard.banners.index', compact('banners'));
   }

   public function create()
   {
       // GO TO CREATE PAGE
       return view('dashboard.banners.create');
   }

   // STORE DATA
   public function store(Request $request)
   {

        //Validate data
        $request->validate([
        'image'                 => 'required|mimes:jpg,jpeg,png|image',
        'title'                 => 'required',
        'link'                 => 'required',
        // 'status'                => 'required|in:1,0',
       ]);

            if (!$request->has('status'))
            $request->request->add(['status' => 0]);

            $data = $request->except(['image']);

            if($request->image){
                Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/banners/'.$request->image->hashName()));

                $data['image'] = $request->image->hashName();
            }
            // return $data;
            $banners = Banner::create($data);

       // return session with success msg
       session()->flash('success', "Banner has been Added successfully");
       // retun index
       return redirect()->route('dashboard.banners.index');

   }//end of store

   public function edit(Request $request,$id)
   {
       // GET ELEMENT BY ID
       $banner = Banner::findOrFail($id);
       // RETURN EDIT PAGE
       return view('dashboard.banners.edit', compact('banner'));

   }//end of edit

   public function update(Request $request,$id)
   {

        $banners = Banner::findOrFail($id);

       // Validate data
       $validation = Validator::make($request->all(), [
        'image'                 => 'required|mimes:jpg,jpeg,png|image',
        'title'                 => 'required',
        'link'                 => 'required',
       ]);


       if (!$request->has('status'))
       $request->request->add(['status' => '0']);
       else
       $request->request->add(['status' => '1']);


       $validation = $request->except(['image']);

       if($request->image){
           if($banners->image != 'default.png'){
               Storage::disk('public_uploads')->delete('/banners/'. $banners->image);
           }//end of inner if


               Image::make($request->image)->resize(300, null, function ($constraint) {
                   $constraint->aspectRatio();
           })->save(public_path('uploads/banners/'.$request->image->hashName()));

          $validation['image'] = $request->image->hashName();

       }
       $banners->update($validation);
       // return session with success msg
       session()->flash('success', 'Banner has been updated successfully');
       // RETURN INDEX PAGE
       return redirect()->route('dashboard.banners.index');

   }

   public function destroy(Banner $banner)
   {
       // DELETE ELEMENT WITH ID
       $banner->delete();
       // return session with success msg
       session()->flash('success', 'Banner has been Deleted successfully');
       // RETURN INDEX PAGE
       return redirect()->route('dashboard.banners.index');

   }
}
