<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class CategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:read_categories')->only(['index']);
    //     $this->middleware('permission:create_categories')->only(['create', 'store']);
    //     $this->middleware('permission:update_categories')->only(['edit', 'update']);
    //     $this->middleware('permission:delete_categories')->only(['destroy']);

    // }// end of __construct


    public function index()
    {
        $categories = Category::with('parent_category')->get();
        // $categories = json_decode(json_encode($categories));
        return view('dashboard.categories.index', compact('categories'));
    }


    public function create()
    {
        $categories = Category::where(['parent_id' => 0])
        ->get();
        return view('dashboard.categories.create',compact('categories'));
    }


    public function store(Request $request)
    {


            $validation = $request->validate([
                'name' => 'required|max:255',
                'url'              => 'required|max:100',
                'description'           => 'required|max:1000',
            ]);

            $request->merge(['parent_id' => $request->parent_id]);

            if (!$request->has('status'))
            $request->request->add(['status' => 'un_active']);
            else
            $request->request->add(['status' => 'active']);



            $category = Category::create($request->all());

            session()->flash('success', 'Category has been Added successfully');
            return redirect()->route('dashboard.categories.index');

    }



    public function edit($id)
    {
        $categories = Category::find($id);
        $levels = Category::where(['parent_id'=>0])->get();
        return view('dashboard.categories.edit',compact('categories' , 'levels'));
    }


    public function update(Request $request, $id)
    {

             $validation = $request->validate([
                'name' => 'required|max:255',
                'url'              => 'required|max:100',
                'description'           => 'required|max:1000',
            ]);
            if (!$request->has('status'))
            $request->request->add(['status' => 'un_active']);
            else
            $request->request->add(['status' => 'active']);
            $category = Category::findOrFail($id)->update($request->all());
            session()->flash('success', 'Category has been updated successfully');
            return redirect()->route('dashboard.categories.index');

    }


    public function destroy($id)
    {
        try {
            $category = Category::find($id);

            if (!$category)

            session()->flash('success', 'This Category Not Found');
            return redirect()->route('dashboard.categories.index');

            $products = $category->products();

            if (isset($products) && $products->count() > 0) {
            session()->flash('success', 'Can not delete this category because there product particular to them');
            return redirect()->route('dashboard.categories.index');
             }

            $category->delete();
            session()->flash('success', 'Category Has Been Deleted');
        return redirect()->route('dashboard.categories.index');


        } catch (\Exception $ex) {
            dd($ex);
            return redirect()->route('dashboard.categories.index');
        }

    }
}
