<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class AdminsController extends Controller
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
        if(is_null($this->user) || !$this->user->can('admin.view')){
            abort(403, 'Sorry you are unauthorize to view this page');
        }
        $header = 'admin';
        $sub_header = 'all admins';

        $admins = Admin::all();
        return view('backend.pages.admins.index', compact('admins','header','sub_header'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403, 'Sorry you are unauthorize to view this page');
        }
        $header = 'admin';
        $sub_header = 'create admin';

        $roles = Role::all();
        return view('backend.pages.admins.create', compact('roles','header', 'sub_header'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('admin.create')){
            abort(403, 'Sorry you are unauthorize to view this page');
        }
        //Validate data
        $request->validate([
            'name' => 'required|max:100',
            'user_name' => 'required|max:100',
            'email' => 'required|max:100|email|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);
        //Process Data
        $admin = new Admin();
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->user_name = $request->get('user_name');
        $admin->password = Hash::make($request->get('password'));
        $admin->save();
        if($request->roles)
        {   
            $admin->assignRole($request->roles);
        }
        Session::flash('strong', 'Create!');
        Session::flash('message', 'Admin Created Successfully!');
        return redirect()->route('admin.admins.index');
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
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403, 'Sorry you are unauthorize to view this page');
        }
        $header = 'admin';
        $sub_header = '';

        $admin = Admin::findOrFail($id);
        $roles = Role::all();

        return view('backend.pages.admins.edit', compact('admin','roles','header','sub_header'));
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
        if(is_null($this->user) || !$this->user->can('admin.edit')){
            abort(403, 'Sorry you are unauthorize to view this page');
        }
        //Validate data
        $request->validate([
            'name' => 'required|max:100',
            'user_name' => 'required|max:100',
            'email' => 'required|max:100|email|unique:admins,email,'.$id,
            'password' => 'nullable|min:6|confirmed',
        ]);
        //Process Data
        $admin = Admin::findOrFail($id);
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->user_name = $request->get('user_name');
        if($request->get('password'))
        {
            $admin->password = Hash::make($request->get('password'));
        }
        $admin->save();
        $admin->roles()->detach();
        if($request->roles)
        {   
            $admin->assignRole($request->roles);
        }
        Session::flash('strong', 'Update!');
        Session::flash('message', 'Admin Updated Successfully!');

        return redirect()->route('admin.admins.edit',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('admin.delete')){
            abort(403, 'Sorry you are unauthorize to view this page');
        }
        if(Admin::destroy($id))
        {
            Session::flash('strong', 'Delete!');
            Session::flash('message', 'Admin Deleted Successfully!');
        }
        return redirect()->route('admin.admins.index');
    }


    //Normal Users Create Method
    public function normal_user_create()
    {
        return view('backend.pages.admins.normal_users.normal_users_create');
    }

    //Normal Users Store Method
    public function normal_user_store(Request $request)
    {   
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = new Admin();
        $admin->name        = $request->get('name');
        $admin->email       = $request->get('email');
        $admin->user_name   = $request->get('user_name');
        $admin->password    = Hash::make($request->get('password'));
        $admin->save();
        $role = 'User';
        $admin->assignRole($role);

        Session::flash('message', "User Created Successfully!");
        return redirect()->route('admin.login');
    }
}
