@php
    $usr = Auth::guard('admin')->user();
@endphp

<!-- sidebar menu area start -->
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="{{ asset ('template/assets/images/icon/logo.png') }}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    @if ($usr->can('dashboard.view'))
                        <li class="@if ($header == 'dashboard') active @endif">
                            <a href="{{ route('admin.dashboard') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        </li>
                    @endif

                    @if ($usr->can('role.view') || $usr->can('role.create') || $usr->can('role.edit') || $usr->can('role.delete'))
                        <li class="@if ($header == 'role') active @endif">
                            <a href="#" aria-expanded="true"><i class="fa fa-bars" aria-hidden="true"></i><span>Role</span></a>
                            <ul class="collapse">
                                @if ($usr->can('role.view'))
                                    <li class="@if ($sub_header == 'all roles') active @endif"><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
                                @endif
                                @if ($usr->can('role.create'))
                                    <li class="@if ($sub_header == 'create role') active @endif"><a href="{{ route('admin.roles.create') }}">Create New Role</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if ($usr->can('admin.view') || $usr->can('admin.create') || $usr->can('admin.edit') || $usr->can('admin.delete'))
                        <li class="@if ($header == 'admin') active @endif">
                            <a href="#" aria-expanded="true"><i class="fa fa-user" aria-hidden="true"></i><span>Admin</span></a>
                            <ul class="collapse">
                                @if ($usr->can('admin.view'))
                                    <li class="@if ($sub_header == 'all admins') active @endif"><a href="{{ route('admin.admins.index') }}">All Admins</a></li>
                                @endif
                                @if ($usr->can('admin.create'))
                                    <li class="@if ($sub_header == 'create admin') active @endif"><a href="{{ route('admin.admins.create') }}">Create New Admin</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if ($usr->can('permission.view') || $usr->can('permission.create') || $usr->can('permission.edit') || $usr->can('permission.delete'))
                        <li class="@if ($header == 'permission') active @endif">
                            <a href="#" aria-expanded="true"><i class="fa fa-bars" aria-hidden="true"></i><span>Permission</span></a>
                            <ul class="collapse">
                                @if ($usr->can('permission.view'))
                                    <li class="@if ($sub_header == 'all permissions') active @endif"><a href="{{ route('admin.permissions.index') }}">All Permissions</a></li>
                                @endif
                                @if ($usr->can('permission.create'))
                                    <li class="@if ($sub_header == 'create permission') active @endif"><a href="{{ route('admin.permissions.create') }}">Create New Permission</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
            
        </div>
    </div>
</div>
