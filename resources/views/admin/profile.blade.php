@extends('layouts.admin-base')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i>Admin Profile</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#">admin profile</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-8 m-auto">
            <div class="tile">
                <div class="tile-body">
                    <form id="addminProfile" action="{{route('admin.updateAdminProfile')}}" method="POST">
                        @csrf
                        <div class="input-group row m-0 pt-2">
                            <label for="user_id" class="col-3 col-form-label">{{__("User ID")}}:</label>
                            <div class="col-9">
                                <input name="uid" class="form-control" type="text" id="user_id"
                                       value="{{Auth::user()->uid}}" required>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="name" class="col-3 col-form-label">{{__("Name")}}:</label>
                            <div class="col-9">
                                <input name="name" class="form-control" type="text" id="name"
                                       value="{{Auth::user()->name}}" required>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="email" class="col-3 col-form-label">{{__("Email")}}:</label>
                            <div class="col-9">
                                <input name="email" class="form-control" type="email" id="email"
                                       value="{{Auth::user()->email}}" required>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="phone" class="col-3 col-form-label">{{__("Phone")}}:</label>
                            <div class="col-9">
                                <input name="phone" class="form-control" type="text" id="phone"
                                       value="{{Auth::user()->phone}}" required>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <button type="submit" class="btn-primary px-4 py-2 m-auto">{{__("Update")}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-8 m-auto">
            <div class="tile">
                <div class="tile-body">
                    <form id="changePassword" action="{{route('admin.changeAdminPassword')}}" method="POST">
                        @csrf
                        <div class="input-group row m-0 pt-2">
                            <label for="old_password" class="col-3 col-form-label">{{__("Old Password")}}:</label>
                            <div class="col-9">
                                <input name="old_password" class="form-control" type="password" id="old_password"
                                       required>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="new_password" class="col-3 col-form-label">{{__("New Password")}}:</label>
                            <div class="col-9">
                                <input name="new_password" class="form-control" type="password" id="new_password"
                                       required>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="confirm_password" class="col-3 col-form-label">{{__("Confirm Password")}}:</label>
                            <div class="col-9">
                                <input name="confirm_password" class="form-control" type="password" id="confirm_password"
                                       required>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <button type="submit" class="btn-primary px-4 py-2 m-auto">{{__("Change")}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $("#addminProfile").validate({
            lang: 'en',
            rules: {
                uid: {required: true},
                name: {required: true},
                email: {required: true, email: true},
                phone: {required: true},
            },
            submitHandler: function (form) {
                var action = $("#addminProfile").attr("action");
                var fd = new FormData($("#addminProfile")[0]);
                var success = function (data) {
                        swal({
                            type: 'success',
                            title: "{{__('It was updated.')}}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error = function (data) {
                        swal({
                            type: 'error',
                            title: "Update failed!",
                            text: data,
                        });
                    };
                ajax_form("POST", action, fd, success, error);
            }
        });

        $("#changePassword").validate({
            lang: 'en',
            rules: {
                old_password: {required: true},
                new_password: {required: true},
                confirm_password: {required: true, equalTo: '#new_password'},
            },
            submitHandler: function (form) {
                var action = $("#changePassword").attr("action");
                var fd = new FormData($("#changePassword")[0]);
                var success = function (data) {
                        swal({
                            type: 'success',
                            title: "{{__('It was updated.')}}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error = function (data) {
                        swal({
                            type: 'error',
                            title: "Update failed!",
                            text: data,
                        });
                    };
                ajax_form("POST", action, fd, success, error);
            }
        });

    </script>
@endsection
