@extends('layouts.app')

@section('content')
    <section class="select2-container">
        <h1 class="mt-5">{{$questionnary->title}}</h1>
        <div class="mt-5">
            <span>
                {{$questionnary->content}}
            </span>
        </div>
        <img class="mt-3" src="{{$questionnary->image}}" width="100%">
        <div class="row my-3">
            <div class="col-12">
                <button class="btn btn-primary btn-lg float-right px-5" onclick="start();">{{__('Start')}}</button>
            </div>
        </div>
    </section>
    <section class="select2-container" id="question_board">
        <form id="submitAnswers" method="POST" action="{{ route('frontend.addAssessment') }}" accept-charset="UTF-8">
            @csrf
            <input type="hidden" name="questionnaries_id" value="{{$questionnary->id}}">
            <div class="row mt-5 mx-5">
                <span style="color: #aaaaaa;">
                    {{__("LP_Instruction")}}
                </span>
            </div>
            @foreach($questionnary->type_list as $question_type)
                <div class="row mt-5">
                    <div class="question-type col-12">{{$question_type->type}}</div>
                </div>
                <div class="row px-5">
                    <div class="col-lg-2 col-md-2 col-sm-4"><img src="{{$question_type->image}}" width="100%"></div>
                    <div class="col-lg-10 col-md-10 col-sm-8 mt-4 m-auto"><span>{{$question_type->content}}</span></div>
                </div>
                @foreach($question_type->question_list as $question)
                    <div class="row my-4 px-5 question" data-question_id="{{$question->id}}">
                        <div class="col-lg-8 my-3">{{$question->question}}</div>
                        <div class="col-lg-4 d-inline-flex rate-box" data-toggle="tooltip"
                             title="{{$questionnary->rate_tooltip}}">
                            @for($i=0;$i<6;$i++)
                                <div class="custom-control custom-radio mx-2">
                                    <input type="radio" id="{{$question->id.'_'.$i}}" name="score[{{$question->id}}]"
                                           class="custom-control-input" value="{{$i}}">
                                    <label class="custom-control-label" for="{{$question->id.'_'.$i}}"><span
                                                class="radio-label">{{$i}}</span></label>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endforeach
            @endforeach
            <div class="row my-3 mx-5">
                <span style="color: #aaaaaa;">
                    {{__("LP_EndInstruct")}}
                </span>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <button class="btn btn-primary btn-lg float-right px-5" type="button" data-toggle="tooltip"
                            title="{{__('LP_OnMouseOver_SubmitB')}}"
                            onclick="submitAnswers(1);">{{__('Submit Answers')}}</button>
                </div>
            </div>
        </form>
    </section>

    <div class="modal fade" id="answerResult" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="z-index: 100;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">{{$questionnary->title}} {{__("Result")}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row m-4">
                            <span>
                                {{__('RP_Generaltext',['title' => $questionnary->title])}}
                            </span>
                    </div>
                    <div class="row m-5">
                        <div class="col-3 my-5"><img id="score_image" src="" width="100%"></div>
                        <div class="col-9 p-5"><span id="summary"></span></div>
                    </div>
                    <form id="addForm" accept-charset="UTF-8" action="" method="POST">
                        <div class="input-group row m-0 pt-2">
                            <label for="add_name" class="col-3 col-form-label">{{__("Name")}}:</label>
                            <div class="col-9">
                                <input name="name" class="form-control" type="text" id="add_name">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_lastname" class="col-3 col-form-label">{{__("Lastname")}}:</label>
                            <div class="col-9">
                                <input name="lastname" class="form-control" type="text" id="add_lastname">
                            </div>
                        </div>
                        <div class="input-group row m-0 pt-2">
                            <label for="add_email" class="col-3 col-form-label">{{__("Email")}}:</label>
                            <div class="col-9">
                                <input name="email" class="form-control" type="email" id="add_email">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{__("Cancel")}}</button>
                            <button type="button" class="btn btn-primary" data-toggle="tootip"
                                    title="{{__("RP_onMouseOver_SendRes")}}">{{__("Send Result")}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        function start() {
            $('html, body').animate({
                scrollTop: $("#question_board").offset().top
            }, 1000);
        }

        function submitAnswers(finalize) {
            var $questions = $("div.question");
            var num_questions = $questions.length,
                success = true;
            for (var i = 0; i < num_questions; i++) {
                var $question_div = $($questions[i]);
                var question_id = $question_div.data("question_id");
                var score = $("input[name='score[" + question_id + "]']:checked").val();
                if (score == undefined) {
                    if (finalize) {
                        success = false;
                        break;
                    } else {
                        score = 0;
                    }
                }
            }
            if (success) {
                $("#submitAnswers").submit();
            } else {
                swal({
                    title: "{{__('Attention!')}}",
                    text: "{{__('LP_ErrorMsg_WhenSubmit')}}",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{__("Return")}}",
                    cancelButtonText: "{{__("Finalize")}}"
                }).then((result) => {
                    if (result.value) {
                        for (var i = 0; i < num_questions; i++) {
                            var $question_div = $($questions[i]);
                            var question_id = $question_div.data("question_id");
                            var score = $("input[name='score[" + question_id + "]']:checked").val();
                            if (score == undefined) {
                                $question_div.addClass('error');
                            }
                        }
                    }
                    else {
                        submitAnswers(0);
                    }
                });
            }
        }

        $(document).ready(function () {
            var $questions = $("div.question");
            var num_questions = $questions.length;
            for (var i = 0; i < num_questions; i++) {
                $($questions[i]).on("click", function () {
                    $(this).removeClass("error");
                    $(this).children(".rate-box").tooltip('hide');
                })
            }
        });
    </script>
@endsection