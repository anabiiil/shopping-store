<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:read_roles')->only(['index']);
    //     $this->middleware('permission:create_roles')->only(['create', 'store']);
    //     $this->middleware('permission:update_roles')->only(['edit', 'update']);
    //     $this->middleware('permission:delete_roles')->only(['destroy']);

    // }// end of __construct


    public function index()
    {
        $roles = Role::whereRoleNot(['super_admin'])
            ->with('permissions')
            ->withCount('admins')
            ->get();
        return view('dashboard.roles.index', compact('roles'));

    }//end of index

    public function create()
    {
        return view('dashboard.roles.create');

    }//end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:roles,name',
            'permissions' => 'required|array|min:1',
        ]);


        $role = Role::create($request->all());

        $role->attachPermissions($request->permissions);

        session()->flash('success', 'Role Has Been Added Succefully');
        return redirect()->route('dashboard.roles.index');

    }//end of store

    public function edit(Role $role)
    {
        return view('dashboard.roles.edit', compact('role'));

    }//end of edit

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array|min:1',
        ]);

        $role->update($request->all());

        $role->syncPermissions($request->permissions);

        session()->flash('success', 'Role Has Been Updated Succefully');
        return redirect()->route('dashboard.roles.index');


    }//end of update

    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('success', 'Role Has Been Deleted Succefully');
        return redirect()->route('dashboard.roles.index');

    }//end of destroy
}
