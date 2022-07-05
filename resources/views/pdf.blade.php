<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #031047;
            text-align: left;
            background-color: #fff;
        }

        @page {
            size: 595pt 842pt;
            margin: 0 0;
        }

        .page-break {
            page-break-after: always;
        }

        .one-page {
            width: 595pt;
            height: 842pt;
            position: relative;
        }

        .row {
            width: 100%;
        }

        .title {
            margin: 0;
            padding: 1rem 4rem;
            background-color: #558ed5;
            color: white;
            font-size: 28pt;
            font-weight: bold;
        }

        .sub-title {
            margin: 0;
            padding: 1rem 2rem;
            background-color: #558ed5;
            color: white;
            font-size: 18pt;
            font-weight: bold;
        }

        .sub-title-1 {
            margin: 0;
            padding: 0.5rem 2rem;
            background-color: #558ed5;
            color: white;
            font-size: 18pt;
            font-weight: bold;
        }

        .sub-title-2 {
            margin: 0;
            padding: 0 1rem;
            margin-bottom:0.5rem;
            background-color: #558ed5;
            color: white;
            font-size: 16pt;
            font-weight: bold;
        }

        .last-title {
            margin: 0;
            padding: 0.5rem 2rem;
            background-color: #558ed5;
            color: white;
            font-size: 18pt;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="one-page page-break">
    <div class="row" style="padding-top: 120pt;">
        <p class="title">{{$questionnary->title}} {{__("Result")}}</p>
    </div>
    <div class="row" style="margin-top: 80pt;">
        <h1 style="padding-left: 4rem; color: #031047;">
            {{__("Subheader")}}
        </h1>
    </div>
    <div class="row" style="margin-top: 40pt;">
        <img src="{{public_path($questionnary->image)}}" width="100%">
    </div>
    <div class="row" style="margin-top: 50pt;">
        <h1 style="color: #031047;text-align: center;">www.penguinconsultants.net</h1>
    </div>
    <div class="row" style="position: absolute;bottom: 0; background-color: #ffffff;">
        <table style="width: 100%;border-spacing: 0;">
            <tbody>
            <tr>
                <td style="width: 40%;padding-left: 2rem;">
                    <img src="{{public_path('images/footer_logo.png')}}" style="width: 150px; padding-top: 1.5rem;">
                    <p style="font-size: 16px; color: #031047; margin:-0.5rem 0 0.5rem 0;">{{__("Copyright")}}</p>
                </td>
                <td style="width: 10%;padding: 0">
                    <img src="{{public_path("images/footer1.png")}}" style="width: 80px;height: 100px;">
                </td>
                <td style="width: 50%;background-color:#ffc100;padding-right: 2rem;">
                    <p style="font-size: 14px;text-align: right; margin: 0;">Digital Transformist drivers at your
                        service!</p>
                    <p style="font-size: 12px;text-align: right; margin: 0;">info@penguinconsultants.net</p>
                    <div style="text-align: right; padding-top: 1rem;">
                        <a style="text-decoration: none;margin-left: 0.25rem;"
                           href="https://www.facebook.com/Penguinconsultants"
                           target="_blank">
                            <img src="{{public_path('images/footer_f.png')}}" width="35px">
                        </a>
                        <a style="text-decoration: none;margin-left: 0.25rem;"
                           href="https://www.linkedin.com/company/penguin-consultants-brasil/" target="_blank">
                            <img src="{{public_path('images/footer_i.png')}}" width="35px">
                        </a>
                        <a style="text-decoration: none;margin-left: 0.25rem;" href="https://twitter.com/valorizeit"
                           target="_blank">
                            <img src="{{public_path('images/footer_t.png')}}" width="35px">
                        </a>
                        <a style="text-decoration: none;margin-left: 0.25rem;" href="https://valorizeit.com"
                           target="_blank">
                            <img src="{{public_path('images/footer_b.png')}}" width="35px">
                        </a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="one-page page-break">
    <div class="row" style="padding-top: 15pt;">
        <p class="sub-title">{{$questionnary->title}} {{__("Result")}}</p>
    </div>
    <div class="row" style="padding:0.5rem 2rem;">
        <span style="color: #031047;line-height: 15pt;">
            {{__('PDF_RP_Generaltext',['title' => $questionnary->title])}}
        </span>
    </div>
    <div class="row" style="padding:0 2rem;@if(app()->getLocale()=='br')line-height: 15pt;@endif">
        <span style="color: #031047;">
            {!! __('RP_summaryGeneral') !!}
        </span>
    </div>
    <div class="row" style="padding:1rem 2rem;">
        <table width="100%" style="border:2px solid #ffc100; padding: 1rem;">
            <tbody>
            <tr>
                <td style="width: 15%; padding-left: 1rem; padding-top: 0.5rem;">
                    <img id="score_image" src="{{public_path($score_image)}}" width="70px">
                </td>
                <td style="width: 85%;padding-left: 1rem;">
                <span style="color:#031047;line-height: 15pt;">
                    <h3>{{__("Average Score")}} {{$mean_rate}}%</h3>
                    {{$summary}}
                </span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row" style="position: absolute;bottom: 0; background-color: #ffffff;">
        <table style="width: 100%;border-spacing: 0;">
            <tbody>
            <tr>
                <td style="width: 40%;padding-left: 2rem;">
                    <img src="{{public_path('images/footer_logo.png')}}" style="width: 150px; padding-top: 1.5rem;">
                    <p style="font-size: 16px; color: #031047; margin:-0.5rem 0 0.5rem 0;">{{__("Copyright")}}</p>
                </td>
                <td style="width: 10%;padding: 0">
                    <img src="{{public_path("images/footer1.png")}}" style="width: 80px;height: 100px;">
                </td>
                <td style="width: 50%;background-color:#ffc100;padding-right: 2rem;">
                    <p style="font-size: 14px;text-align: right; margin: 0;">Digital Transformist drivers at your
                        service!</p>
                    <p style="font-size: 12px;text-align: right; margin: 0;">info@penguinconsultants.net</p>
                    <div style="text-align: right; padding-top: 1rem;">
                        <a style="text-decoration: none;margin-left: 0.25rem;"
                           href="https://www.facebook.com/Penguinconsultants"
                           target="_blank">
                            <img src="{{public_path('images/footer_f.png')}}" width="35px">
                        </a>
                        <a style="text-decoration: none;margin-left: 0.25rem;"
                           href="https://www.linkedin.com/company/penguin-consultants-brasil/" target="_blank">
                            <img src="{{public_path('images/footer_i.png')}}" width="35px">
                        </a>
                        <a style="text-decoration: none;margin-left: 0.25rem;" href="https://twitter.com/valorizeit"
                           target="_blank">
                            <img src="{{public_path('images/footer_t.png')}}" width="35px">
                        </a>
                        <a style="text-decoration: none;margin-left: 0.25rem;" href="https://valorizeit.com"
                           target="_blank">
                            <img src="{{public_path('images/footer_b.png')}}" width="35px">
                        </a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@foreach($questionnary->type_list as $question_type)
    <div class="one-page page-break">
        <div class="row" style="padding-top: 20pt;">
            <p class="sub-title-1">{{$question_type->type}}</p>
        </div>
        <div class="row" style="padding:1rem;">
            <table width="100%">
                <tbody>
                <tr>
                    <td style="width: 15%;vertical-align: top;">
                        <img src="{{public_path($question_type->image)}}" width="100px">
                    </td>
                    <td style="width: 70%;">
                        <span style="color: #031047;">{{$question_type->pdf_content}}</span>
                    </td>
                    <td style="width: 15%; padding-left: 1rem;vertical-align: top;">
                        <img id="score_image" src="{{public_path($question_type->score_image)}}" width="50px;">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row" style="padding:0 1rem 1rem 1rem;">
            <table width="100%">
                <tbody>
                <tr>
                    <td style="width: 50%;vertical-align: top;">
                        <img src="{{public_path("images/Ai_SHOULD.png")}}" width="70px;"
                             style="padding-left: 1rem;padding-top: 1rem;">
                        <ul style="margin:0;color: #031047;">
                            {!!$question_type->pdf_do!!}
                        </ul>
                    </td>
                    <td style="width: 50%;vertical-align: top;">
                        <img src="{{public_path("images/Ai_SHOULD_NOT.png")}}" width="70px;"
                             style="padding-left: 1rem;padding-top: 1rem;">
                        <ul style="margin:0;color: #031047;">
                            {!!$question_type->pdf_donot!!}
                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        @foreach($question_type->question_list as $question)
            <div class="row" style="padding:0 2rem;">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td style="width: 85%;color: #031047; border-bottom: 1px solid #dddddd;">{{$question->question}}</td>
                        <td style="width: 15%; padding-left: 1rem;">
                            <img src="{{public_path("images/answer_".$question->rate.".png")}}" width="45px;">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
        <div class="row" style="position: absolute;bottom: 0; background-color: #ffffff;">
            <table style="width: 100%;border-spacing: 0;">
                <tbody>
                <tr>
                    <td style="width: 40%;padding-left: 2rem;">
                        <img src="{{public_path('images/footer_logo.png')}}" style="width: 150px; padding-top: 1.5rem;">
                        <p style="font-size: 16px; color: #031047; margin:-0.5rem 0 0.5rem 0;">{{__("Copyright")}}</p>
                    </td>
                    <td style="width: 10%;padding: 0">
                        <img src="{{public_path("images/footer1.png")}}" style="width: 80px;height: 100px;">
                    </td>
                    <td style="width: 50%;background-color:#ffc100;padding-right: 2rem;">
                        <p style="font-size: 14px;text-align: right; margin: 0;">Digital Transformist drivers at your
                            service!</p>
                        <p style="font-size: 12px;text-align: right; margin: 0;">info@penguinconsultants.net</p>
                        <div style="text-align: right; padding-top: 1rem;">
                            <a style="text-decoration: none;margin-left: 0.25rem;"
                               href="https://www.facebook.com/Penguinconsultants"
                               target="_blank">
                                <img src="{{public_path('images/footer_f.png')}}" width="35px">
                            </a>
                            <a style="text-decoration: none;margin-left: 0.25rem;"
                               href="https://www.linkedin.com/company/penguin-consultants-brasil/" target="_blank">
                                <img src="{{public_path('images/footer_i.png')}}" width="35px">
                            </a>
                            <a style="text-decoration: none;margin-left: 0.25rem;" href="https://twitter.com/valorizeit"
                               target="_blank">
                                <img src="{{public_path('images/footer_t.png')}}" width="35px">
                            </a>
                            <a style="text-decoration: none;margin-left: 0.25rem;" href="https://valorizeit.com"
                               target="_blank">
                                <img src="{{public_path('images/footer_b.png')}}" width="35px">
                            </a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endforeach
<div class="one-page page-break">
    <div class="row">
        <p class="last-title">{{__("LastPageHeader")}}</p>
    </div>
    <div class="row" style="padding:0.5rem 2rem 1rem 2rem;">
        <span style="color: #031047;@if(app()->getLocale()=='br')line-height: 16pt;@endif">{!!__('LastPageBody')!!}</span>
    </div>
    <div class="row" style="padding: 0 1rem;@if(app()->getLocale()=='en')padding-top:1rem;padding-bottom:1rem;@endif">
        <table width="100%">
            <tbody>
            <tr>
                <td style="width: 7%;vertical-align: top;">
                    <img src="{{public_path('images/Ai_STAY_AHEAD.png')}}" width="60px">
                </td>
                <td style="width: 43%;vertical-align: top;padding: 0.25rem; color: #031047;@if(app()->getLocale()=='br')line-height: 16pt;@endif">
                    {{__('LP_AheadCompete')}}
                </td>
                <td style="width: 7%;vertical-align: top;">
                    <img src="{{public_path('images/Ai_MEET_SURPASS.png')}}" width="60px">
                </td>
                <td style="width: 43%;vertical-align: top;padding: 0.25rem; color: #031047;@if(app()->getLocale()=='br')line-height: 16pt;@endif">
                    {{__('LP_MeetExpectations')}}
                </td>
            </tr>
            <tr>
                <td style="width: 7%;vertical-align: top;">
                    <img src="{{public_path('images/Ai_SELECT_PATH.png')}}" width="60px">
                </td>
                <td style="width: 43%;vertical-align: top;padding: 0.25rem; color: #031047;@if(app()->getLocale()=='br')line-height: 16pt;@endif">
                    {{__('LP_SelectPath')}}
                </td>
                <td style="width: 7%;vertical-align: top;">
                    <img src="{{public_path('images/Ai_MAXIMIZE_VALUE.png')}}" width="60px">
                </td>
                <td style="width: 43%;vertical-align: top;padding: 0.25rem; color: #031047;@if(app()->getLocale()=='br')line-height: 16pt;@endif">
                    {{__('LP_Maximize')}}
                </td>
            </tr>
            <tr>
                <td style="width: 7%;vertical-align: top;">
                    <img src="{{public_path('images/Ai_GET_THE_BENEFITS.png')}}" width="60px">
                </td>
                <td style="width: 43%;vertical-align: top;padding: 0.25rem; color: #031047;@if(app()->getLocale()=='br')line-height: 16pt;@endif">
                    {{__('LP_GetBenefits')}}
                </td>
                <td style="width: 7%;vertical-align: top;">
                    <img src="{{public_path('images/Ai_INCREASE_PROFITABILITY.png')}}" width="60px">
                </td>
                <td style="width: 43%;vertical-align: top;padding: 0.25rem; color: #031047;@if(app()->getLocale()=='br')line-height: 16pt;@endif">
                    {{__('LP_Increase')}}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row" style="padding: 0 1rem;@if(app()->getLocale()=='en')margin-top: 1rem;@endif">
        <table width="100%">
            <tbody>
            <tr>
                <td style="width: 15%;">
                    <img src="{{public_path('images/Ai_BULLSEYE.png')}}" width="90px">
                </td>
                <td style="width: 85%;">
                    <p class="sub-title-2">{{__('FinalWordsHeader')}}</p>
                    <span style="color: #031047;@if(app()->getLocale()=='br')line-height: 16pt;@endif">{{__('FinalWords')}}</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row" style="position: absolute;bottom: 0; background-color: #ffffff;">
        <table style="width: 100%;border-spacing: 0;">
            <tbody>
            <tr>
                <td style="width: 40%;padding-left: 2rem;">
                    <img src="{{public_path('images/footer_logo.png')}}" style="width: 150px; padding-top: 1.5rem;">
                    <p style="font-size: 16px; color: #031047; margin:-0.5rem 0 0.5rem 0;">{{__("Copyright")}}</p>
                </td>
                <td style="width: 10%;padding: 0">
                    <img src="{{public_path("images/footer1.png")}}" style="width: 80px;height: 100px;">
                </td>
                <td style="width: 50%;background-color:#ffc100;padding-right: 2rem;">
                    <p style="font-size: 14px;text-align: right; margin: 0;">Digital Transformist drivers at your
                        service!</p>
                    <p style="font-size: 12px;text-align: right; margin: 0;">info@penguinconsultants.net</p>
                    <div style="text-align: right; padding-top: 1rem;">
                        <a style="text-decoration: none;margin-left: 0.25rem;"
                           href="https://www.facebook.com/Penguinconsultants"
                           target="_blank">
                            <img src="{{public_path('images/footer_f.png')}}" width="35px">
                        </a>
                        <a style="text-decoration: none;margin-left: 0.25rem;"
                           href="https://www.linkedin.com/company/penguin-consultants-brasil/" target="_blank">
                            <img src="{{public_path('images/footer_i.png')}}" width="35px">
                        </a>
                        <a style="text-decoration: none;margin-left: 0.25rem;" href="https://twitter.com/valorizeit"
                           target="_blank">
                            <img src="{{public_path('images/footer_t.png')}}" width="35px">
                        </a>
                        <a style="text-decoration: none;margin-left: 0.25rem;" href="https://valorizeit.com"
                           target="_blank">
                            <img src="{{public_path('images/footer_b.png')}}" width="35px">
                        </a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div></div></body></html>