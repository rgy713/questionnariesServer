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
                    <table id="assessmentTable"
                           class="table table-hover table-bordered dataTable no-footer table-full-width"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Questionnary</th>
                            <th>Rate(%)</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>IP Address</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Datetime</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewDetail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Assessment Rate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="rateTable" class="table table-hover table-bordered dataTable no-footer table-full-width"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>Questionnary</th>
                            <th>Type</th>
                            <th>Question</th>
                            <th>Rate</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">

        function viewDetail(session_id) {
            var success = function (data) {
                    var $rateTable = $("#rateTable > tbody");
                    $rateTable.html("");
                    var tbody = "";
                    for (var i = 0; i < data.length; i++) {
                        tbody += "<tr>" +
                            "<td>" + data[i].title + "</td>" +
                            "<td>" + data[i].type + "</td>" +
                            "<td>" + data[i].question + "</td>" +
                            "<td>" + data[i].rate + "</td>" +
                            "</tr>"
                    }
                    $rateTable.html(tbody);
                    $("#viewDetail").modal("show");
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
                "{{route("admin.getAssessmentRate")}}",
                {
                    _token: "{{csrf_token()}}",
                    session_id: session_id
                },
                success,
                error,
                true
            );
        }

        function DtRender_view_function(data, type, full, meta) {
            var html =
                '<button style="padding: 5px 10px 5px 10px;" class="btn btn-primary" onclick="viewDetail(\'' + full.session_id + '\');">' +
                '<i class="fa fa-edit"></i></button>';
            return html;
        }

        $(document).ready(function () {
            var questiontypeTable = $('#assessmentTable').DataTable({
                "scrollX": true,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('admin.getAssessmentList')}}",
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
                    {name: "title", data: "title",},
                    {name: "avg_rate", data: "avg_rate",},
                    {name: "name", data: "name",},
                    {name: "email", data: "email",},
                    {name: "ip_addr", data: "ip_addr",},
                    {name: "country", data: "country",},
                    {name: "city", data: "city",},
                    {name: "latitude", data: "latitude",},
                    {name: "longitude", data: "longitude"},
                    {name: "datetime", data: "datetime",},
                    {
                        name: "session_id",
                        data: "session_id",
                        defaultContent: "",
                        className: "dt-center",
                        orderable: false,
                        render: DtRender_view_function
                    }
                ],
                order: [[10, 'desc']]
            });

            $("#questionnaries_id").change(function () {
                $('#assessmentTable').DataTable().ajax.reload();
            });
        })
    </script>
@endsection
