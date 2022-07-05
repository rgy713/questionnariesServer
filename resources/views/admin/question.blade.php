@extends('layouts.admin-base')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i>Question List</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#">question list</a></li>
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
                    <div class="row m-0">
                        <div class="input-group mb-3 col-md-10 col-lg-8">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Type</span>
                            </div>
                            <select class="custom-select" id="type_id">
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary mb-3" onclick="addQuestion();">
                        {{__("Add Question")}}
                    </button>
                    <table id="questionTable" class="table responsive table-hover table-bordered dataTable no-footer table-full-width" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Questionnary</th>
                            <th>Type</th>
                            <th>Question(EN)</th>
                            <th>Question(BR)</th>
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

    <div class="modal fade" id="editQuestion" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Question Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" accept-charset="UTF-8" action="{{route('admin.updateQuestion')}}"
                      method="POST">
                    @csrf
                    <div class="modal-body">
                        <input name="id" class="form-control" type="hidden" id="edit_id">
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_question_en" class="col-3 col-form-label">{{__("Question(EN)")}}:</label>
                            <div class="col-9">
                                <input name="question_en" class="form-control" type="text" id="edit_question_en">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_question_br" class="col-3 col-form-label">{{__("Question(BR)")}}:</label>
                            <div class="col-9">
                                <input name="question_br" class="form-control" type="text" id="edit_question_br">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_questionnaries_id" class="col-3 col-form-label">{{__("Questionnary")}}:</label>
                            <div class="col-9">
                                <select class="custom-select" id="edit_questionnaries_id" name="questionnaries_id">
                                    @foreach($questionnaries_list as $questionnaries)
                                        <option value="{{$questionnaries->id}}">{{$questionnaries->title_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_type_id" class="col-3 col-form-label">{{__("Type")}}:</label>
                            <div class="col-9">
                                <select class="custom-select" id="edit_type_id" name="type_id">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("cancel")}}</button>
                        <button type="button" class="btn btn-danger" onclick="deleteQuestion();">{{__("delete")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("update")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addQuestion" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addForm" accept-charset="UTF-8" action="{{route('admin.addQuestion')}}"
                      method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group row m-0 pt-2">
                            <label for="add_question_en" class="col-3 col-form-label">{{__("Question(EN)")}}:</label>
                            <div class="col-9">
                                <input name="question_en" class="form-control" type="text" id="add_question_en">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_question_br" class="col-3 col-form-label">{{__("Question(BR)")}}:</label>
                            <div class="col-9">
                                <input name="question_br" class="form-control" type="text" id="add_question_br">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_questionnaries_id" class="col-3 col-form-label">{{__("Questionnary")}}:</label>
                            <div class="col-9">
                                <select class="custom-select" id="add_questionnaries_id" name="questionnaries_id">
                                    @foreach($questionnaries_list as $questionnaries)
                                        <option value="{{$questionnaries->id}}">{{$questionnaries->title_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_type_id" class="col-3 col-form-label">{{__("Type")}}:</label>
                            <div class="col-9">
                                <select class="custom-select" id="add_type_id" name="type_id">
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
@endsection

@section('js')
    <script type="text/javascript">
        function editQuestion(id) {
            var $btn = $("button#" + id);

            $("#edit_id").val(id);
            $("#edit_question_en").val($btn.data('question_en'));
            $("#edit_question_br").val($btn.data('question_br'));
            $("#edit_questionnaries_id").val($btn.data('questionnaries_id')).prop("selected", true);;

            var success = function(){
                    $("#edit_type_id").val($btn.data('type_id')).prop("selected", true);
                    $("#editQuestion").modal("show");
                },
                error = function(){

                };

            getAddQuestiontypeList('edit', success, error);
        }

        function getAddQuestiontypeList(ae, success, error) {
            var $questionnaries = $("#"+ae+"_questionnaries_id"),
                $question_type = $("#"+ae+"_type_id");
            if (!$questionnaries.val()) {
                $question_type.html("");
                return;
            }
            var data = {
                    _token: "{{csrf_token()}}",
                    questionnaries_id: $questionnaries.val(),
                },
                onSuccess = function (data) {
                    var select_html = "";
                    for (i = 0; i < data.length; i++) {
                        var one = data[i];
                        select_html += "<option value='" + one["id"] + "'>" + one["type_en"] + "</option>";
                    }
                    $question_type.html(select_html);
                    success && success();
                },
                onError = function (data) {
                    error && error();
                };
            ajax_json(
                "POST",
                "{{ route('admin.utils.getQuestionTypeList') }}",
                data,
                onSuccess,
                onError
            );
        }

        function addQuestion(){
            $("#add_question_en").val("");
            $("#add_question_br").val("");
            if($("#questionnaries_id").val())
                $("#add_questionnaries_id").val($("#questionnaries_id").val()).prop("selected", true);

            var success = function(){
                    if($("#type_id").val())
                        $("#add_type_id").val($("#type_id").val()).prop("selected", true);
                    $("#addQuestion").modal("show");
                },
                error = function(){

                };

            getAddQuestiontypeList('add', success, error);
        }


        function DtRender_edit_function(data, type, full, meta) {
            var html =
                '<button id="' + full.id +'" ' + 'data-question_en="' + full.question_en + '" data-question_br="' + full.question_br +'" '+
                'data-type_id="' + full.type_id +'" ' + 'data-questionnaries_id="' + full.questionnaries_id +'" ' +
                ' style="padding: 5px 5px 5px 10px;" class="btn btn-primary" onclick="editQuestion(' + full.id + ');">' +
                '<i class="fa fa-edit"></i></button>'
            ;

            return html;
        }

        $("#addForm").validate({
            lang: 'en',
            rules: {
                quesition_en: {required: true},
                quesition_br: {required: true},
                questionnaries_id: {required: true},
                question_type_id: {required: true},
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
                        $("#addQuestion").modal("hide");
                        $('#questionTable').DataTable().ajax.reload();
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
                quesition_en: {required: true},
                quesition_br: {required: true},
                questionnaries_id: {required: true},
                question_type_id: {required: true},
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
                        $("#editQuestion").modal("hide");
                        $('#questionTable').DataTable().ajax.reload();
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

        function deleteQuestion(){
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
                            $("#editQuestion").modal("hide");
                            $('#questionTable').DataTable().ajax.reload();
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
                        "{{route("admin.deleteQuestion")}}",
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

        $(document).ready(function() {
            var questionTable = $('#questionTable').DataTable({
                "scrollX": true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('admin.getQuestionList')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        $.extend(d, {
                            _token: "{{csrf_token()}}",
                            questionnaries_id: $("#questionnaries_id").val(),
                            type_id: $("#type_id").val(),
                        });
                    }
                },
                columns: [
                    {name: "no", data: "no", orderable: false,},
                    {name: "title_en", data: "title_en",},
                    {name: "type_en", data: "type_en",},
                    {name: "question_en", data: "question_en",},
                    {name: "question_br", data: "question_br",},
                    {name: "datetime", data: "datetime",},
                    {
                        name: "id",
                        data: "id",
                        defaultContent: "",
                        className: "dt-center",
                        orderable: false,
                        render: DtRender_edit_function
                    },
                    {name: "questionnaries_id", data: "questionnaries_id",visible: false,},
                    {name: "type_id", data: "type_id",visible: false,},
                ],
                order: [[7, 'asc'],[8, 'asc'],[6, 'asc']]
            });

            var getQuestiontypeList = function () {
                if (!$("#questionnaries_id").val()) {
                    $("#type_id").html("");
                    return;
                }
                var data = {
                        _token: "{{csrf_token()}}",
                        questionnaries_id: $("#questionnaries_id").val(),
                    },
                    onSuccess = function (data) {
                        var select_html = "<option></option>";
                        for (i = 0; i < data.length; i++) {
                            var one = data[i];
                            select_html += "<option value='" + one["id"] + "'>" + one["type_en"] + "</option>";
                        }
                        $("#type_id").html(select_html);
                    },
                    onError = function (data) {

                    };
                ajax_json(
                    "POST",
                    "{{ route('admin.utils.getQuestionTypeList') }}",
                    data,
                    onSuccess,
                    onError
                );
            };


            getQuestiontypeList();

            $("#questionnaries_id").change(function () {
                getQuestiontypeList();
                $('#questionTable').DataTable().ajax.reload();
            });

            $("#type_id").change(function () {
                $('#questionTable').DataTable().ajax.reload();
            });

            $("#edit_questionnaries_id").change(function () {
                getAddQuestiontypeList('edit');
            });

            $("#add_questionnaries_id").change(function () {
                getAddQuestiontypeList('add');
            });
        });

    </script>
@endsection
