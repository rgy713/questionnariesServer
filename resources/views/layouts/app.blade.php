<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="abstract" content="Penguin Digital Transformation Assessment">
    <meta name="audience" content="General">
    <meta name="author" content="PenguinConsultants">
    <meta name="category" content="Editor">
    <meta name="copyright" content="PenguinConsultants">
    <meta name="classification" content="assessment, penguin digital transformation assessment, penguin consultants, penguin assessment, digital transformation readiness assessment, digital transformation, penguinconsultants, penguin consultants brasil, collaborative learning, empowering digital tools, digital mindset, data-driven decisions, digital dexterity, customer experiencer, operational efficiency">
    <meta name="content" content="general">
    <meta name="description" content="This Assessment will illustrate where you are in terms of readiness, using a Digital Organization Model. This model includes the different Digital Capabilities and areas that you need to develop to succeed with your Digital Transformation.">
    <meta name="distribution" content="global">
    <meta name="expires" content="never">
    <meta name="identifier-url" content="{{URL::to('/')}}">
    <meta name="keywords" content="assessment, penguin digital transformation assessment, penguin consultants, penguin assessment, digital transformation readiness assessment, digital transformation, penguinconsultants, penguin consultants brasil, collaborative learning, empowering digital tools, digital mindset, data-driven decisions, digital dexterity, customer experiencer, operational efficiency">
    <meta name="publisher" content="PenguinConsultants">
    <meta name="rating" content="general">
    <meta name="language" content="en">
    <meta name="revisit-after" content="14 days">
    <meta name="robots" content="index,follow">
    <meta name="subject" content="Penguin Digital Transformation Assessment">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Penguin Digital Transformation Assessment">
    <meta itemprop="description" content="This Assessment will illustrate where you are in terms of readiness, using a Digital Organization Model. This model includes the different Digital Capabilities and areas that you need to develop to succeed with your Digital Transformation. ">
    <meta itemprop="image" content="{{asset("images/LOGO_small.png")}}">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Penguin Digital Transformation Assessment">
    <meta name="twitter:description" content="This Assessment will illustrate where you are in terms of readiness, using a Digital Organization Model. This model includes the different Digital Capabilities and areas that you need to develop to succeed with your Digital Transformation. ">
    <meta name="twitter:image" content="{{asset("images/LOGO_small.png")}}">
    <meta name="twitter:url" content="{{URL::to('/')}}">
    <meta name="twitter:site" content="@valorizeit">
    <meta name="twitter:creator" content="@valorizeit">
    <!-- og meta tags -->
    <meta property="og:title" content="Penguin Digital Transformation Assessment">
    <meta property="og:url" content="{{URL::to('/')}}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_US">
    <meta property="og:image" content="{{asset("images/LOGO_small.png")}}">
    <meta property="og:description" content="This Assessment will illustrate where you are in terms of readiness, using a Digital Organization Model. This model includes the different Digital Capabilities and areas that you need to develop to succeed with your Digital Transformation. ">
    <meta name="google-site-verification" content="LIoRhIEIRPv8nWBhiy-3sEdA7XCb9gwMAjz_TahTPlU" />
    <link rel="canonical" href="{{URL::to('/')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="/favicon.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-4.1.3-dist/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link href="{{ asset('plugins/sweetalert2/sweetalert2.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134916346-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-134916346-1');
    </script>

    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-4.1.3-dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/sweetalert2/sweetalert2.all.js') }}" charset="UTF-8"></script>
    <script src="{{ asset('js/common.js') }}"></script>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{route('frontend.home')}}">
            <img src="{{ asset('images/logo.png') }}" height="50" alt="">
        </a>
        <ul class="nav navbar-nav navbar-right flex-row">
            <li class="nav-item">
                <a href="/locale/br" class="nav-link language" data-toggle="tooltip" title="{{__("OnMouseOverPt")}}"><img src="{{ asset('svg/br.svg') }}" alt="Brazilian" /></a>
            </li>
            <li class="nav-item">
                <a href="/locale/en" class="nav-link language" data-toggle="tooltip" title="{{__("OnMouseOverEng")}}"><img src="{{asset('svg/en.svg')}}" alt="English" /></a>
            </li>
        </ul>
    </div>
</nav>
<main class="container">
    @yield('content')
</main>
<!-- Footer -->
<footer class="page-footer font-small pt-4">
    <!-- Footer Elements -->
    <div class="container">

        <!-- Social buttons -->
        <ul class="list-unstyled list-inline text-center">
            <li class="list-inline-item">
                <a class="btn-floating mx-3" href="https://www.facebook.com/Penguinconsultants" target="_blank">
                    <img src="{{asset('svg/facebook.svg')}}">
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn-floating mx-3" href="https://www.linkedin.com/company/penguin-consultants-brasil/" target="_blank">
                    <img src="{{asset('svg/linkedin.svg')}}">
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn-floating mx-3" href="https://twitter.com/valorizeit" target="_blank">
                    <img src="{{asset('svg/twitter.svg')}}">
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn-floating mx-3" href="https://valorizeit.com" target="_blank">
                    <img src="{{asset('svg/blogger.svg')}}">
                </a>
            </li>
        </ul>
        <!-- Social buttons -->

    </div>
    <!-- Footer Elements -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-2">{{__("Copyright")}}</div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
<div id="modal-loading" style="background-image: url('{{ asset('images/loading.gif') }}');"></div>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(
            {
                delay: {
                    show: 500,
                    hide: 0
                }
            }
        );
    });
</script>
</body>
</html>
