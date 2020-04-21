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
											<i class="kt-font-brand flaticon2-user-outline-symbol"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
                                    Իմ էջը
                                    &nbsp;&nbsp; </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        <i class="la la-edit"></i>
                                        {{__('messages.edit')}}

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
                <div class="kt-portlet $data-">
                    <div class="kt-portlet__head kt-portlet__head--noborder">
                    </div>
                    <div class="kt-portlet__body">

                        <!--begin::Widget -->
                        <div class="kt-widget kt-widget--user-profile-2">
                            <div class="kt-widget__head">
                                <div class="kt-widget__media">
                                    @php
                                        $img_path =storage_path().\Illuminate\Support\Facades\Config::get('constants.USER_AVATAR_PATH').$data->avatar;

                                    @endphp
                                    @if(!empty($data->avatar) && file_exists($img_path))
                                        <img class="kt-widget__img "
                                             src="{{asset('/storage'.\Illuminate\Support\Facades\Config::get('constants.USER_AVATAR_PATH').$data->avatar)}}"
                                             alt="image">
                                    @else
                                        <img class="kt-widget__img "
                                             src="{{asset(\Illuminate\Support\Facades\Config::get('constants.DEFAULT_PATH'))}}"
                                             alt="image">
                                    @endif
                                </div>

                                @if(!empty($data->name) )
                                    <div class="kt-widget__info">
                                        <span class="kt-widget__username">
                                            {{$data->name}}
                                        </span>
                                    </div>
                                @endif

                                <input type="file" id="file" style="display: none"/>
                                <input type="hidden" id="file_name" value="{{$data->avatar}}">
                                <input type="hidden" name="id" value="{{$data->id}}">
                            </div>
                            <div class="kt-widget__body">

                                <div class="kt-widget__item">
                                    @if(!empty($data->email))
                                        <div class="kt-widget__contact">
                                        <span class="kt-widget__label">
                                            <i class="flaticon-email"></i>
                                        </span>
                                            <span class="kt-widget__data">{{$data->email}}</span>
                                        </div>
                                    @endif

                                    @if(!empty($data->created_at))
                                        <div class="kt-widget__contact">
                                            <span class="kt-widget__label"><i class="flaticon2-calendar-3"></i></span>
                                            <span class="kt-widget__data">{{$data->created_at}}</span>
                                        </div>
                                    @endif
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
                <div class="kt-portlet resume">
                    <div class="kt-portlet__body">
                        <form class="kt-form" id="kt_form" method="post"
                              action="{{ action('Backend\AdminController@update', $data->id)}}">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">
                            <!--begin: Form Wizard Step 1-->
                            <div id="kt-wizard_general" class="kt-wizard-v3__content" data-ktwizard-type="step-content"
                                 data-ktwizard-state="current">

                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v3__form">
                                        <div class="form-group row">
                                            <label for="name" class="col-lg-2 col-form-label">{{__('messages.name')}}*</label>
                                            <div class="col-lg-10">
                                                <input type="hidden" name="id" value="{{$data->id}}">
                                                <input id="name" type="text" name="name"
                                                       class="form-control"
                                                       value="{{  $data->name}}">

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-lg-2 col-form-label">{{__('messages.email')}}*</label>
                                            <div class="col-lg-10">
                                                <input id="email" type="tel" name="email" class="form-control m-input"
                                                       value="{{$data->email}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 1-->
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions text-right">
                                    <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
                                </div>
                            </div>
                        </form>

                        <form class="kt-form" id="kt_form" method="post"
                              action="{{ action('Backend\AdminController@changePassword', $data->id)}}">
                            @csrf
                            <input name="_method" type="hidden" value="PATCH">
                            <!--begin: Form Wizard Step 1-->
                            <div id="kt-wizard_general" class="kt-wizard-v3__content" data-ktwizard-type="step-content"
                                 data-ktwizard-state="current">
                                <div class="form-group row">
                                    <label for="password" class="col-lg-2 col-form-label">{{__('messages.old_password')}}</label>
                                    <div class="col-lg-10">
                                        <input id="password" type="password" name="old_password"
                                               class="form-control m-input">
                                        <span class="form-text text-muted">{{__('messages.complete_pass')}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-lg-2 col-form-label">{{__('messages.new_password')}}</label>
                                    <div class="col-lg-10">
                                        <input id="password" type="password" name="password"
                                               class="form-control m-input">
                                        <span class="form-text text-muted">{{__('messages.complete_pass')}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="c_password" class="col-lg-2 col-form-label">{{__('messages.confirm_password')}}</label>
                                    <div class="col-lg-10">
                                        <input id="c_password" type="password" name="confirm_password"
                                               class="form-control m-input">
                                        <span class="form-text text-muted">{{__('messages.complete_pass')}}</span>

                                    </div>

                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions text-right">
                                    <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--End:: App Content-->
        </div>

    </div>
    <!-- end:: Content -->
@endsection
