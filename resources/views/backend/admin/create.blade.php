@extends('layouts.master')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3"
                     data-ktwizard-state="step-first">
                    <div class="kt-grid__item">
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
                                <p>{{ \Session::get('success') }}</p>
                            </div><br/>
                        @endif
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                <p>{{ \Session::get('error') }}</p>
                            </div>
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
                                   {{Lang::get('messages.add')}} նոր օգտատեր&nbsp;
                                       </span>
                                </h3>
                                <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-information info">* {{Lang::get('messages.all_field_required')}}</i>
                                </span>
                            </div>

                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        &nbsp;
                                        <a href="{{action('Backend\UserController@index')}}"
                                           class="btn btn-warning btn-sm ">
                                            <i class="la la-undo"></i>
                                            {{Lang::get('messages.back')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                            <!--begin: Form Wizard Form-->
                            <form class="kt-form" id="kt_form" method="post" enctype="multipart/form-data"
                                  action="{{ action('Backend\UserController@store')}}">
                            @csrf
                            {{--                            <input name="_method" type="hidden" value="PATCH">--}}
                            <!--begin: Form Wizard Step 1-->
                                <div id="kt-wizard_general" class="kt-wizard-v3__content"
                                     data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">

                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="form-group row">
                                                <label for="first_name" class="col-lg-2 col-form-label">Անուն*</label>
                                                <div class="col-lg-10">

                                                    <input id="first_name" type="text" name="first_name"
                                                           class="form-control" value="{{old('first_name')}}">

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="last_name" class="col-lg-2 col-form-label">Ազգանուն*</label>
                                                <div class="col-lg-10">
                                                    <input id="last_name" type="text" name="last_name"
                                                           class="form-control" value="{{old('last_name')}}"
                                                    ></div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="avatar" class="col-lg-2 col-form-label">Նկար*</label>
                                                <div class="col-lg-10">
                                                    <input id="avatar" type="file" name="avatar"
                                                           class="form-control" ></div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-lg-2 col-form-label">Էլ. փոստ*</label>
                                                <div class="col-lg-10">
                                                    <input id="email" type="email" name="email"
                                                           class="form-control" value="{{old('email')}}">

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-lg-2 col-form-label">Հեռախոս*</label>
                                                <div class="col-lg-10">
                                                    <input id="phone" type="tel" name="phone"
                                                           class="form-control" value="{{old('phone')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="password" class="col-lg-2 col-form-label">Ծածկագիր</label>
                                                <div class="col-lg-10">
                                                    <input id="password" type="password" name="password"
                                                           class="form-control">
                                                    <span class="form-text text-muted">Լրացնել միայն փոփոխելու կամ նորը սահմանելու դեպքում</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="c_password" class="col-lg-2 col-form-label">Կրկնել
                                                    ծածկագիր</label>
                                                <div class="col-lg-10">
                                                    <input id="c_password" type="password" name="password_confirmation"
                                                           class="form-control">
                                                    <span class="form-text text-muted">Լրացնել միայն փոփոխելու կամ նորը սահմանելու դեպքում</span>

                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label for="group" class="col-lg-2 col-form-label">Դեր*</label>
                                                <div class="col-lg-10">
                                                    <select id="group" name="group"
                                                            class="form-control ">

                                                        @foreach ($groups as $group)
                                                            <option value="@if(!empty(old($group->id))){{old($group->id)}} @else {{$group->id}} @endif">
                                                                {{$group->description}}
                                                            </option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 1-->

                                <div class="kt-form__actions text-right float-lg-right">
                                    <button type="submit" class="btn btn-primary">{{Lang::get('messages.save')}}</button>
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
