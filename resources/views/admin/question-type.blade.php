@extends('layouts.admin-base')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i>Question Type List</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#">question type list</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="row m-0">
                        <div class="input-group mb-3 col-md-10 col-lg-8">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Questionnary</span>
                            </div>
                            <select class="custom-select" id="questionnaries_id">
                                <option></option>
                                @foreach($questionnaries_list as $questionnaries)
                                    <option value="{{$questionnaries->id}}">{{$questionnaries->title_en}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                            data-target="#addQuestionType">
                        {{__("Add Question Type")}}
                    </button>
                    <table id="questiontypeTable"
                           class="table table-hover table-bordered dataTable no-footer table-full-width"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Questionnary</th>
                            <th>Type(EN)</th>
                            <th>Type(BR)</th>
                            <th>Content(EN)</th>
                            <th>Content(BR)</th>
                            <th>PDF Content(EN)</th>
                            <th>PDF Content(BR)</th>
                            <th>PDF Do List(EN)</th>
                            <th>PDF Do List(BR)</th>
                            <th>PDF DoNot List(ER)</th>
                            <th>PDF DoNot List(BR)</th>
                            <th>Image</th>
                            <th>Datetime</th>
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

    <div class="modal fade" id="editQuestionType" data-backdrop="static" data-keyboard="false" tabindex="-1"
         role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Question Type Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" accept-charset="UTF-8" action="{{route('admin.updateQuestionType')}}"
                      method="POST">
                    @csrf
                    <div class="modal-body">
                        <input name="id" class="form-control" type="hidden" id="edit_id">
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_questionnaries_id" class="col-3 col-form-label">{{__("Questionnary")}}
                                :</label>
                            <div class="col-9">
                                <select class="custom-select" id="edit_questionnaries_id" name="questionnaries_id">
                                    @foreach($questionnaries_list as $questionnaries)
                                        <option value="{{$questionnaries->id}}">{{$questionnaries->title_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_type_en" class="col-3 col-form-label">{{__("Type(EN)")}}:</label>
                            <div class="col-9">
                                <input name="type_en" class="form-control" type="text" id="edit_type_en">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_type_br" class="col-3 col-form-label">{{__("Type(BR)")}}:</label>
                            <div class="col-9">
                                <input name="type_br" class="form-control" type="text" id="edit_type_br">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_content_en" class="col-3 col-form-label">{{__("Content(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="content_en" class="form-control" rows="4"
                                          id="edit_content_en"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_content_br" class="col-3 col-form-label">{{__("Content(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="content_br" class="form-control" rows="4"
                                          id="edit_content_br"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_pdf_content_en" class="col-3 col-form-label">{{__("PDF Content(EN)")}}
                                :</label>
                            <div class="col-9">
                                <textarea name="pdf_content_en" class="form-control" rows="4"
                                          id="edit_pdf_content_en"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_pdf_content_br" class="col-3 col-form-label">{{__("PDF Content(BR)")}}
                                :</label>
                            <div class="col-9">
                                <textarea name="pdf_content_br" class="form-control" rows="4"
                                          id="edit_pdf_content_br"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_pdf_do_en" class="col-3 col-form-label">{{__("PDF Do List(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="pdf_do_en" class="form-control" rows="4"
                                          id="edit_pdf_do_en"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_pdf_do_br" class="col-3 col-form-label">{{__("PDF Do List(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="pdf_do_br" class="form-control" rows="4"
                                          id="edit_pdf_do_br"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_pdf_donot_en" class="col-3 col-form-label">{{__("PDF Do Not List(EN)")}}
                                :</label>
                            <div class="col-9">
                                <textarea name="pdf_donot_en" class="form-control" rows="4"
                                          id="edit_pdf_donot_en"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_pdf_donot_br" class="col-3 col-form-label">{{__("PDF Do Not List(BR)")}}
                                :</label>
                            <div class="col-9">
                                <textarea name="pdf_donot_br" class="form-control" rows="4"
                                          id="edit_pdf_donot_br"></textarea>
                            </div>
                        </div>

                        <div class="input-group row m-0 pt-2">
                            <label for="edit_image" class="col-3 col-form-label">{{__("Image")}}:</label>
                            <div class="col-9">
                                <input type="file" name="image" class="form-control" id="edit_image">
                            </div>
                            <img id="view_img" class="col-12" style="max-width:100%;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("cancel")}}</button>
                        <button type="button" class="btn btn-danger"
                                onclick="deleteQuestionType();">{{__("delete")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("update")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addQuestionType" data-backdrop="static" data-keyboard="false" tabindex="-1"
         role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Question Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addForm" accept-charset="UTF-8" action="{{route('admin.addQuestionType')}}"
                      method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group row m-0 pt-2">
                            <label for="add_questionnaries_id" class="col-3 col-form-label">{{__("Questionnary")}}
                                :</label>
                            <div class="col-9">
                                <select class="custom-select" id="add_questionnaries_id" name="questionnaries_id">
                                    @foreach($questionnaries_list as $questionnaries)
                                        <option value="{{$questionnaries->id}}">{{$questionnaries->title_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_type_en" class="col-3 col-form-label">{{__("Type(EN)")}}:</label>
                            <div class="col-9">
                                <input name="type_en" class="form-control" type="text" id="add_type_en">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_type_br" class="col-3 col-form-label">{{__("Type(BR)")}}:</label>
                            <div class="col-9">
                                <input name="type_br" class="form-control" type="text" id="add_type_br">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_content_en" class="col-3 col-form-label">{{__("Content(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="content_en" class="form-control" rows="4"
                                          id="add_content_en"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_content_br" class="col-3 col-form-label">{{__("Content(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="content_br" class="form-control" rows="4"
                                          id="add_content_br"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_pdf_content_en" class="col-3 col-form-label">{{__("PDF Content(EN)")}}
                                :</label>
                            <div class="col-9">
                                <textarea name="pdf_content_en" class="form-control" rows="4"
                                          id="add_pdf_content_en"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_pdf_content_br" class="col-3 col-form-label">{{__("PDF Content(BR)")}}
                                :</label>
                            <div class="col-9">
                                <textarea name="pdf_content_br" class="form-control" rows="4"
                                          id="add_pdf_content_br"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_pdf_do_en" class="col-3 col-form-label">{{__("PDF Do List(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="pdf_do_en" class="form-control" rows="4"
                                          id="add_pdf_do_en"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_pdf_do_br" class="col-3 col-form-label">{{__("PDF Do List(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="pdf_do_br" class="form-control" rows="4"
                                          id="add_pdf_do_br"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_pdf_donot_en" class="col-3 col-form-label">{{__("PDF Do Not List(EN)")}}
                                :</label>
                            <div class="col-9">
                                <textarea name="pdf_donot_en" class="form-control" rows="4"
                                          id="add_pdf_donot_en"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_pdf_donot_br" class="col-3 col-form-label">{{__("PDF Do Not List(BR)")}}
                                :</label>
                            <div class="col-9">
                                <textarea name="pdf_donot_br" class="form-control" rows="4"
                                          id="add_pdf_donot_br"></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_image" class="col-3 col-form-label">{{__("Image")}}:</label>
                            <div class="col-9">
                                <input type="file" name="image" class="form-control" id="add_image">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("cancel")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("add")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        var question_type_list = {}, questiontypeTable;

        function editQuestionType(id) {
            var question_type = question_type_list[id];
            $("#edit_id").val(id);
            $("#edit_questionnaries_id").val(question_type.questionnaries_id);
            $("#edit_type_en").val(question_type.type_en);
            $("#edit_type_br").val(question_type.type_br);
            $("#edit_content_en").val(question_type.content_en);
            $("#edit_content_br").val(question_type.content_br);
            $("#edit_pdf_content_en").val(question_type.pdf_content_en);
            $("#edit_pdf_content_br").val(question_type.pdf_content_br);
            $("#edit_pdf_do_en").val(question_type.pdf_do_en);
            $("#edit_pdf_do_br").val(question_type.pdf_do_br);
            $("#edit_pdf_donot_en").val(question_type.pdf_donot_en);
            $("#edit_pdf_donot_br").val(question_type.pdf_donot_br);
            $("#view_img").attr("src", question_type.image);
            $("#editQuestionType").modal("show");
        }

        function DtRender_edit_function(data, type, full, meta) {
            var html =
                '<button style="padding: 5px 10px 5px 10px;" class="btn btn-primary" onclick="editQuestionType(' + full.id + ');">' +
                '<i class="fa fa-edit"></i></button>';
            question_type_list[full.id] = full;
            return html;
        }

        function DtRender_image_function(data, type, full, meta) {
            var url = full.image ? full.image : "";
            var html = '<a href="' + url + '" target="_blank">' + url + '</a>';
            return html;
        }

        function DtRender_ellipse_function(data, type, full, meta) {
            var ret = data && data.length > 100 ? data.substr(0, 100) + "..." : data;
            return ret;
        }

        $("#addForm").validate({
            lang: 'en',
            rules: {
                type_en: {required: true},
                type_br: {required: true}
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
                        $("#addQuestionType").modal("hide");
                        $('#questiontypeTable').DataTable().ajax.reload();
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
                type_en: {required: true},
                type_br: {required: true},
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
                        $("#editQuestionType").modal("hide");
                        $('#questiontypeTable').DataTable().ajax.reload();
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

        function deleteQuestionType() {
            swal({
                title: "Do you want to completely remove it?",
                text: "{{__("You won't be able to revert this!")}}",
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
                            });
                            $("#editQuestionType").modal("hide");
                            $('#questiontypeTable').DataTable().ajax.reload();
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
                        "{{route("admin.deleteQuestionType")}}",
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

        $(document).ready(function () {
            var questiontypeTable = $('#questiontypeTable').DataTable({
                "scrollX": true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('admin.getQuestionTypeList')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        $.extend(d, {
                            _token: "{{csrf_token()}}",
                            questionnaries_id: $("#questionnaries_id").val(),
                        });
                    }
                },
                columns: [
                    {name: "no", data: "no", orderable: false,},
                    {name: "title_en", data: "title_en",},
                    {name: "type_en", data: "type_en",},
                    {name: "type_br", data: "type_br",},
                    {name: "content_en", data: "content_en", render: DtRender_ellipse_function},
                    {name: "content_br", data: "content_br", render: DtRender_ellipse_function},
                    {name: "pdf_content_en", data: "pdf_content_en", render: DtRender_ellipse_function},
                    {name: "pdf_content_br", data: "pdf_content_br", render: DtRender_ellipse_function},
                    {name: "pdf_do_en", data: "pdf_do_en", render: DtRender_ellipse_function},
                    {name: "pdf_do_br", data: "pdf_do_br", render: DtRender_ellipse_function},
                    {name: "pdf_donot_en", data: "pdf_donot_en", render: DtRender_ellipse_function},
                    {name: "pdf_donot_br", data: "pdf_donot_br", render: DtRender_ellipse_function},
                    {
                        name: "image",
                        data: "image",
                        className: "dt-center",
                        render: DtRender_image_function

                    },
                    {name: "datetime", data: "datetime",},
                    {
                        name: "id",
                        data: "id",
                        defaultContent: "",
                        className: "dt-center",
                        orderable: false,
                        render: DtRender_edit_function
                    }
                ],
                order: [[14, 'asc']]
            });

            $("#questionnaries_id").change(function () {
                $('#questiontypeTable').DataTable().ajax.reload();
            });
        })
    </script>
@endsection
