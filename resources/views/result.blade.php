@extends('layouts.app')

@section('content')
    <section class="select2-container">
        <h1 class="mt-5">{{$title}} {{__("Result")}}</h1>
        <div class="row m-4">
            <span>
                {{__('RP_Generaltext',['title' => $title])}}
            </span>
        </div>
        <div class="row m-4">
            <span>
                {!!__('RP_summaryGeneral')!!}
            </span>
        </div>
        <div class="row m-5">
            <div class="col-md-3 col-sm-12 my-5"><img id="score_image" src="{{$score_image}}" width="50%"></div>
            <div class="col-md-9 col-sm-12 p-5 m-auto">
                <span id="summary">
                    <h3>{{__("Average Score")}} {{$mean_rate}}%</h3><br/>
                    {{$summary}}
                </span>
            </div>
        </div>
        <div class="row m-4">
            <p>
                {!!__('RP_UserDataInstr')!!}
            </p>
            <p>
                {!!__('RP_EmailDisclaim')!!}
            </p>
        </div>
        <div class="clearfix m-5 px-5 pt-5" style="background-color: #e7f5ff; border: 1px solid #666666;">
            <form id="addForm" accept-charset="UTF-8" action="{{ route('frontend.addResult', $session_id)}}"
                  method="POST">
                @csrf
                <div class="input-group row m-0 pt-2">
                    <label for="add_firstname" class="col-md-3 col-form-label">{{__("Name")}}:</label>
                    <div class="col-md-9">
                        <input name="firstname" class="form-control" type="text" id="add_firstname" value="{{ old('firstname') }}" required>
                    </div>
                </div>
                <div class="input-group row m-0 pt-2">
                    <label for="add_lastname" class="col-md-3 col-form-label">{{__("Lastname")}}:</label>
                    <div class="col-md-9">
                        <input name="lastname" class="form-control" type="text" id="add_lastname" value="{{ old('lastname') }}" required>
                    </div>
                </div>
                <div class="input-group row m-0 pt-2">
                    <label for="add_email" class="col-md-3 col-form-label">{{__("E-mail")}}:</label>
                    <div class="col-md-9">
                        <input name="email" class="form-control {{ $errors->has('email_invalid') ? ' is-invalid' : '' }}" type="email" id="add_email" value="{{ old('email') }}" required>
                        @if ($errors->has('email_invalid'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{__('email_invalid')}}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-toggle="tooltip"
                            title="{{__("RP_onMouseOver_SendRes")}}">{{__("Send Result")}}</button>
                </div>
            </form>
        </div>
    </section>
@endsection