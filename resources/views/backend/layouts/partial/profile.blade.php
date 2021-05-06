<div class="col-sm-6 clearfix">
    <div class="user-profile pull-right">
        {{-- <img class="avatar user-thumb" src="{{ asset ('template/assets/images/author/avatar.png') }}" alt="avatar"> --}}
        <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
            {{ Auth::guard('admin')->user()->user_name }} 
            <i class="fa fa-angle-down"></i>
        </h4>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('admin.logout') }}">Log Out</a>
        </div>
    </div>
</div>