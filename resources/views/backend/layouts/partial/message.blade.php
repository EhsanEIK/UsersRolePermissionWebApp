<!-- error message area start -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<!-- error message area end -->

<!-- success message area end -->
@if(Session::get('message'))
    <div class="alert alert-success alert-dismissible mt-3">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{Session::get('strong')}}</strong> {{Session::get('message')}}
    </div>
@endif
<!-- success message area end -->