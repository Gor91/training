@extends('layouts.master')
@section('content')

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet resume">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>@php echo html_entity_decode(\Session::get('success'), ENT_HTML5) @endphp</p>
                </div><br/>
            @endif
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <p>@php echo html_entity_decode(\Session::get('error'), ENT_HTML5) @endphp</p>
                </div>
            @endif
            @if (Session::has('delete'))
                <div class="alert alert-info">
                    <p>{{ Session::get('delete') }}</p>
                </div>
            @endif
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3"
                     data-ktwizard-state="step-first">
                    <div class="kt-grid__item">

                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-network"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
                                    {{__('messages.resume')}}
                                    &nbsp;&nbsp; </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        &nbsp;
                                        <a href="{{action('Backend\AccountController@index', $account->role)}}"
                                           class="btn btn-warning btn-sm ">
                                            <i class="la la-undo"></i>
                                            {{__('messages.back')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

            <!--Begin:: App Aside Mobile Toggle-->
            <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
                <i class="la la-close"></i>
            </button>

            <!--End:: App Aside Mobile Toggle-->

            <!--Begin:: App Aside-->
            <div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">

                <!--Begin::Portlet-->
                <div class="kt-portlet $account-">
                    <div class="kt-portlet__head kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <span class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                <i class="flaticon-more-1"></i>
                            </span>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__item">
                                        <span class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-send"></i>
                                            <span class="kt-nav__link-text" data-toggle="modal"
                                                  data-target="#kt_modal_6">{{__('messages.send_email')}}</span>
                                        </span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="{{action('Backend\AccountController@gdPDF', $account->id)}}"
                                           class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-download"></i>
                                            <span class="kt-nav__link-text">{{__('messages.cv')}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <!--begin::Widget -->
                        <div class="kt-widget kt-widget--user-profile-2">
                            <div class="kt-widget__head">
                                <div class="kt-widget__media">
                                    <img class="kt-widget__img "
                                         src="{{ Config::get('constants.AVATAR_PATH_UPLOADED').$account->image_name}}"
                                         alt="image">
                                </div>
                                @if(!empty($account->name) || !empty($account->surname || !empty($account->father_name)))
                                    <div class="kt-widget__info">
                                        <span class="kt-widget__username">
                                            {{$account->name." ".$account->surname." ".$account->father_name}}
                                        </span>
                                        <br>
                                        <span class="kt-widget__data">
                                            {{$account->prof->profession}}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="kt-widget__body">
                                <div class="kt-widget__item">
                                    @if(!empty($account->role))
                                        <div class="kt-widget__section">
                                            <div class="kt-widget__contact">
                                        <span class="kt-widget__label">
                                            <i class="flaticon-user-settings"></i>
                                        </span>
                                                <span class="kt-widget__data">{{__('messages.'.$account->role)}}</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if(!empty($account->user->email))
                                        <div class="kt-widget__contact">
                                        <span class="kt-widget__label">
                                            <i class="flaticon-email"></i>
                                        </span>
                                            <span class="kt-widget__data">{{$account->user->email}}</span>
                                        </div>
                                    @endif
                                    @if(!empty($account->phone))
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label"><i class="flaticon2-phone"></i></span>
                                            <span class="kt-widget__data">{{$account->phone}}</span>
                                        </div>
                                    @endif
                                    @if(!empty($account->bday))
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label"><i class="flaticon-calendar-3"></i></span>
                                            <span class="kt-widget__data">{{$account->bday}}</span>
                                        </div>
                                    @endif
                                    @if(!empty($account->h_region))
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label">
                                                <i class="flaticon2-map"></i></span>
                                            <span class="kt-widget__data">
                                                {{$account->h_region."ի ".__('messages.region')}}
                                            </span>
                                        </div>
                                    @endif
                                    @if(!empty($account->h_territory))
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label">
                                                <i class="flaticon2-architecture-and-city"></i></span>
                                            <span class="kt-widget__data">
                                                {{$account->h_territory.__('messages.territory')}}
                                            </span>
                                        </div>
                                    @endif
                                    @if(!empty($account->h_street))
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label"><i class="flaticon-home-2"></i></span>
                                            <span class="kt-widget__data">
                                                {{$account->h_street}}
                                            </span>
                                        </div>
                                    @endif
                                    @if(!empty($account->gender))
                                        <div class="kt-widget__contact">
                                        <span class="kt-widget__label"><i
                                                    class="flaticon2-user-outline-symbol"></i></span>
                                            <span class="kt-widget__data">
                                                {{$account->gender}}
                                            </span>
                                        </div>
                                    @endif
                                    @if(!empty($account->married_status))
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label"><i class="flaticon2-reload"></i></span>
                                            <span class="kt-widget__data">
                                                {{$account->married_status}}
                                            </span>
                                        </div>
                                    @endif
                                    @if(!empty($account->passport))
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label"><i class="flaticon-cart"></i></span>
                                            <span class="kt-widget__data">{{$account->passport}}</span>
                                        </div>
                                    @endif
                                    @if(!empty($account->date_of_issue))
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label"><i class="flaticon-notes"></i></span>
                                            <span class="kt-widget__data">{{$account->date_of_issue}}</span>
                                        </div>
                                    @endif
                                    @if(!empty($account->date_of_expiry))
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label"><i class="flaticon-notes"></i></span>
                                            <span class="kt-widget__data">{{$account->date_of_expiry}}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="kt-widget__footer">
                                <div class="row ">
                                    <a href="{{action('Backend\AccountController@gdPDF', $account->id)}}" type="button"
                                       class="btn btn-label-info btn-lg btn-upper">բեռնել CV
                                    </a>
                                </div>
                            </div>
                            <div class="kt-widget__footer">
                                <div class="row ">
                                    <button type="button" class="btn btn-label-info btn-lg btn-upper"
                                            data-toggle="modal"
                                            data-target="#kt_modal_6">գրել
                                        հաղորդագրություն
                                    </button>
                                </div>
                            </div>
                            <div class="kt-widget__footer">
                                <div class="row ">
                                    @if($account->role == "user")
                                        <form method="post" class="col-lg-6"
                                              action="{{ action('Backend\AccountController@update', $account->id)}}">
                                            @csrf
                                            <input name="_method" type="hidden" value="PATCH">

                                            <button type="submit"
                                                    @if($account->user->status == 'approved') {{'disabled'}}@endif
                                                    class="btn btn-label-success btn-lg btn-upper col-lg-12">{{__('messages.approve')}}
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{action('Backend\AccountController@destroy', $account->id)}}"
                                          class="col-lg-6" id="_form" method="post">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_id" type="hidden" value="{{$account->id}}">
                                        <button data-ref="" type="button"
                                                {{--                                                    data-title="admin"--}}
                                                class="delete btn btn-label-danger btn-lg btn-upper col-lg-12"
                                                data-original-title="{{__('messages.reject')}}">
                                            {{__('messages.reject')}}

                                        </button>
                                        {{--                                                <button  data-title="admin"type="button" class="btn sweetalert"> Show me</button>--}}
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--end::Widget -->
                    </div>
                </div>

                <!--End::Portlet-->
            </div>
            <!--End:: App Aside-->
            <!--Begin:: App Content-->
            <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
                <div class="row">
                    <div class="col">
                        <!--Begin::Section-->
                        <div class="kt-portlet resume">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{__('messages.education')}}
                                    </h3>
                                </div>

                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-widget12">
                                    <div class="kt-widget3">
                                        <div class="kt-widget3__item">
                                            <div class="kt-widget3__body">

                                                <div class="kt-widget3__text--bold col-12">

                                                    <h5 class="kt-widget3__text--bold text-uppercase">{{__('messages.prof')}}</h5>
                                                    @if(!empty($profession->edu_name))
                                                        <p class="kt-widget3__text">
                                                            {{$profession->edu_name}}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="kt-widget3__text--bold col-12">

                                                    <h5 class="kt-widget3__text--bold text-uppercase">{{__('messages.spec')}}</h5>
                                                    @if(!empty($profession->spec_name))
                                                        <p class="kt-widget3__text">
                                                            {{$profession->spec_name}}
                                                        </p>
                                                    @endif


                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End::Section-->
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!--Begin::Section-->
                        <div class="kt-portlet resume">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{__('messages.workplace_name')}}
                                    </h3>
                                </div>

                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-widget12">
                                    <div class="kt-widget3">
                                        <div class="kt-widget3__item">
                                            <div class="kt-widget3__body">
                                                <div class="kt-widget3__text--bold col-12">

                                                    <h5 class="kt-widget3__text--bold text-uppercase">{{__('messages.edu')}}</h5>
                                                    @if(!empty($account->workplace_name))
                                                        <p class="kt-widget3__text">
                                                            {{$account->workplace_name}}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="kt-widget3__text--bold col-12">

                                                    <h5 class="kt-widget3__text--bold text-uppercase">{{__('messages.region')}}</h5>
                                                    @if(!empty($account->w_region && $account->w_territory))
                                                        <p class="kt-widget3__text">
                                                            {{$account->w_region. 'ի մարզ,  բնակավայր՝  '. $account->w_territory}}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="kt-widget3__text--bold col-12">

                                                    <h5 class="kt-widget3__text--bold text-uppercase">{{__('messages.street')}}</h5>
                                                    @if(!empty($account->w_street ))
                                                        <p class="kt-widget3__text">
                                                            {{$account->w_street}}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End::Section-->
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!--Begin::Section-->
                        <div class="kt-portlet resume">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{__('messages.diplomas')}}
                                    </h3>
                                </div>

                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-widget12">
                                    <div class="kt-widget3">
                                        <div class="kt-widget3__item">
                                            <div class="kt-widget3__body">
                                                @if(!empty($account->prof->diplomas))
                                                    @php

                                                        $diplomas = json_decode($account->prof->diplomas, true);
                                                    @endphp
                                                    @foreach($diplomas as $diploma)
                                                        <a href="{{Config::get('constants.DIPLOMA').$diploma}}"
                                                           target="_blank">
                                                            <img src="{{Config::get('constants.DIPLOMA').$diploma}}"
                                                                 alt="diploma" class="col-lg-4">
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End::Section-->
                    </div>
                </div>


            </div>
            <!--End:: App Content-->
        </div>
    </div>
    <!-- end:: Content -->

    <div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">ՈՒղարկել նամակ {{$account->user->email}}
                        հասցեին</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form class="kt-form" method="post" action="{{action('Backend\BaseController@sendEmail')}}">
                        @csrf
                        <input type="hidden" name="email" value="{{$account->user->email}}">
                        <input type="hidden" name="id" value="{{$account->id}}">
                        <input type="hidden" name="name" value="{{$account->name." ".$account->surname}}">
                        <div class="form-group row">
                            <label for="subject" class=" col-lg-3 col-form-label text-capitalize">թեմա*:</label>
                            <div class="col-lg-12">
                                <input id="subject" type="text"
                                       name="subject" class="form-control ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="message" class="text-right col-lg-3 col-form-label text-capitalize">հաղորդագրություն*:</label>
                            <div class="col-lg-12">
                                Can I insert rich text editor?
                                <textarea id="message" name="message"
                                          class="form-control"
                                          style="max-height: 200px; min-height: 200px; max-width: 100%; min-width: 100%"></textarea>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <button type="submit"
                                    class="p-15 col-3 btn btn-primary align-self-end">{{__('messages.send')}}</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection
