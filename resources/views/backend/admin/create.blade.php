@extends('layouts.master')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3"
                     data-ktwizard-state="step-first">
                    <div class="kt-grid__item">
                        {{--                        @if ($errors->any())--}}
                        {{--                            <div class="alert alert-danger">--}}
                        {{--                                <ul>--}}
                        {{--                                    @foreach ($errors->all() as $error)--}}
                        {{--                                        <li>{{ $error }}</li>--}}
                        {{--                                    @endforeach--}}
                        {{--                                </ul>--}}
                        {{--                            </div>--}}
                        {{--                        @endif--}}
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div><br/>
                        @endif

                        @if (Session::has('delete'))
                            <div class="alert alert-info">
                                <p>{{ Session::get('delete') }}</p>
                            </div>
                        @endif
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label title__head">
                                <h3 class="kt-portlet__head-title ">
                                   <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-user-add"></i>
                                   {{__('messages.add')}} {{__('messages.new_user')}}&nbsp;
                                       </span>
                                </h3>
                                <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-information info">* {{__('messages.*_field_required')}}</i>
                                </span>
                            </div>

                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        &nbsp;
                                        <a href="{{action('Backend\AdminController@index')}}"
                                           class="btn btn-warning btn-sm ">
                                            <i class="la la-undo"></i>
                                            {{__('messages.back')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                            <!--begin: Form Wizard Form-->
                            <form class="kt-form" id="kt_form" method="post" enctype="multipart/form-data"
                                  action="{{ action('Backend\AdminController@store')}}">
                            @csrf
                            {{--                            <input name="_method" type="hidden" value="PATCH">--}}
                            <!--begin: Form Wizard Step 1-->
                                <div id="kt-wizard_general" class="kt-wizard-v3__content"
                                     data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">

                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="form-group row validated">
                                                <label for="first_name"
                                                       class="col-lg-2 col-form-label">{{__('messages.name')}}*</label>
                                                <div class="col-lg-10">

                                                    <input id="name" type="text" name="name"
                                                           class="form-control @if($errors->first('name')){{'is-invalid'}} @endif"
                                                           value="{{old('name')}}">
                                                    @error('name')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row validated">
                                                <label for="email"
                                                       class="col-lg-2 col-form-label">{{__('messages.email')}}*</label>
                                                <div class="col-lg-10">
                                                    <input id="email" type="email" name="email"
                                                           class="form-control @if($errors->first('email')){{'is-invalid'}} @endif"
                                                           value="{{old('email')}}">
                                                    @error('email')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row validated">
                                                <label for="password"
                                                       class="col-lg-2 col-form-label">{{__('messages.password')}}</label>
                                                <div class="col-lg-10">
                                                    <input id="password" type="password" name="password"
                                                           class="form-control @if($errors->first('password')){{'is-invalid'}} @endif">
                                                    <span class="form-text text-muted">{{__('messages.complete_pass')}}</span>
                                                    @error('password')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row validated">
                                                <label for="c_password"
                                                       class="col-lg-2 col-form-label">{{__('messages.confirm')}}</label>
                                                <div class="col-lg-10">
                                                    <input id="c_password" type="password" name="password_confirmation"
                                                           class="form-control @if($errors->first('password_confirmation')){{'is-invalid'}} @endif">
                                                    <span class="form-text text-muted">{{__('messages.complete_pass')}}</span>
                                                    @error('password_confirmation')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 1-->

                                <div class="kt-form__actions text-right float-lg-right">
                                    <button type="submit"
                                            class="btn btn-primary">{{__('messages.save')}}</button>
                                </div>

                                <!--end: Form Actions -->
                            </form>

                            <!--end: Form Wizard Form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>
@endsection
