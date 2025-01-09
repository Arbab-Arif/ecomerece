<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>{{config('app.name')}} - {{$title ?? ''}}</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{asset('assets/frontend/images/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('assets/frontend/images/apple-touch-icon.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/custom.css')}}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


<x-frontend.header></x-frontend.header>
{{$slot}}
<x-frontend.footer></x-frontend.footer>


<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

<!-- ALL JS FILES -->
<script src="{{asset('assets/frontend/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/popper.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
<!-- ALL PLUGINS -->
<script src="{{asset('assets/frontend/js/jquery.superslides.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/frontend/js/inewsticker.js')}}"></script>
<script src="{{asset('assets/frontend/js/bootsnav.js')}}"></script>
<script src="{{asset('assets/frontend/js/images-loded.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/isotope.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/baguetteBox.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/form-validator.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/contact-form-script.js')}}"></script>
<script src="{{asset('assets/frontend/js/custom.js')}}"></script>
{{$scripts ?? null}}
</body>

</html>
