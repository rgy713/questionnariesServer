@extends('layouts.admin-base')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i>Questionnaries List</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#">questionnaries list</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addQuestionnaries">
                        {{__("Add Questionnaries")}}
                    </button>
                    <table id="questionnariesTable" class="table table-hover table-bordered dataTable no-footer table-full-width" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Title(EN)</th>
                            <th>Title(BR)</th>
                            <th>Content(EN)</th>
                            <th>Content(BR)</th>
                            <th>Image</th>
                            <th>Rate Tooltip(EN)</th>
                            <th>Rate Tooltip(BR)</th>
                            <th>General Summary(EN)</th>
                            <th>General Summary(BR)</th>
                            <th>Summary 25%(EN)</th>
                            <th>Summary 25%(BR)</th>
                            <th>Summary 50%(EN)</th>
                            <th>Summary 50%(BR)</th>
                            <th>Summary 75%(EN)</th>
                            <th>Summary 75%(BR)</th>
                            <th>Summary 100%(EN)</th>
                            <th>Summary 100%(BR)</th>
                            <th>Score Image 25%</th>
                            <th>Score Image 50%</th>
                            <th>Score Image 75%</th>
                            <th>Score Image 100%</th>
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

    <div class="modal fade" id="editQuestionnaries" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Questionnaries Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" accept-charset="UTF-8" action="{{route('admin.updateQuestionnaries')}}"
                      method="POST">
                    @csrf
                    <div class="modal-body">
                        <input name="id" class="form-control" type="hidden" id="edit_id">
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_title_en" class="col-3 col-form-label">{{__("Title(EN)")}}:</label>
                            <div class="col-9">
                                <input name="title_en" class="form-control" type="text" id="edit_title_en">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_title_br" class="col-3 col-form-label">{{__("Title(BR)")}}:</label>
                            <div class="col-9">
                                <input name="title_br" class="form-control" type="text" id="edit_title_br">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_content_en" class="col-3 col-form-label">{{__("Content(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="content_en" class="form-control" rows="4" id="edit_content_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_content_br" class="col-3 col-form-label">{{__("Content(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="content_br" class="form-control" rows="4" id="edit_content_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_image" class="col-3 col-form-label">{{__("Image")}}:</label>
                            <div class="col-9">
                                <input type="file" name="image" class="form-control" id="edit_image">
                            </div>
                            <img id="view_img" class="col-12" style="max-width:100%;">
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_rate_tooltip_en" class="col-3 col-form-label">{{__("Rate Tooltip(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="rate_tooltip_en" class="form-control" rows="4" id="edit_rate_tooltip_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_rate_tooltip_br" class="col-3 col-form-label">{{__("Rate Tooltip(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="rate_tooltip_br" class="form-control" rows="4" id="edit_rate_tooltip_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_summary_en" class="col-3 col-form-label">{{__("Summary(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary_en" class="form-control" rows="4" id="edit_summary_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_summary_br" class="col-3 col-form-label">{{__("Summary(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary_br" class="form-control" rows="4" id="edit_summary_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_summary25_en" class="col-3 col-form-label">{{__("Summary25%(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary25_en" class="form-control" rows="4" id="edit_summary25_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_summary25_br" class="col-3 col-form-label">{{__("Summary25%(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary25_br" class="form-control" rows="4" id="edit_summary25_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_summary50_en" class="col-3 col-form-label">{{__("Summary50%(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary50_en" class="form-control" rows="4" id="edit_summary50_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_summary50_br" class="col-3 col-form-label">{{__("Summary50%(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary50_br" class="form-control" rows="4" id="edit_summary50_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_summary75_en" class="col-3 col-form-label">{{__("Summary75%(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary75_en" class="form-control" rows="4" id="edit_summary75_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_summary75_br" class="col-3 col-form-label">{{__("Summary75%(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary75_br" class="form-control" rows="4" id="edit_summary75_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_summary100_en" class="col-3 col-form-label">{{__("Summary100%(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary100_en" class="form-control" rows="4" id="edit_summary100_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_summary100_br" class="col-3 col-form-label">{{__("Summary100%(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary100_br" class="form-control" rows="4" id="edit_summary100_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_score_image25" class="col-3 col-form-label">{{__("Score Image25%")}}:</label>
                            <div class="col-9">
                                <input type="file" name="score_image25" class="form-control" id="edit_score_image25">
                            </div>
                            <img id="view_img25" class="col-12 img-view">
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_score_image50" class="col-3 col-form-label">{{__("Score Image50%")}}:</label>
                            <div class="col-9">
                                <input type="file" name="score_image50" class="form-control" id="edit_score_image50">
                            </div>
                            <img id="view_img50" class="col-12 img-view">
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_score_image75" class="col-3 col-form-label">{{__("Score Image75%")}}:</label>
                            <div class="col-9">
                                <input type="file" name="score_image75" class="form-control" id="edit_score_image75">
                            </div>
                            <img id="view_img75" class="col-12 img-view">
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="edit_score_image100" class="col-3 col-form-label">{{__("Score Image100%")}}:</label>
                            <div class="col-9">
                                <input type="file" name="score_image100" class="form-control" id="edit_score_image100">
                            </div>
                            <img id="view_img100" class="col-12 img-view">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("cancel")}}</button>
                        <button type="button" class="btn btn-danger" onclick="deleteQuestionnaries();">{{__("delete")}}</button>
                        <button type="submit" class="btn btn-primary">{{__("update")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addQuestionnaries" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Questionnaries</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addForm" accept-charset="UTF-8" action="{{route('admin.addQuestionnaries')}}"
                      method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group row m-0 pt-2">
                            <label for="add_title_en" class="col-3 col-form-label">{{__("Title(EN)")}}:</label>
                            <div class="col-9">
                                <input name="title_en" class="form-control" type="text" id="add_title_en">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_title_br" class="col-3 col-form-label">{{__("Title(BR)")}}:</label>
                            <div class="col-9">
                                <input name="title_br" class="form-control" type="text" id="add_title_br">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_content_en" class="col-3 col-form-label">{{__("Content(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="content_en" class="form-control" rows="4" id="add_content_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_content_br" class="col-3 col-form-label">{{__("Content(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="content_br" class="form-control" rows="4" id="add_content_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_image" class="col-3 col-form-label">{{__("Image")}}:</label>
                            <div class="col-9">
                                <input type="file" name="image" class="form-control" id="add_image">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_rate_tooltip_en" class="col-3 col-form-label">{{__("Rate Tooltip(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="rate_tooltip_en" class="form-control" rows="4" id="add_rate_tooltip_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_rate_tooltip_br" class="col-3 col-form-label">{{__("Rate Tooltip(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="rate_tooltip_br" class="form-control" rows="4" id="add_rate_tooltip_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_summary_en" class="col-3 col-form-label">{{__("Summary(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary_en" class="form-control" rows="4" id="add_summary_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_summary_br" class="col-3 col-form-label">{{__("Summary(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary_br" class="form-control" rows="4" id="add_summary_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_summary25_en" class="col-3 col-form-label">{{__("Summary25%(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary25_en" class="form-control" rows="4" id="add_summary25_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_summary25_br" class="col-3 col-form-label">{{__("Summary25%(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary25_br" class="form-control" rows="4" id="add_summary25_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_summary50_en" class="col-3 col-form-label">{{__("Summary50%(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary50_en" class="form-control" rows="4" id="add_summary50_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_summary50_br" class="col-3 col-form-label">{{__("Summary50%(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary50_br" class="form-control" rows="4" id="add_summary50_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_summary75_en" class="col-3 col-form-label">{{__("Summary75%(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary75_en" class="form-control" rows="4" id="add_summary75_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_summary75_br" class="col-3 col-form-label">{{__("Summary75%(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary75_br" class="form-control" rows="4" id="add_summary75_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_summary100_en" class="col-3 col-form-label">{{__("Summary100%(EN)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary100_en" class="form-control" rows="4" id="add_summary100_en" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_summary100_br" class="col-3 col-form-label">{{__("Summary100%(BR)")}}:</label>
                            <div class="col-9">
                                <textarea name="summary100_br" class="form-control" rows="4" id="add_summary100_br" required></textarea>
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_score_image25" class="col-3 col-form-label">{{__("Score Image25%")}}:</label>
                            <div class="col-9">
                                <input type="file" name="score_image25" class="form-control" id="add_score_image25">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_score_image50" class="col-3 col-form-label">{{__("Score Image50%")}}:</label>
                            <div class="col-9">
                                <input type="file" name="score_image50" class="form-control" id="add_score_image50">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_score_image75" class="col-3 col-form-label">{{__("Score Image75%")}}:</label>
                            <div class="col-9">
                                <input type="file" name="score_image75" class="form-control" id="add_score_image75">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_score_image100" class="col-3 col-form-label">{{__("Score Image100%")}}:</label>
                            <div class="col-9">
                                <input type="file" name="score_image100" class="form-control" id="add_score_image100">
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
        var questionnaries_list = {};
        function editQuestionnaries(id) {
            var questionnary = questionnaries_list[id];
            $("#edit_id").val(id);
            $("#edit_title_en").val(questionnary.title_en);
            $("#edit_title_br").val(questionnary.title_br);
            $("#edit_content_en").val(questionnary.content_en);
            $("#edit_content_br").val(questionnary.content_br);
            $("#view_img").attr("src", questionnary.image);
            $("#edit_rate_tooltip_en").val(questionnary.rate_tooltip_en);
            $("#edit_rate_tooltip_br").val(questionnary.rate_tooltip_br);
            $("#edit_summary_en").val(questionnary.summary_en);
            $("#edit_summary_br").val(questionnary.summary_br);
            $("#edit_summary25_en").val(questionnary.summary25_en);
            $("#edit_summary25_br").val(questionnary.summary25_br);
            $("#edit_summary50_en").val(questionnary.summary50_en);
            $("#edit_summary50_br").val(questionnary.summary50_br);
            $("#edit_summary75_en").val(questionnary.summary75_en);
            $("#edit_summary75_br").val(questionnary.summary75_br);
            $("#edit_summary100_en").val(questionnary.summary100_en);
            $("#edit_summary100_br").val(questionnary.summary100_br);
            $("#view_img25").attr("src", questionnary.score_image25);
            $("#view_img50").attr("src", questionnary.score_image50);
            $("#view_img75").attr("src", questionnary.score_image75);
            $("#view_img100").attr("src", questionnary.score_image100);
            $("#editQuestionnaries").modal("show");
        }

        function DtRender_edit_function(data, type, full, meta) {
            var html =
                '<button style="padding: 5px 10px 5px 10px;" class="btn btn-primary" onclick="editQuestionnaries(' + full.id + ');">' +
                '<i class="fa fa-edit"></i></button>';
            questionnaries_list[full.id] = full;
            return html;
        }

        function DtRender_ellipse_function(data, type, full, meta) {
            var ret = data && data.length>100 ? data.substr(0,100) + "..." : data;
            return ret;
        }

        function DtRender_image_function(data, type, full, meta) {
            var url = full.image? full.image : "";
            var html = '<a href="' + url + '" target="_blank">' + url + '</a>';
            return html;
        }

        var questionnariesTable = $('#questionnariesTable').DataTable({
            "scrollX": true,
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{route('admin.getQuestionnariesList')}}",
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    $.extend(d, {_token: "{{csrf_token()}}"});
                }
            },
            columns: [
                {name: "no", data: "no", orderable: false, },
                {name: "title_en", data: "title_en", },
                {name: "title_br", data: "title_br", },
                {name: "content_en", data: "content_en", render: DtRender_ellipse_function},
                {name: "content_br", data: "content_br", render: DtRender_ellipse_function},
                {
                    name: "image",
                    data: "image",
                    className: "dt-center",
                    render: DtRender_image_function

                },
                {name: "rate_tooltip_en", data: "rate_tooltip_en", render: DtRender_ellipse_function},
                {name: "rate_tooltip_br", data: "rate_tooltip_br", render: DtRender_ellipse_function},
                {name: "summary_en", data: "summary_en", render: DtRender_ellipse_function},
                {name: "summary_br", data: "summary_br", render: DtRender_ellipse_function},
                {name: "summary25_en", data: "summary25_en", render: DtRender_ellipse_function},
                {name: "summary25_br", data: "summary25_br", render: DtRender_ellipse_function},
                {name: "summary50_en", data: "summary50_en", render: DtRender_ellipse_function},
                {name: "summary50_br", data: "summary50_br", render: DtRender_ellipse_function},
                {name: "summary75_en", data: "summary75_en", render: DtRender_ellipse_function},
                {name: "summary75_br", data: "summary75_br", render: DtRender_ellipse_function},
                {name: "summary100_en", data: "summary100_en", render: DtRender_ellipse_function},
                {name: "summary100_br", data: "summary100_br", render: DtRender_ellipse_function},
                {name: "score_image25", data: "score_image25", render: DtRender_image_function},
                {name: "score_image50", data: "score_image50", render: DtRender_image_function},
                {name: "score_image75", data: "score_image75", render: DtRender_image_function},
                {name: "score_image100", data: "score_image100", render: DtRender_image_function},
                {name: "datetime", data: "datetime", },
                {
                    name: "id",
                    data: "id",
                    defaultContent: "",
                    className: "dt-center",
                    orderable: false,
                    render: DtRender_edit_function
                }
            ],
            order: [[23, 'asc']]
        });

        $("#addForm").validate({
            lang: 'en',
            rules: {
                title_en: {required: true},
                title_br: {required: true}
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
                        $("#addQuestionnaries").modal("hide");
                        $('#questionnariesTable').DataTable().ajax.reload();
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
                title_en: {required: true},
                title_br: {required: true},
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
                        $("#editQuestionnaries").modal("hide");
                        $('#questionnariesTable').DataTable().ajax.reload();
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

        function deleteQuestionnaries(){
            swal({
                title: "Do you want to completely remove it?",
                text: "{{__("You won't be able to revert this!")}}",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{__("delete")}}",
                cancelButtonText: "{{__("cancel")}}"
            }, function(isConfirm){
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
                            });
                            $("#editQuestionnaries").modal("hide");
                            $('#questionnariesTable').DataTable().ajax.reload();
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
                        "{{route("admin.deleteQuestionnaries")}}",
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
