@extends('layouts.admin-base')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i>User List</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#">User list</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUser">
                        {{__("Add User")}}
                    </button>
                    <table id="userTable" class="table responsive table-hover table-bordered dataTable no-footer table-full-width" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Company</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUser" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">User Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" accept-charset="UTF-8" action="{{route('admin.updateUser')}}"
                      method="POST">
                    @csrf
                    <div class="modal-body">
                        <input name="id" class="form-control" type="hidden" id="edit_id">
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_name" class="col-3 col-form-label">{{__("Name")}}:</label>
                            <div class="col-9">
                                <input name="name" class="form-control" type="text" id="edit_name">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_email" class="col-3 col-form-label">{{__("Email")}}:</label>
                            <div class="col-9">
                                <input name="email" class="form-control" type="email" id="edit_email">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_password" class="col-3 col-form-label">{{__("Password")}}:</label>
                            <div class="col-9">
                                <input name="password" class="form-control" type="text" id="edit_password">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_company_id" class="col-3 col-form-label">{{__("Company")}}:</label>
                            <div class="col-9">
                                <select class="custom-select" id="edit_company_id" name="company_id">
                                    @foreach($company_list as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("cancel")}}</button>
                        <button type="button" class="btn btn-danger" onclick="deleteUser();">{{__("delete")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("update")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addForm" accept-charset="UTF-8" action="{{route('admin.addUser')}}"
                      method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group row m-0 pt-2">
                            <label for="add_name" class="col-3 col-form-label">{{__("Name")}}:</label>
                            <div class="col-9">
                                <input name="name" class="form-control" type="text" id="add_name">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_email" class="col-3 col-form-label">{{__("Email")}}:</label>
                            <div class="col-9">
                                <input name="email" class="form-control" type="email" id="add_email">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_password" class="col-3 col-form-label">{{__("Password")}}:</label>
                            <div class="col-9">
                                <input name="password" class="form-control" type="text" id="add_password">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_company_id" class="col-3 col-form-label">{{__("Company")}}:</label>
                            <div class="col-9">
                                <select class="custom-select" id="add_company_id" name="company_id">
                                    @foreach($company_list as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("cancel")}}</button>
                            <button type="submit" class="btn btn-primary">{{__("add")}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewUserDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">User Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-primary mb-3" onclick="addUserDetail();">
                        {{__("Add User Detail")}}
                    </button>
                    <table id="userDetailTable" class="table responsive table-hover table-bordered dataTable no-footer table-full-width" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Site</th>
                            <th>Pi ID</th>
                            <th>Operator ID</th>
                            <th>Container ID</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" id="view_user_id">
            </div>
        </div>
    </div>

    <div class="modal fade" id="addUserDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add User Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addUserDetailForm" accept-charset="UTF-8" action="{{route('admin.addUserDetail')}}"
                      method="POST">
                    @csrf
                    <input name="user_id" type="hidden" id="add_user_id">
                    <div class="modal-body">
                        <div class="input-group row m-0 pt-2">
                            <label for="add_site" class="col-3 col-form-label">{{__("Site")}}:</label>
                            <div class="col-9">
                                <input name="site" class="form-control" type="text" id="add_site">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_pi_id" class="col-3 col-form-label">{{__("Pi ID")}}:</label>
                            <div class="col-9">
                                <input name="pi_id" class="form-control" type="text" id="add_pi_id">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_operator_id" class="col-3 col-form-label">{{__("Operator ID")}}:</label>
                            <div class="col-9">
                                <input name="operator_id" class="form-control" type="text" id="add_operator_id">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_container_id" class="col-3 col-form-label">{{__("Container ID")}}:</label>
                            <div class="col-9">
                                <input name="container_id" class="form-control" type="text" id="add_container_id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("cancel")}}</button>
                            <button type="submit" class="btn btn-primary">{{__("add")}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit User Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editUserDetailForm" accept-charset="UTF-8" action="{{route('admin.updateUserDetail')}}"
                      method="POST">
                    @csrf
                    <input name="id" type="hidden" id="edit_view_id">
                    <input name="user_id" type="hidden" id="edit_user_id">
                    <div class="modal-body">
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_site" class="col-3 col-form-label">{{__("Site")}}:</label>
                            <div class="col-9">
                                <input name="site" class="form-control" type="text" id="edit_site">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_pi_id" class="col-3 col-form-label">{{__("Pi ID")}}:</label>
                            <div class="col-9">
                                <input name="pi_id" class="form-control" type="text" id="edit_pi_id">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_operator_id" class="col-3 col-form-label">{{__("Operator ID")}}:</label>
                            <div class="col-9">
                                <input name="operator_id" class="form-control" type="text" id="edit_operator_id">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_container_id" class="col-3 col-form-label">{{__("Container ID")}}:</label>
                            <div class="col-9">
                                <input name="container_id" class="form-control" type="text" id="edit_container_id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("cancel")}}</button>
                            <button type="button" class="btn btn-danger" onclick="deleteUserDetail();">{{__("delete")}}</button>
                            <button type="submit" class="btn btn-primary">{{__("update")}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        var userDetailTable = null;
        function editUser(id) {
            $btn = $("button#" + id);

            $("#edit_id").val(id);
            $("#edit_name").val($btn.data('name'));
            $("#edit_email").val($btn.data('email'));
            $("#edit_password").val($btn.data('password'));
            $("#edit_company_id").val($btn.data('company'));
            $("#editUser").modal("show");
        }

        function DtRender_edit_function(data, type, full, meta) {
            var html =
                '<button id="' + full.id +'" ' + 'data-name="' + full.name +'" '+ 'data-email="' + full.email +'" ' +
                'data-password="' + full.pw_text +'" ' + 'data-company="' + full.company_id +'" ' +
                ' style="padding: 5px 5px 5px 10px;" class="btn btn-primary" onclick="editUser(' + full.id + ');">' +
                '<i class="fa fa-edit"></i></button>&nbsp;&nbsp;&nbsp;' +
                '<button style="padding: 5px 5px 5px 10px;" class="btn btn-primary" onclick="viewUserDetail(' + full.id + ');">' +
                '<i class="fa fa-list"></i></button>'
            ;

            return html;
        }

        var userTable = $('#userTable').DataTable({
            "scrollX": true,
            sScrollXInner: "100%",
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{route('admin.getUserList')}}",
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    $.extend(d, {_token: "{{csrf_token()}}"});
                }
            },
            columns: [
                {name: "no", data: "no", orderable: false, },
                {name: "name", data: "name", },
                {name: "email", data: "email", },
                {name: "pw_text", data: "pw_text", },
                {name: "company_name", data: "company_name", },
                {name: "created_at", data: "created_at", },
                {name: "updated_at", data: "updated_at", },
                {
                    name: "id",
                    data: "id",
                    defaultContent: "",
                    className: "dt-center",
                    orderable: false,
                    render: DtRender_edit_function
                }
            ],
            order: [[1, 'asc']]
        });

        $("#addForm").validate({
            lang: 'en',
            rules: {
                name: {required: true}
            },
            submitHandler: function (form) {
                var action = $("#addForm").attr("action");
                var fd = new FormData($("#addForm")[0]);
                var success = function(data){
                        swal({
                            type: 'success',
                            title: "{{__('It was registered.')}}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#addUser").modal("hide");
                        $('#userTable').DataTable().ajax.reload();
                    },
                    error = function(data){
                        swal({
                            type: 'error',
                            title: "Registration failed!",
                            text: data,
                        });
                    };
                ajax_form("POST", action, fd, success, error);
            }
        });

        $("#editForm").validate({
            lang: 'en',
            rules: {
                name: {required: true}
            },

            submitHandler: function (form) {
                var action = $("#editForm").attr("action");
                var fd = new FormData($("#editForm")[0]);
                var success = function(data){
                        swal({
                            type: 'success',
                            title: "{{__("Updated.")}}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#editUser").modal("hide");
                        $('#userTable').DataTable().ajax.reload();
                    },
                    error = function(data){
                        swal({
                            type: 'error',
                            title: "{{__("An error occurred.")}}",
                            text: data,
                        })
                    };
                ajax_form("POST", action, fd, success, error);
            }
        });

        function deleteUser(){
            swal({
                title: "Do you want to completely remove it?",
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{__("delete")}}",
                cancelButtonText: "{{__("cancel")}}"
            }, function(isConfirm) {
                if (isConfirm) {
                    var id = $("#edit_id").val();

                    if(!id)
                        return;

                    var success = function(data){
                            swal({
                                type: 'success',
                                title: "{{__("Your data has been deleted.")}}",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#editUser").modal("hide");
                            $('#userTable').DataTable().ajax.reload();
                        },
                        error = function(data){
                            swal({
                                type: 'error',
                                title: "{{__("An error occurred.")}}",
                                text: data,
                            })
                        };
                    ajax_json(
                        "POST",
                        "{{route("admin.deleteUser")}}",
                        {
                            _token: "{{csrf_token()}}",
                            id: id
                        },
                        success,
                        error,
                        true
                    );
                }
            })
        }

        function DtRender_editUserDetail_function(data, type, full, meta) {
            var html =
                '<button id="detail-' + full.id + '" data-operator_id="' + full.operator_id +'" data-container_id="' + full.container_id + '" data-site="' + full.site + '" data-pi_id="' + full.pi_id +'" ' +
                ' style="padding: 5px 10px 5px 10px;" class="btn btn-primary" onclick="editUserDetail(' + full.id + ');">' +
                '<i class="fa fa-edit"></i></button>';

            return html;
        }

        function viewUserDetail(id){

            $("#view_user_id").val(id);

            if(userDetailTable != null){
                userDetailTable.ajax.reload();
                $("#viewUserDetail").modal("show");
                return;
            }

            userDetailTable = $('#userDetailTable').DataTable({
                "scrollX": true,
                sScrollXInner: "100%",
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('admin.getUserDetailList')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        $.extend(d, {
                            _token: "{{csrf_token()}}",
                            user_id:$("#view_user_id").val()
                        });
                    }
                },
                columns: [
                    {name: "no", data: "no", orderable: false, },
                    {name: "site", data: "site", },
                    {name: "pi_id", data: "pi_id", },
                    {name: "operator_id", data: "operator_id", },
                    {name: "container_id", data: "container_id", },
                    {name: "created_at", data: "created_at", },
                    {name: "updated_at", data: "updated_at", },
                    {
                        name: "id",
                        data: "id",
                        defaultContent: "",
                        className: "dt-center",
                        orderable: false,
                        render: DtRender_editUserDetail_function
                    }
                ],
                order: [[1, 'asc']]
            });

            $("#viewUserDetail").modal("show");
        }

        function addUserDetail() {
            $("#add_user_id").val($("#view_user_id").val());
            $("#add_operator_id").val("");
            $("#add_site").val("");
            $("#add_pi_id").val("");
            $("#add_container_id").val("");
            $("#addUserDetail").modal("show");
        }

        function editUserDetail(id) {
            $btn = $("button#detail-" + id);

            $("#edit_view_id").val(id);
            $("#edit_user_id").val($("#view_user_id").val());
            $("#edit_site").val($btn.data('site'));
            $("#edit_pi_id").val($btn.data('pi_id'));
            $("#edit_operator_id").val($btn.data('operator_id'));
            $("#edit_container_id").val($btn.data('container_id'));
            $("#editUserDetail").modal("show");
        }

        $("#addUserDetailForm").validate({
            lang: 'en',
            rules: {
                site: {required: true},
                pi_id: {required: true},
                operator_id: {required: true},
                container_id: {required: true},
            },
            submitHandler: function (form) {
                var action = $("#addUserDetailForm").attr("action");
                var fd = new FormData($("#addUserDetailForm")[0]);
                var success = function(data){
                        swal({
                            type: 'success',
                            title: "{{__('It was registered.')}}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#addUserDetail").modal("hide");
                        $('#userDetailTable').DataTable().ajax.reload();
                    },
                    error = function(data){
                        swal({
                            type: 'error',
                            title: "Registration failed!",
                            text: data,
                        });
                    };
                ajax_form("POST", action, fd, success, error);
            }
        });

        $("#editUserDetailForm").validate({
            lang: 'en',
            rules: {
                site: {required: true},
                pi_id: {required: true},
                operator_id: {required: true},
                container_id: {required: true},
            },

            submitHandler: function (form) {
                var action = $("#editUserDetailForm").attr("action");
                var fd = new FormData($("#editUserDetailForm")[0]);
                var success = function(data){
                        swal({
                            type: 'success',
                            title: "{{__("Updated.")}}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#editUserDetail").modal("hide");
                        $('#userDetailTable').DataTable().ajax.reload();
                    },
                    error = function(data){
                        swal({
                            type: 'error',
                            title: "{{__("An error occurred.")}}",
                            text: data,
                        })
                    };
                ajax_form("POST", action, fd, success, error);
            }
        });

        function deleteUserDetail(){
            swal({
                title: "Do you want to completely remove it?",
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{__("delete")}}",
                cancelButtonText: "{{__("cancel")}}"
            }, function(isConfirm) {
                if (isConfirm) {
                    var id = $("#edit_view_id").val();

                    if(!id)
                        return;

                    var success = function(data){
                            swal({
                                type: 'success',
                                title: "{{__("Your data has been deleted.")}}",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#editUserDetail").modal("hide");
                            $('#userDetailTable').DataTable().ajax.reload();
                        },
                        error = function(data){
                            swal({
                                type: 'error',
                                title: "{{__("An error occurred.")}}",
                                text: data,
                            })
                        };
                    ajax_json(
                        "POST",
                        "{{route("admin.deleteUserDetail")}}",
                        {
                            _token: "{{csrf_token()}}",
                            id: id
                        },
                        success,
                        error,
                        true
                    );
                }
            })
        }

    </script>
@endsection
