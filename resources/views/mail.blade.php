<body>
    <p>{{__('mail_header',['title'=>$subject])}}</p>
    <br>
    <p>{{__('Dear')}} {{$username}}</p>
    <br>
    <p>{{__('mail_thanks')}}</p>
    <p>{!! __('mail_last') !!}</p>
    <br>
    <a href="{{route('frontend.downloadPDF', ['session_id'=>$session_id, 'locale'=>app()->getLocale()])}}" target="_blank">{{__('mail_pdf_download')}}</a>
    <br>
    <p>{{__('Kind regards')}}</p>
    <br>
    <p> The Digital Transformists @ Penguin Consultants</p>
</body>