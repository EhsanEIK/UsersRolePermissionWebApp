<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User - Create</title>
    @include('backend.layouts.partial.style')
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        @include('backend.layouts.partial.message')
                        <h4 class="header-title">Create User</h4>
                        <form action="{{ route('admin.normal_users.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">E-mail <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter a email address" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="user_name">User Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter a user name" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>