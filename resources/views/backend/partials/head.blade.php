<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--begin::Base Path (base relative path for assets of this page) -->
    <base href="../">

    <!--end::Base Path -->
    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'medical_training') }}</title>

    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{ asset('/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
          type="text/css"/>

    <!--end::Page Vendors Styles -->

    <!--begin:: Global Mandatory Vendors -->
    <link href="{{ asset('/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/assets/css/pages/general/wizard/wizard-3.css')}}" rel="stylesheet" type="text/css"/>
    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
<!--    <link href="{{ asset('/assets/vendors/general/tether/dist/css/tether.css') }}" rel="stylesheet" type="text/css"/>-->
    <link href="{{ asset('/assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}"
          rel="stylesheet">

    <link href="{{ asset('/assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css')}}"
          rel="stylesheet" type="text/css"/>
    <!--          type="text/css"/>-->
<!--    <link href="{{ asset('/assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet"-->
    <!--          type="text/css"/>-->
<!--    <link href="{{ asset('/assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet"-->
    <!--          type="text/css"/>-->
<!--    <link href="{{ asset('/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet"-->
    <!--          type="text/css"/>-->
<!--    <link href="{{ asset('/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css') }}" rel="stylesheet"-->
    <!--          type="text/css"/>-->
<!--    <link href="{{ asset('/assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet"-->
    <!--          type="text/css"/>-->
<!--    <link href="{{ asset('/assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css') }}" rel="stylesheet"-->
    <!--          type="text/css"/>-->
    <link href="{{ asset('/assets/vendors/general/select2/dist/css/select2.css') }}" rel="stylesheet" type="text/css"/>
<!--    <link href="{{ asset('/assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>-->
<!--    <link href="{{ asset('/assets/vendors/general/nouislider/distribute/nouislider.css') }}" rel="stylesheet" type="text/css"/>-->
<!--    <link href="{{ asset('/assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css') }}" rel="stylesheet" type="text/css"/>-->
<!--    <link href="{{ asset('/assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css') }}" rel="stylesheet"-->
    <!--          type="text/css"/>-->
<!--    <link href="{{ asset('/assets/vendors/general/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css"/>-->
    <link href="{{ asset('/assets/vendors/general/summernote/dist/summernote.css') }}" rel="stylesheet"
          type="text/css"/>
<!--    <link href="{{ asset('/assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet"-->
    <!--          type="text/css"/>-->
<!--    <link href="{{ asset('/assets/vendors/general/animate.css/animate.css') }}" rel="stylesheet" type="text/css"/>-->
<!--    <link href="{{ asset('/assets/vendors/general/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css"/>-->
<!--    <link href="{{ asset('/assets/vendors/general/morris.js/morris.css') }}" rel="stylesheet" type="text/css"/>-->
    <link href="{{ asset('/assets/vendors/general/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet"
          type="text/css"/>
<!--    <link href="{{ asset('/assets/vendors/general/socicon/css/socicon.css') }}" rel="stylesheet" type="text/css"/>-->
    <link href="{{ asset('/fonts/line-awesome/css/line-awesome.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/fonts/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/fonts/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"/>
<!--    <link href="{{ asset('/assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet"-->
    <!--          type="text/css"/>-->

    <!--end:: Global Optional Vendors -->

    <!--begin::Layout Skins(used by all pages) -->
<!--    <link href="{{ asset('/assets/css/skins/header/base/light.css') }}" rel="stylesheet" type="text/css"/>-->
<!--    <link href="{{ asset('/assets/css/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css"/>-->
<!--    <link href="{{ asset('/assets/css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css"/>-->
    <link href="{{ asset('/assets/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@3.2.0/css/froala_editor.pkgd.min.css' rel='stylesheet'
          type='text/css'/>
    <!--end::Global Theme Styles -->
@yield('stylesheets')
<!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}"/>
    <script src="{{ asset('assets/vendors/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.283.1.min.js" type="text/javascript"></script>
</head>
