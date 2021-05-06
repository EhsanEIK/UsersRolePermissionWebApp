<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function Index()
    {
        if(is_null($this->user) || !$this->user->can('dashboard.view')){
            abort(403, 'Sorry! You are unauthorize to access this page');
        }
        $header = 'dashboard';
        $sub_header = '';

        $totalRole = Role::count('id');
        $totalPermission = Permission::count('id');
        $totalAdmin = Admin::count('id');
        return view('backend.pages.dashboard.index', compact('totalRole','totalPermission','totalAdmin','header','sub_header'));
    }
}
