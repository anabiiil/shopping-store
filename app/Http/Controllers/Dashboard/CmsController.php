<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\CmsPage;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CmsController extends Controller
{
    public function index()
    {
        $cmsPages = CmsPage::get();
        return view('dashboard.pages.index', compact('cmsPages'));
    }//end of index

    public function create()
    {
        return view('dashboard.pages.create');

    }//end of create

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'url'                   => 'required',
            'description'            => 'required|max:1000',
            'status'                 => 'required|in:1,0',
            'title'                 => 'required',

           ]);

           !$request->has(['status']) ?
            $request->request->add(['status' => '0'])
            : $request->request->add(['status' => '1']);

              // return $request->feature_item;
              $product = CmsPage::create($request->all());

              // return session with success msg
              session()->flash('success', "Page Has Been Added Succefully");
              // retun index
              return redirect()->route('dashboard.cmsPages.index');

    }//end of store

    public function edit(Request $request , $id)
    {
        // GET ELEMENT BY ID
        $cmspage = CmsPage::findOrFail($id);
        // RETURN EDIT PAGE
        return view('dashboard.pages.edit', compact('cmspage'));

    }//end of edit

    public function update(Request $request,$id)
    {
        $cmspage = CmsPage::findOrFail($id);

        // Validate data
        $validation = Validator::make($request->all(), [
            'url'                   => 'required',
            'description'            => 'required|max:1000',
            'status'                 => 'required|in:1,0',
            'title'                 => 'required',
        ]);


        if (!$request->has(['status',]))
        $request->request->add(['status' => '0']);
        else
        $request->request->add(['status' => '1']);

        $cmspage->update($request->all());
        // return session with success msg
        session()->flash('success', 'Page Has Been Updated Succefully');
        // RETURN INDEX PAGE
        return redirect()->route('dashboard.cmsPages.index');


    }//end of update

    public function destroy($id)
    {

        $cmspage = CmsPage::find($id)->delete();
        session()->flash('success', 'Page Has Been Deleted Succefully');
        // RETURN INDEX PAGE
        return redirect()->route('dashboard.cmsPages.index');

    }//end of destroy

    public function cmsPage($url){

        // Redirect to 404 if CMS Page is disabled or does not exists
        $cmsPageCount = CmsPage::where(['url'=>$url,'status'=>1])->count();
        if($cmsPageCount>0){
            // Get CMS Page Details
            $cmsPageDetails = CmsPage::where('url',$url)->first();
            $meta_title = $cmsPageDetails->meta_title;
            $meta_description = $cmsPageDetails->meta_description;
            $meta_keywords = $cmsPageDetails->meta_keywords;
        }else{
            return view('front.includes.404');

        }

        // Get All Categories and Sub Categories
        $categories = Category::with('child_categories')->where(['parent_id' => 0])->get();

        return view('dashboard.pages.cms_page')->with(compact('cmsPageDetails','categories','meta_title','meta_keywords','meta_description'));
    }

    public function contact(Request $request){



        // Get All Categories and Sub Categories
        $categories = Category::with('child_categories')->where(['parent_id' => 0])->get();

        $meta_title = "Contact Us - E-shop Sample Website";
        $meta_description = "Contact us for any queries related to our products.";
        $meta_keywords = "contact us, queries";
        return view('dashboard.pages.contact')->with(compact('categories','meta_title','meta_description','meta_keywords'));
    }
    public function docontact(Request $request){

            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/

            $validator = Validator::make($request->all(), [
                'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'email' => 'required|email',
                'subject' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Send Contact Email
            $email = "mustafa.salama2608@gmail.com";
            $messageData = [
                'name'=>$data['name'],
                'email'=>$data['email'],
                'subject'=>$data['subject'],
                'comment'=>$data['message']
            ];
            Mail::send('emails.enquiry',$messageData,function($message)use($email){
                $message->to($email)->subject('Enquiry from E-com Website');
            });
            session()->flash('success', 'We thank you for contacting us. We will get back to you soon.');
            return redirect()->back();

    }

}
