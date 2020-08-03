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
                                   {{__('messages.add')}} {{__('messages.new_specialty')}}&nbsp;
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
                                        <a href="{{action('Backend\SpecialtyController@index')}}"
                                           class="btn btn-warning btn-sm ">
                                            <i class="la la-undo"></i>
                                            {{__('messages.back')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--begin: Form Wizard Form-->

                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                            <!--begin: Form Wizard Form-->
                            <form class="kt-form" id="kt_form" method="post"
                                  action="{{ action('Backend\SpecialtyController@store')}}">
                            @csrf
                            {{--                            <input name="_method" type="hidden" value="PATCH">--}}
                            <!--begin: Form Wizard Step 1-->
                                <div id="kt-wizard_general" class="kt-wizard-v3__content"
                                     data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">

                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="form-group row">
                                                <label for="type"
                                                       class="col-lg-3 col-form-label">{{__('messages.type')}}*</label>
                                                <div class="col-lg-9">
                                                    <select id="type" type="text" name="type_id"
                                                            class="form-control" id="type">
                                                        <option value="">{{__('messages.select_type')}}</option>
                                                        @if(!empty($types))
                                                            @foreach($types as $key=>$type)
                                                                <option value="{{$key}}">{{$type}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="edu"
                                                       class="col-lg-3 col-form-label">{{__('messages.section')}}
                                                    *</label>
                                                <div class="col-lg-9">
                                                    <select type="text" name="parent_id" id="edu"
                                                            class="form-control">
                                                        <option value="">{{__('messages.select_section')}}</option>
                                                        { </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="key" class="col-lg-3 col-form-label">{{__('messages.name')}}
                                                    *</label>
                                                <div class="col-lg-9">
                                                    <input id="key" type="text" name="name"
                                                           class="form-control" value="{{old('name')}}">

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="icon" class="col-lg-3 col-form-label">{{__('messages.image_name')}}
                                                    *</label>
                                                <div class="col-lg-9">
                                                    <input id="icon" type="text" name="icon"
                                                           class="form-control" value="{{old('icon')}}">

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="kt-form__actions text-right float-lg-right">
                                    <button type="submit"
                                            class="btn btn-primary">{{__('messages.save')}}</button>
                                </div>

                                <!--end: Form Actions -->
                            </form>
                        </div>
                        <!--end: Form Wizard Form-->
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>
@endsection
