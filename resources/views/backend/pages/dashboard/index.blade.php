@extends('backend.layouts.master')
@section('title', 'Dashboard | Index')
@section('main_content')
<div class="main-content">
    <div class="main-content-inner">
       <!-- page title area start -->
       <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">Dashboard</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="index.html">Home</a></li>
                            <li><span>Dashboard</span></li>
                        </ul>
                    </div>
                </div>
                @include('backend.layouts.partial.profile')
            </div>
        </div>
        <!-- page title area end -->

        @include('backend.layouts.partial.message')
        <!-- apps report area start -->
        <div class="col-lg-8">
            <div class="row">
                <div class="col-md-6 mt-5 mb-3">
                    <div class="card">
                        <div class="seo-fact sbg1">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="fa fa-users"></i> Admins</div>
                                <h2>{{ $totalAdmin }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-md-5 mb-3">
                    <div class="card">
                        <div class="seo-fact sbg2">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="fa fa-list"></i> Roles</div>
                                <h2>{{ $totalRole }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3 mb-lg-0">
                    <div class="card">
                        <div class="seo-fact sbg3">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="fa fa-list"></i> Permissions</div>
                                <h2>{{ $totalPermission }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- apps report area end -->
    </div>
</div>
@endsection