<?php
$user = isAdmin();

?>
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('backend.partials.head')
<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
@include('backend.partials.header')
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        @include('backend.partials.sidebar')

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                <!-- begin:: Header -->
                <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

                    <!-- begin:: Header Menu -->
                    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i
                                class="la la-close"></i></button>
                    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">

                    </div>

                    <!-- end:: Header Menu -->

                    <!-- begin:: Header Topbar -->
                    <div class="kt-header__topbar">

                        <!--begin: User Bar -->
                        <div class="kt-header__topbar-item kt-header__topbar-item--user">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                                <div class="kt-header__topbar-user">
                                    <span class="kt-header__topbar-welcome kt-hidden-mobile">{{__('messages.hello')}}, </span>
                                    @if(!empty($user))
                                    <span class="kt-header__topbar-username kt-hidden-mobile mobile_name">{{$user->name}}</span>
                                    @endif

                                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                    {{--                                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{$fn}}</span>--}}
                                </div>
                            </div>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                                <!--begin: Head -->
                                <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x"
                                     style="background-image: url({{asset('assets/media/misc/bg-1.jpg')}})">
                                    <div class="kt-user-card__avatar">

                                        <img class="kt-widget__img "
                                             src="{{asset(\Illuminate\Support\Facades\Config::get('constants.DEFAULT_PATH'))}}"
                                             alt="image">
                                    </div>
                                    <div class="kt-user-card__name">
                                        <p>{{$user->email}}</p>
                                        <p></p>
                                    </div>

                                </div>
                                <!--end: Head -->
                                <!--begin: Navigation -->
                                <div class="kt-notification">
                                    <a href="{{action('Backend\AdminController@show', $user->id)}}"
                                       class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                {{__('messages.profile')}}
                                            </div>
                                            <div class="kt-notification__item-time">
                                                {{__('messages.manage_account')}}
                                            </div>
                                        </div>
                                    </a>

                                    <div class="kt-notification__custom kt-space-between">
                                        <a href="{{ route('logout') }}" target="_blank"
                                           class="btn btn-label btn-label-brand btn-sm btn-bold"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('messages.logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>

                                <!--end: Navigation -->
                            </div>
                        </div>

                        <!--end: User Bar -->
                    </div>

                    <!-- end:: Header Topbar -->
                </div>

                <!-- end:: Header -->
                <!-- begin:: Content Head -->
                <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                    <div class="kt-subheader__main">
                        <h3 class="kt-subheader__title">{{__('messages.system')}}</h3>

                        @php
                            $uri =request()->segment(count(request()->segments()));
                        @endphp
                        @if(!preg_match('/[0-9]+$/',$uri))
                            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                            <span class="kt-subheader__desc text-uppercase">{{__("messages.$uri")}}</span>
                        @endif
                        <div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
                            <input type="text" class="form-control" placeholder="Search order..." id="generalSearch">
                            <span class="kt-input-icon__icon kt-input-icon__icon--right">
										<span><i class="flaticon2-search-1"></i></span>
									</span>
                        </div>
                    </div>

                </div>

                <!-- end:: Content Head -->

                <!-- begin:: Content -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                    @yield('content')
                </div>
                <!-- end:: Content -->
            </div>
            @include('backend.partials.footer')
        </div>
    </div>
</div>

</body>
</html>

