<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:read_admins')->only(['index']);
    //     $this->middleware('permission:create_admins')->only(['create', 'store']);
    //     $this->middleware('permission:update_admins')->only(['edit', 'update']);
    //     $this->middleware('permission:delete_admins')->only(['destroy']);

    // }// end of __construct


        public function index()
        {



            $roles = Role::whereRoleNot('super_admin')->get();

            $admins = Admin::whereRoleNot(['super_admin'])
            ->whenSearch(request()->search)
            ->whenRole(request()->role_id)
            ->with('roles')
            ->paginate(5);



            return view('dashboard.admins.index', compact('roles', 'admins'));

        }//end of index



    public function create()
    {
        $roles = Role::whereRoleNot(['super_admin'])->get();
        return view('dashboard.admins.create', compact('roles'));

    }//end of create
    public function store(Request $request)
    {

        // return $request->all();

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|confirmed',
            'role_id' => 'required|numeric',
        ]);

        $request->merge(['password' => bcrypt($request->password)]);


        // return $request->all();
        $admin = Admin::create($request->all());
        $admin->attachRole($request->role_id);

        session()->flash('success', 'Admin Has Been Added Succefully');

        return redirect()->route('dashboard.admins.index');

    }//end of store

    public function edit(Admin $admin)
    {
        $roles = Role::whereRoleNot(['super_admin'])->get();
        return view('dashboard.admins.edit', compact('admin', 'roles'));

    }//end of edit

    public function update(Request $request, Admin $admin)
    {
        $data = $this->validate(request(),[
            'name'              => 'required',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'role_id' => 'required|numeric',
            'password'          => 'sometimes|nullable|min:6',
        ],[],[

            'required' => 'This Field Is Required',
            'name.string' => 'Admin Name Must Be Letter',
             'password.min' => 'Password Must Be At Least 6 Nember',
         ]);

        if(request()->has('password')){
            $data['password'] = bcrypt(request('password'));
        }

        $admin->update($request->all());

        $admin->syncRoles([$request->role_id]);

        session()->flash('success', 'Admin has been updated successfully');
        return redirect()->route('dashboard.admins.index');

    }//end of update

    public function destroy(Admin $admin)
    {
        $admin->delete();
        session()->flash('success', 'Admin has been Deleted successfully');
        return redirect()->route('dashboard.admins.index');

    }//end of destroy
}
