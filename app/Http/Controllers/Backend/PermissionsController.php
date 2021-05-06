<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        if(!Auth::guard('admin')->user()->can('permission.view')){
            abort(403);
        }

        $header = 'permission';
        $sub_header = 'all permissions';
        
        $permissions = Permission::all();
        return view ('backend.pages.permissions.index', compact('permissions', 'header', 'sub_header'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::guard('admin')->user()->can('permission.create')){
            abort(403);
        }

        $header = 'permission';
        $sub_header = 'create permission';

        return view('backend.pages.permissions.create', compact('header', 'sub_header'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::guard('admin')->user()->can('permission.create')){
            abort(403);
        }
        
        $request->validate([
            'name' => 'required',
            'group_name' => 'required',
        ]);

        if(Permission::create(['name' => $request->get('name'), 'group_name' => $request->get('group_name')])){
            Session::flash('message', "Permission Created Successfully!");
            return redirect()->route('admin.permissions.index');
        }
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
        if(!Auth::guard('admin')->user()->can('permission.edit')){
            abort(403);
        }
        $header = 'permission';
        $sub_header = '';

        $permission = Permission::findOrFail($id);
        return view('backend.pages.permissions.edit',compact('permission','header', 'sub_header'));
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
        if(!Auth::guard('admin')->user()->can('permission.edit')){
            abort(403);
        }
        
        $request->validate([
            'name' => 'required',
            'group_name' => 'required',
        ]);

        $permission = Permission::findOrFail($id);
        $permission->name        = $request->get('name');
        $permission->group_name        = $request->get('group_name');
        $permission->save();

        Session::flash('message', "Permission Updated Successfully!");
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::guard('admin')->user()->can('permission.delete')){
            abort(403);
        }

        Permission::destroy($id);
        Session::flash('message', "Permission Deleted Successfully!");
        return redirect()->route('admin.permissions.index');
    }
}
