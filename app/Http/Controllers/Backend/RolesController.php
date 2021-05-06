<?php

namespace App\Http\Controllers\Backend;


use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('role.view')){
            abort(403, 'Sorry you are unauthorize to view this page');
        }
        $header = 'role';
        $sub_header = 'all roles';

        $roles = Role::all();
        return view('backend.pages.roles.index', compact('roles','header','sub_header'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('role.create')){
            abort(403, 'Sorry you are unauthorize to view this page');
        }
        $header = 'role';
        $sub_header = 'create role';

        $allPermissions = Permission::all();
        $permissionGroups = Admin::getPermissionGroup();

        return view('backend.pages.roles.create', compact('permissionGroups','allPermissions','header', 'sub_header'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('role.create')){
            abort(403, 'Sorry you are unauthorize to view this page');
        }
        //Validate data
        $request->validate([
            'name' => 'required|max:100|unique:roles',
        ],[
            'name.required' => 'Please give a role name.'
        ]);
        
        //Process Data
        $role = Role::create(['name' => $request->name, 'guard_name'=>'admin']);
        $permissions = $request->get('permissions');
        if(!empty($permissions))
        {
            $role->syncPermissions($permissions);
        }
        Session::flash('strong', 'Create!');
        Session::flash('message', 'Role Created Successfully!');
        return redirect()->to('admin/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('role.edit')){
            abort(403, 'Sorry you are unauthorize to view this page');
        }
        $header = 'role';
        $sub_header = '';

        $role = Role::findOrFail($id);
        $allPermissions = Permission::all();
        $permissionGroups = Admin::getPermissionGroup();

        return view('backend.pages.roles.edit', compact('role','allPermissions','permissionGroups','header','sub_header'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(is_null($this->user) || !$this->user->can('role.edit')){
            abort(403, 'Sorry you are unauthorize to view this page');
        }
        //Validate data
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,'.$id,
        ],[
            'name.required' => 'Please give a role name.'
        ]);
        
        //Process Data
        $role = Role::findOrFail($id);
        $permissions = $request->get('permissions');
        if(!empty($permissions))
        {
            $role->name = $request->get('name');
            $role->save();
            $role->syncPermissions($permissions);
        }
        else{
            $role->name = $request->get('name');
            $role->save();
            //$role->syncPermissions($permissions);
        }
        Session::flash('strong', 'Update!');
        Session::flash('message', 'Role Updated Successfully!');
        return redirect()->route('admin.roles.edit',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('role.delete')){
            abort(403, 'Sorry you are unauthorize to view this page');
        }
        if(Role::destroy($id))
        {
            Session::flash('strong', 'Delete!');
            Session::flash('message', 'Role Deleted Successfully!');
        }
        return redirect()->route('admin.roles.index');
    }
}
