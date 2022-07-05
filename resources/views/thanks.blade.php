@extends('layouts.app')

@section('content')
    <section class="select2-container">
        <h1 class="mt-5">{{__("TYP_Header")}}</h1>
        <div class="row m-4">
            <span>
                {{__('TYP_Generaltext')}}
            </span>
        </div>
        <div class="row m-5">
            <div class="col-4 p-5">
                <img src="{{asset('images/LOGO_small.png')}}" width="100%">
            </div>
            <div class="col-8 p-4" style="margin: auto;">
                <h1>www.penguinconsultants.net</h1>
            </div>
        </div>
    </section>
@endsection