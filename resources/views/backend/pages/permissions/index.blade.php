@extends('backend.layouts.master')
@section('title', 'Permissions - Index')
@section('main_content')
<div class="main-content">
    <div class="main-content-inner">
        <!-- page title area start -->
        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">Admin</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="{{ route ('admin.dashboard') }}">Dashboard</a></li>
                            <li><span>All Permissions</span></li>
                        </ul>
                    </div>
                </div>
                @include('backend.layouts.partial.profile')
            </div>
        </div>
        <!-- page title area end -->

        @include('backend.layouts.partial.message')
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="header-title">Permissions List</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-xs mb-3 ">Create New Admin</a>
                            </div>
                        </div>
                        
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Name</th>
                                        <th>Group</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $key=>$permission )
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->group_name }}</td>
                                        <td>
                                            <form action="{{ route('admin.permissions.destroy', [$permission->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                @if (Auth::guard('admin')->user()->can('permission.edit'))
                                                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary">Edit</a>
                                                @endif
                                                
                                                @if (Auth::guard('admin')->user()->can('permission.delete'))
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" >Delete</button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Name</th>
                                        <th>Group</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->
        </div>
    </div>
</div>

@endsection