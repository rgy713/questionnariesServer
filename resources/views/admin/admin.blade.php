@extends('layouts.admin-base')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i>Admin List</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#">admin list</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addAdmin">
                        {{__("Add Admin")}}
                    </button>
                    <table id="userTable"
                           class="table responsive table-hover table-bordered dataTable no-footer table-full-width"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Password</th>
                            <th>Agreement</th>
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

    <div class="modal fade" id="editAdmin" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Admin Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" accept-charset="UTF-8" action="{{route('admin.updateAdmin')}}"
                      method="POST">
                    @csrf
                    <div class="modal-body">
                        <input name="id" class="form-control" type="hidden" id="edit_id">
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_uid" class="col-3 col-form-label">{{__("User ID")}}:</label>
                            <div class="col-9">
                                <input name="uid" class="form-control" type="text" id="edit_uid">
                            </div>
                        </div>
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
                            <label for="edit_phone" class="col-3 col-form-label">{{__("Phone")}}:</label>
                            <div class="col-9">
                                <input name="phone" class="form-control" type="text" id="edit_phone">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_password" class="col-3 col-form-label">{{__("Password")}}:</label>
                            <div class="col-9">
                                <input name="password" class="form-control" type="text" id="edit_password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("cancel")}}</button>
                        <button type="button" class="btn btn-danger" onclick="deleteAdmin();">{{__("delete")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("update")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addAdmin" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addForm" accept-charset="UTF-8" action="{{route('admin.addAdmin')}}"
                      method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group row m-0 pt-2">
                            <label for="add_uid" class="col-3 col-form-label">{{__("User ID")}}:</label>
                            <div class="col-9">
                                <input name="uid" class="form-control" type="text" id="add_uid">
                            </div>
                        </div>
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
                            <label for="add_phone" class="col-3 col-form-label">{{__("Phone")}}:</label>
                            <div class="col-9">
                                <input name="phone" class="form-control" type="text" id="add_phone">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_password" class="col-3 col-form-label">{{__("Password")}}:</label>
                            <div class="col-9">
                                <input name="password" class="form-control" type="text" id="add_password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{__("cancel")}}</button>
                            <button type="submit" class="btn btn-primary">{{__("add")}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function editAdmin(id) {
            $btn = $("button#" + id);

            $("#edit_id").val(id);
            $("#edit_uid").val($btn.data('uid'));
            $("#edit_name").val($btn.data('name'));
            $("#edit_email").val($btn.data('email'));
            $("#edit_phone").val($btn.data('phone'));
            $("#edit_password").val($btn.data('password'));
            $("#editAdmin").modal("show");
        }

        function DtRender_edit_function(data, type, full, meta) {
            var html =
                '<button id="' + full.id + '" ' + 'data-uid="' + full.uid + '" ' + 'data-name="' + full.name + '" ' + 'data-email="' + full.email + '" ' +
                'data-password="' + full.pw_text + '" ' + 'data-phone="' + full.phone + '" ' +
                ' style="padding: 5px 5px 5px 10px;" class="btn btn-primary" onclick="editAdmin(' + full.id + ');">' +
                '<i class="fa fa-edit"></i></button>'
            ;

            return html;
        }

        function DtRender_agree_function(data, type, full, meta) {
            var checked = full.agree_status == 1 ? "checked" : "";
            var html = '<input type="checkbox" class="form-control" data-id="' + full.id + '" ' + checked + '  onclick="updateAgreeStatus(this)">';

            return html;
        }

        var userTable = $('#userTable').DataTable({
            "scrollX": true,
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{route('admin.getAdminList')}}",
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    $.extend(d, {_token: "{{csrf_token()}}"});
                }
            },
            columns: [
                {name: "no", data: "no", orderable: false,},
                {name: "uid", data: "uid",},
                {name: "name", data: "name",},
                {name: "email", data: "email",},
                {name: "phone", data: "phone",},
                {name: "pw_text", data: "pw_text",},
                {
                    name: "agree_status",
                    data: "agree_status",
                    render: DtRender_agree_function
                },
                {name: "created_at", data: "created_at",},
                {name: "updated_at", data: "updated_at",},
                {
                    name: "id",
                    data: "id",
                    defaultContent: "",
                    className: "dt-center",
                    orderable: false,
                    render: DtRender_edit_function
                }
            ],
            order: [[8, 'desc']]
        });

        $("#addForm").validate({
            lang: 'en',
            rules: {
                uid: {required: true},
                name: {required: true},
                email: {required: true, email: true},
                phone: {required: true},
                password: {required: true, minlength: 6},
            },
            submitHandler: function (form) {
                var action = $("#addForm").attr("action");
                var fd = new FormData($("#addForm")[0]);
                var success = function (data) {
                        swal({
                            type: 'success',
                            title: "{{__('It was registered.')}}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#addAdmin").modal("hide");
                        $('#userTable').DataTable().ajax.reload();
                    },
                    error = function (data) {
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
                uid: {required: true},
                name: {required: true},
                email: {required: true, email: true},
                phone: {required: true},
                password: {required: true, minlength: 6},
            },

            submitHandler: function (form) {
                var action = $("#editForm").attr("action");
                var fd = new FormData($("#editForm")[0]);
                var success = function (data) {
                        swal({
                            type: 'success',
                            title: "{{__("Updated.")}}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $("#editAdmin").modal("hide");
                        $('#userTable').DataTable().ajax.reload();
                    },
                    error = function (data) {
                        swal({
                            type: 'error',
                            title: "{{__("An error occurred.")}}",
                            text: data,
                        })
                    };
                ajax_form("POST", action, fd, success, error);
            }
        });

        function deleteAdmin() {
            swal({
                title: "Do you want to completely remove it?",
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{__("delete")}}",
                cancelButtonText: "{{__("cancel")}}"
            }, function (isConfirm) {
                if (isConfirm) {
                    var id = $("#edit_id").val();

                    if (!id)
                        return;

                    var success = function (data) {
                            swal({
                                type: 'success',
                                title: "{{__("Your data has been deleted.")}}",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#editAdmin").modal("hide");
                            $('#userTable').DataTable().ajax.reload();
                        },
                        error = function (data) {
                            swal({
                                type: 'error',
                                title: "{{__("An error occurred.")}}",
                                text: data,
                            })
                        };
                    ajax_json(
                        "POST",
                        "{{route("admin.deleteAdmin")}}",
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

        function updateAgreeStatus(e) {
            var $this = $(e),
                id = $this.data("id"),
                agree_status = $this.is(":checked") ? 1 : 0;
            if (!id)
                return;

            var success = function (data) {
                    swal({
                        type: 'success',
                        title: "{{__("Updated agreement status.")}}",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('#userTable').DataTable().ajax.reload();
                },
                error = function (data) {
                    swal({
                        type: 'error',
                        title: "{{__("An error occurred.")}}",
                        text: data,
                    })
                };
            ajax_json(
                "POST",
                "{{route("admin.updateAgreeStatus")}}",
                {
                    _token: "{{csrf_token()}}",
                    id: id,
                    agree_status: agree_status
                },
                success,
                error,
                true
            );
        }

    </script>
@endsection
